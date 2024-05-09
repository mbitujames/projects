<?php
session_start();
require_once './data/db.php';

echo "Script is executed.<br>";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    echo "Form is submitted.<br>";

    // Retrieve form data
    $user_id = $_POST['user_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo "User ID: $user_id<br>";
    echo "Email: $email<br>";
    echo "Password: $password<br>";

    // Hash the password before updating
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    echo "Hashed Password: $hashedPassword<br>";

    // Prepare and execute the SQL query to update user data in the db
    $sql = "UPDATE users SET email = ?, password = ? WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        echo "Statement prepared successfully.<br>";

        mysqli_stmt_bind_param($stmt, "ssi", $email, $hashedPassword, $user_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "User information updated successfully!<br>";

            // Log activity in the activity table
            $action_description = "Admin updated user details";
            $current_date_time = date("Y-m-d H:i:s");
            $insert_activity_query = "INSERT INTO activities (activity_description, activity_date) VALUES (?, ?)";
            $stmt_activity = mysqli_prepare($conn, $insert_activity_query);

            if ($stmt_activity) {
                mysqli_stmt_bind_param($stmt_activity, "ss", $action_description, $current_date_time);
                mysqli_stmt_execute($stmt_activity);
                mysqli_stmt_close($stmt_activity);

                // Redirect back to the admin panel or wherever appropriate
                mysqli_close($conn);
                echo "Activity logged and user information updated successfully!<br>";
                header('Location: admin_panel.php');
                exit;
            } else {
                // Error preparing the statement to log activity
                echo "Error preparing statement to log activity: " . mysqli_error($conn);
            }
        } else {
            // Error updating user information
            echo "Error updating user information: " . mysqli_error($conn);
        }
    } else {
        // Error preparing the statement
        echo "Error preparing statement: " . mysqli_error($conn);
    }
} else {
    echo "Form is not submitted.<br>";
}

// Close the database connection
mysqli_close($conn);
?>
