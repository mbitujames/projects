<?php
session_start();

// echo '<a href="index.php">Home<br /></a>';

require_once './data/db.php'; 

$payment_id = isset($_SESSION['payment_id']) ? $_SESSION['payment_id'] : '';

$content = file_get_contents('php://input'); //Receives the JSON Result from safaricom
$res = json_decode($content, true); //Convert the json to an array

$dataToLog = array(
    date("Y-m-d H:i:s"), //Date and time
    " MerchantRequestID: " . $res['Body']['stkCallback']['MerchantRequestID'],
    " CheckoutRequestID: " . $res['Body']['stkCallback']['CheckoutRequestID'],
    " ResultCode: " . $res['Body']['stkCallback']['ResultCode'],
    " ResultDesc: " . $res['Body']['stkCallback']['ResultDesc'],
);

$data = implode(" - ", $dataToLog);
$data .= PHP_EOL;
file_put_contents('transaction_log', $data, FILE_APPEND); //Logs the results to our log file


if ($res['Body']['stkCallback']['ResultCode'] == "0") {
    $sql = "UPDATE payments SET payment_status = 'successful' WHERE payment_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $payment_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql_availability = "UPDATE properties SET availability = 0 WHERE property_id = ?";
    $stmt_availability = mysqli_prepare($conn, $sql_availability);
    mysqli_stmt_bind_param($stmt_availability, "i", $property_id);
    mysqli_stmt_execute($stmt_availability);
    mysqli_stmt_close($stmt_availability);

    // Display confirmation message
    echo 'Payment successful! Property marked as unavailable.';
    

} else {
    $sql = "UPDATE payments SET payment_status = 'failed' WHERE payment_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $payment_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}

if ($rs) {
    file_put_contents('error_log', "Records Inserted\n", FILE_APPEND);;
} else {
    file_put_contents('error_log', "Failed to insert Records\n", FILE_APPEND);
}