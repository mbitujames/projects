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
    $user_id = $_POST['user_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Update user information in the database
    $sql = "UPDATE users SET email = ?, password = ? WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssi", $email, $hashedPassword, $user_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // User information updated successfully
            mysqli_stmt_close($stmt);
            
            // Log activity in the activity table
            $action_description = "Admin updated user details";
            $current_date_time = date("Y-m-d H:i:s");
            $insert_activity_query = "INSERT INTO activities (activity_description, activity_date) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $insert_activity_query);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ss", $action_description, $current_date_time);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                
            // Redirect back to the admin panel or wherever appropriate
            header('Location: admin_panel.php');
            exit;
        } else {
            // Error preparing the statement to log activity
            echo "Error preparing statement to log activity: " . mysqli_error($conn);
        }
        } else {
            // Error updating user information
            echo "Error updating user information.";
        }
    } else {
        // Error preparing the statement
        echo "Error preparing statement: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
