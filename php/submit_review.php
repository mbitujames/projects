<?php
require_once '../data/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];
    $user_image_url = '';

    // Handle file upload
    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["user_image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["user_image"]["tmp_name"]);
        if($check !== false) {
            if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
                $user_image_url = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        } else {
            echo "File is not an image.";
            exit();
        }
    }

    // Prepare SQL and bind parameters
    $stmt = $conn->prepare("INSERT INTO Testimonials (username, user_image_url, rating, review) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $username, $user_image_url, $rating, $review);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Review submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
