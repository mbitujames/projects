<?php
session_start();
require_once '../data/db.php'; 
$property_id=$_SESSION['property_id'];

// require_once('mpesa/safaricom_daraja.php'); // Ensure the Daraja library is included

// $consumerKey = 'LXu2ZGQCFSuLXE9R4Ifb9krQIX0fOY5Zr0sjgAHGlwAPSF4R'; // Replace with your Consumer Key
// $consumerSecret = 'LXu2ZGQCFSuLXE9R4Ifb9krQIX0fOY5Zr0sjgAHGlwAPSF4R'; // Replace with your Consumer Secret
// $businessShortCode = '174379'; // Replace with your Business Short Code

// $mpesa = new Safaricom_Daraja($consumerKey, $consumerSecret);

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['property_id']) && isset($_POST['pay-btn'])) {
//     $property_id = intval($_POST['property_id']);
//     $phone = $_POST['phone'];
//     $payment_amount = floatval($_POST['payment_amount']);
//     $user_id = 1; // Replace with the actual user ID from your authentication system
//     $payment_method = 'M-PESA';
//     $payment_status = 'pending';
//     $payment_date = date('Y-m-d H:i:s');

//     // Insert the initial payment record into the database
//     $sql = "INSERT INTO payments (property_id, user_id, payment_amount, phone, payment_method, payment_status, payment_date) 
//             VALUES (?, ?, ?, ?, ?, ?, ?)";
//     $stmt = mysqli_prepare($conn, $sql);
//     mysqli_stmt_bind_param($stmt, "iidIsss", $property_id, $user_id, $payment_amount, $phone, $payment_method, $payment_status, $payment_date);
//     mysqli_stmt_execute($stmt);
//     $payment_id = mysqli_insert_id($conn);
//     mysqli_stmt_close($stmt);

//     // Initiate STK Push
//     $data = [
//         'BusinessShortCode' => $businessShortCode,
//         'PhoneNumber' => $phone,
//         'Amount' => $payment_amount,
//         'PartyA' => $phone,
//         'PartyB' => $businessShortCode,
//         'AccountReference' => uniqid(), // Unique transaction ID
//         'TransactionDesc' => "Property Payment - ID: $property_id",
//         'CallBackURL' => 'https://your-domain.com/process_payment.php' // Replace with your callback URL
//     ];

//     $response = $mpesa->stkPush($data);

//     if ($response['ResponseCode'] == 0) {
//         // STK Push initiated successfully
//         echo 'STK Push initiated. Please check your phone to complete the payment.';
//     } else {
//         // Update payment status to failed
//         $sql = "UPDATE payments SET payment_status = 'failed' WHERE payment_id = ?";
//         $stmt = mysqli_prepare($conn, $sql);
//         mysqli_stmt_bind_param($stmt, "i", $payment_id);
//         mysqli_stmt_execute($stmt);
//         mysqli_stmt_close($stmt);

//         echo 'Error initiating STK Push: ' . $response['ResponseDescription'];
//     }
//     exit();
// }

// // Handle M-PESA Callback
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Body']['stkCallback'])) {
//     $callbackData = $_POST['Body']['stkCallback'];
//     $resultCode = $callbackData['ResultCode'];
//     $resultDesc = $callbackData['ResultDesc'];
//     $checkoutRequestID = $callbackData['CheckoutRequestID'];
//     $payment_date = date('Y-m-d H:i:s');

//     // Extract additional callback data if needed
//     $amount = $callbackData['CallbackMetadata']['Item'][0]['Value'];
//     $phoneNumber = $callbackData['CallbackMetadata']['Item'][4]['Value'];

//     $payment_status = '';
//     switch ($resultCode) {
//         case 0:
//             $payment_status = 'successful';
//             break;
//         case 1032: // Example code for cancelled
//             $payment_status = 'cancelled';
//             break;
//         case 1: // Example code for insufficient funds
//             $payment_status = 'failed';
//             break;
//         default:
//             $payment_status = 'on-hold';
//             break;
//     }

//     // Update payment record
//     $sql = "UPDATE payments SET payment_status = ?, payment_date = ? WHERE phone = ? AND payment_amount = ? AND payment_status = 'pending'";
//     $stmt = mysqli_prepare($conn, $sql);
//     mysqli_stmt_bind_param($stmt, "sssd", $payment_status, $payment_date, $phoneNumber, $amount);
//     mysqli_stmt_execute($stmt);
//     mysqli_stmt_close($stmt);

//     if ($payment_status == 'successful') {
//         // Update property availability
//         $sql = "UPDATE properties SET availability = 0 WHERE property_id = ?";
//         $stmt = mysqli_prepare($conn, $sql);
//         mysqli_stmt_bind_param($stmt, "i", $property_id);
//         mysqli_stmt_execute($stmt);
//         mysqli_stmt_close($stmt);

//         echo 'Payment successful and property availability updated.';
//     } else {
//         echo 'Payment status: ' . $payment_status . ' - ' . $resultDesc;
//     }

//     exit();
// }

$config = array(
    "env"              => "sandbox",
    "BusinessShortCode"=> "174379",
    "key"              => "LXu2ZGQCFSuLXE9R4Ifb9krQIX0fOY5Zr0sjgAHGlwAPSF4R",
    "secret"           => "d0kofqc8IYQp4QQy5Be0vJlBFQv2wwYSrSTsmMtadwISIk3Ew74PUq3HkmbUHjVt",
    "TransactionType"  => "CustomerPayBillOnline",
    "passkey"          => "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919",
    "CallBackURL"      => "https://753a-102-215-33-204.ngrok-free.app/projects/php/callback.php", //When using localhost, Use Ngrok to forward the response to your Localhost
    "AccountReference" => "KREPM LD",
    "TransactionDesc"  => "Property Payment - ID: $property_id",
);


if (isset($_POST['pay-btn'])) {
    $property_id = intval($_POST['property_id']);
    $phone = $_POST['MSISDN'];
    $amount = $_POST['payment_amount'];
    $user_id = $_SESSION['user_id']; 
    $payment_method = 'M-PESA';
    $payment_status = 'pending';
    $payment_date = date('Y-m-d H:i:s');
   
    // Uncomment the below when going live or wanting to pay 4 exact total 
    // $amount = $_SESSION['amount']; 

    $access_token = ($config['env']  == "live") ? "https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials" : "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials"; 
    $credentials = base64_encode($config['key'] . ':' . $config['secret']); 

    
    $ch = curl_init($access_token);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Basic " . $credentials]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $response = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($response); 
    $token = isset($result->{'access_token'}) ? $result->{'access_token'} : "N/A";

    $timestamp = date("YmdHis");
    $password  = base64_encode($config['BusinessShortCode'] . "" . $config['passkey'] ."". $timestamp);

    $curl_post_data = array( 
        "BusinessShortCode" => $config['BusinessShortCode'],
        "Password" => $password,
        "Timestamp" => $timestamp,
        "TransactionType" => $config['TransactionType'],
        "Amount" => $amount,
        "PartyA" => $phone,
        "PartyB" => $config['BusinessShortCode'],
        "PhoneNumber" => $phone,
        "CallBackURL" => $config['CallBackURL'],
        "AccountReference" => $config['AccountReference'],
        "TransactionDesc" => $config['TransactionDesc'],
    ); 

    $data_string = json_encode($curl_post_data);


    $endpoint = ($config['env'] == "live") ? "https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest" : "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest"; 


    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer '.$token,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response     = curl_exec($ch);
    curl_close($ch);

    
    $result = json_decode(json_encode(json_decode($response)), true);

    // file_put_contents('tests_log',  $result, FILE_APPEND);
    

    if($result['ResponseCode'] === "0"){         //STK Push request successful

        $MerchantRequestID = $result['MerchantRequestID'];
        $CheckoutRequestID = $result['CheckoutRequestID'];

        // Insert the initial payment record into the database
        $sql = "INSERT INTO payments (property_id, user_id, payment_amount, phone, payment_method, payment_status, payment_date) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iiiisss", $property_id, $user_id, $amount, $phone, $payment_method, $payment_status, $payment_date);
        mysqli_stmt_execute($stmt);
        $_SESSION['payment_id'] = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt);

        header('location: dashboard.php');

    }else{
        echo 'error message found';
    }
}

?>
