<?php
session_start();
require_once './data/db.php';

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
    header('Location: login.php');
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Update user information in the database
    $sql = "UPDATE users SET email = ?, password = ? WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $email, $hashedPassword, $username);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // User information updated successfully
            // Redirect back to the admin panel or wherever appropriate
            header('Location: admin_panel.php');
            exit;
        } else {
            // Error updating user information
            echo "Error updating user information.";
        }

        mysqli_stmt_close($stmt);
    } else {
        // Error preparing the statement
        echo "Error preparing statement: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
