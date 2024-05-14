<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db = "krepm_db";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "</br>");
}

// Check if user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

// Get user data
$user_id = $_SESSION['user_id'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password']; // Sanitize password before processing (see note)

    // **Sanitize password input (important!)** 
    // Use a password hashing function like password_hash() before storing in database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); 

    // Update user information query
    $sql = "UPDATE Users SET email = '$email', phone = '$phone', password = '$hashed_password' WHERE user_id = $user_id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Add activity to activities table
        $activity_description = "User with ID $user_id updated their information.";
        $sql_activity = "INSERT INTO activities (activity_description) VALUES ('$activity_description')";
        mysqli_query($conn, $sql_activity);
        $_SESSION['success_message'] = 'User information updated successfully!';
    } else {
        $_SESSION['error_message'] = 'Error updating user information: ' . mysqli_error($conn);
    }
}

mysqli_close($conn); // Close database connection
header('location: dashboard.php');
?>