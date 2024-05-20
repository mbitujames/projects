<?php
session_start();

// Allow requests from all origins
header("Access-Control-Allow-Origin: *");
// Allow the following methods from the frontend
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE, OPTIONS");
// Allow the following headers from the frontend
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Check if the user is logged in or is an admin
if (!isset($_SESSION['loggedin']) && !isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit;
} 
$servername = "localhost";
$username = "root";
$password = "";
$db = "krepm_db";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get user ID to update 
  $user_id = isset($_SESSION['admin']) ? $_POST['user_id'] : $_SESSION['user_id'];

  // Get form data
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];

  // Check if the password is provided
  $password_query = empty($password) ? "" : ", password = '" . password_hash($password, PASSWORD_DEFAULT) . "'";

  // Update user information query
  $sql = "UPDATE users SET full_name = '$full_name', email = '$email', phone = '$phone' $password_query WHERE user_id = $user_id";

  $result = mysqli_query($conn, $sql);

  if ($result) {
      $message = 'User information updated successfully!';
      // Log activity
      $action_description = "User updated their information";
      $current_date_time = date("Y-m-d H:i:s");
      $insert_activity_query = "INSERT INTO activities (user_id, activity_description, activity_date) VALUES ('$user_id', '$action_description', '$current_date_time')";
      mysqli_query($conn, $insert_activity_query);
  } else {
      $message = 'Error updating user information: ' . mysqli_error($conn);
  }

  // Set success or error message based on the result
  $_SESSION['update_message'] = $message;
  // Respond with JSON indicating success or failure
  header('Content-Type: application/json');
  echo json_encode(['success' => $result, 'message' => $message]);
  exit;
}

//mysqli_close($conn); // Close database connection

// Redirect back to the appropriate page
if (isset($_SESSION['admin'])) {
  header('Location: admin_panel.php'); // Redirect to admin panel if the update was done by an admin
} else {
  header('Location: dashboard.php'); // Redirect to user dashboard if the update was done by the logged-in user
}
?>

