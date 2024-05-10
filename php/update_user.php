<?php
// Enable CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

session_start();
require_once './data/db.php';

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$response = array('success' => false, 'error' => 'Missing required data.');

// Check if required data is received (name and email)
if (isset($_POST['full_name'], $_POST['email'])) {
  $name = mysqli_real_escape_string($conn, $_POST['full_name']); // Sanitize name for security
  $email = mysqli_real_escape_string($conn, $_POST['email']); // Sanitize email for security
  $phone = isset($_POST['phone']) ? mysqli_real_escape_string($conn, $_POST['phone']) : null; // Sanitize phone (optional)

  // Optional password update (handle empty password)
  $password = "";
  if (isset($_POST['password'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security
  }

  // Build the SQL query for update
  $sql = "UPDATE Users SET full_name='$full_name', email='$email'";
  if ($phone) {
    $sql .= ", phone='$phone'";
  }
  if ($password) {
    $sql .= ", password='$password'";
  }
  $sql .= " WHERE email='$email'"; // Update user based on existing email

  // Execute the update query
  $result = mysqli_query($conn, $sql);

  if ($result) {
    if (mysqli_affected_rows($conn) > 0) {
      $response = array('success' => true, 'message' => 'User information updated successfully.');
    } else {
      $response = array('success' => false, 'error' => 'No changes made to user information.');
    }
  } else {
    $response = array('success' => false, 'error' => 'Error updating user information: ' . mysqli_error($conn));
  }
}

// Close connection
//mysqli_close($conn);

// Encode response as JSON and send
header('Content-Type: application/json');
echo json_encode($response);
?>
