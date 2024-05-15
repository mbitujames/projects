<?php
require_once './data/db.php';
require_once('mpesa/safaricom_daraja.php'); // Ensure the Daraja library is included

$consumerKey = 'LXu2ZGQCFSuLXE9R4Ifb9krQIX0fOY5Zr0sjgAHGlwAPSF4R'; // Replace with your Consumer Key
$consumerSecret = 'LXu2ZGQCFSuLXE9R4Ifb9krQIX0fOY5Zr0sjgAHGlwAPSF4R'; // Replace with your Consumer Secret
$businessShortCode = '174379'; // Replace with your Business Short Code

$mpesa = new Safaricom_Daraja($consumerKey, $consumerSecret);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['property_id'])) {
    $property_id = intval($_POST['property_id']);
    $phone = $_POST['phone'];
    $payment_amount = floatval($_POST['payment_amount']);
    $user_id = 1; // Replace with the actual user ID from your authentication system
    $payment_method = 'M-PESA';
    $payment_status = 'pending';
    $payment_date = date('Y-m-d H:i:s');

    // Insert the initial payment record into the database
    $sql = "INSERT INTO payments (property_id, user_id, payment_amount, phone, payment_method, payment_status, payment_date) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iidIsss", $property_id, $user_id, $payment_amount, $phone, $payment_method, $payment_status, $payment_date);
    mysqli_stmt_execute($stmt);
    $payment_id = mysqli_insert_id($conn);
    mysqli_stmt_close($stmt);

    // Initiate STK Push
    $data = [
        'BusinessShortCode' => $businessShortCode,
        'PhoneNumber' => $phone,
        'Amount' => $payment_amount,
        'PartyA' => $phone,
        'PartyB' => $businessShortCode,
        'AccountReference' => uniqid(), // Unique transaction ID
        'TransactionDesc' => "Property Payment - ID: $property_id",
        'CallBackURL' => 'https://your-domain.com/process_payment.php' // Replace with your callback URL
    ];

    $response = $mpesa->stkPush($data);

    if ($response['ResponseCode'] == 0) {
        // STK Push initiated successfully
        echo 'STK Push initiated. Please check your phone to complete the payment.';
    } else {
        // Update payment status to failed
        $sql = "UPDATE payments SET payment_status = 'failed' WHERE payment_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $payment_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo 'Error initiating STK Push: ' . $response['ResponseDescription'];
    }
    exit();
}

// Handle M-PESA Callback
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Body']['stkCallback'])) {
    $callbackData = $_POST['Body']['stkCallback'];
    $resultCode = $callbackData['ResultCode'];
    $resultDesc = $callbackData['ResultDesc'];
    $checkoutRequestID = $callbackData['CheckoutRequestID'];
    $payment_date = date('Y-m-d H:i:s');

    // Extract additional callback data if needed
    $amount = $callbackData['CallbackMetadata']['Item'][0]['Value'];
    $phoneNumber = $callbackData['CallbackMetadata']['Item'][4]['Value'];

    $payment_status = '';
    switch ($resultCode) {
        case 0:
            $payment_status = 'successful';
            break;
        case 1032: // Example code for cancelled
            $payment_status = 'cancelled';
            break;
        case 1: // Example code for insufficient funds
            $payment_status = 'failed';
            break;
        default:
            $payment_status = 'on-hold';
            break;
    }

    // Update payment record
    $sql = "UPDATE payments SET payment_status = ?, payment_date = ? WHERE phone = ? AND payment_amount = ? AND payment_status = 'pending'";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssd", $payment_status, $payment_date, $phoneNumber, $amount);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($payment_status == 'successful') {
        // Update property availability
        $sql = "UPDATE properties SET availability = 0 WHERE property_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $property_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo 'Payment successful and property availability updated.';
    } else {
        echo 'Payment status: ' . $payment_status . ' - ' . $resultDesc;
    }

    exit();
}
?>
