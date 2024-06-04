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
// echo "Connection successfully created</br>";


// Fetch user data from the database
$user_id = $_SESSION['user_id']; // Assuming you store user ID in session
$sql = "SELECT * FROM users WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Fetch count of listed properties for rent and for sale
$sqlRent = "SELECT COUNT(*) AS rent_count FROM properties WHERE property_type = 'rent' AND status = 'For Rent'";
$sqlSale = "SELECT COUNT(*) AS sale_count FROM properties WHERE property_type = 'buy' AND status = 'For Sale'";
$sqlTotal = "SELECT COUNT(property_id) AS total_count FROM properties";
$resultRent = mysqli_query($conn, $sqlRent);
$resultSale = mysqli_query($conn, $sqlSale);
$resultTotal = mysqli_query($conn, $sqlTotal);
$rent_count = mysqli_fetch_assoc($resultRent)['rent_count'];
$sale_count = mysqli_fetch_assoc($resultSale)['sale_count'];
$total_count = mysqli_fetch_assoc($resultTotal)['total_count'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
    /* Sidebar Styles */
    section {
    margin-bottom: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    transition: box-shadow 0.3s ease;
}

section:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}
    .sidebar {
    height: 100%;
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #fff2f0;
    padding-top: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
    }
    .sidebar:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); 
    }

    .sidebar h2 {
    color: black;
    text-align: center;
    }

    .sidebar ul {
    list-style-type: none;
    padding: 0;
    }

    .sidebar li {
    padding: 10px;
    }

    .sidebar a {
    text-decoration: none;
    color: black;
    }

    /* Content Styles */
    .content {
    margin-left: 250px;
    padding: 20px;
    }

    .card {
    background-color:#f0f7ff;
    margin-bottom: 20px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card img {
    width: 100px;
    height: auto;
    display: block;
    margin-bottom: 10px;
    border-radius: 50%;
    }
    .welcome-text {
    font-weight: bold;
    font-size: 30px;
    color: brown;
    text-align: center;
    }
    button{
    float: bottom;
    width: 80%;
    background-color:#fa5b3d;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 12px 24px;
    font-size: 18px;
    cursor: pointer;
    text-align: center;
    transition: background-color 0.3s, color 0.3s;
    }
    button:hover{
    background-color: white;
    color: #333;
    }
    .card button {
    width: 100%;
    background-color:#fa5b3d;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 12px 24px;
    font-size: 18px;
    cursor: pointer;
    text-align: center;
    transition: background-color 0.3s, color 0.3s;
    }
    .card button:hover {
    background-color: white;
    color: #333;
    }
    .success-message {
    color: green; 
    font-size: 14px;
    margin-bottom: 5px; 
    }
    .error-message {
    color: red;
    font-size: 14px;
    margin-bottom: 5px; 
    }
    .form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-group input, .form-group textarea {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
}
    /* Media Queries for Responsive Design */
    /* For screens smaller than 768px (tablets) */
    @media only screen and (max-width: 768px) {
    .sidebar {
        width: 100%; /* Sidebar takes up full width */
        position: relative; /* Remove fixed positioning */
        height: auto; /* Remove fixed height */
    }

    .content {
        margin-left: 0; /* Remove left margin */
    }

    .card button {
        width: 100%; /* Buttons take up full width */
    }}
    /* For screens smaller than 576px (phones) */
    @media only screen and (max-width: 576px) {
    .sidebar {
        padding-top: 10px; /* Adjust padding */
    }

    .card button {
        font-size: 16px; /* Adjust font size for smaller screens */
    }
}

</style>
</head>

<body>
    <div class="sidebar">
        <h2>User Dashboard</h2>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="#profile">Profile</a></li>
            <li><a href="../properties.php">Listed Properties</a></li> 
            <li><a href="#update-information">Update Information</a></li>
            <li><a href="./reports.php">Reports</a></li>
            <button><span> <a href="../logout.php">Logout</a></span></button>
        </ul>
    </div>
    <div class="content">
        <section id= "welcome" class="card">
            <p class="welcome-text">Welcome, <?php echo $user['username'];?>!</p>
            <p>This is your personal dashboard where you can update your details and view your reports.</p>
        </section>
        <section id="profile" class="card">
            <!-- Profile Section -->
            <h2>Profile</h2>
            <p>Username: <?php echo $user['username']; ?></p>
            <p>Email: <?php echo $user['email']; ?></p>
        </section>

        <section id="listed-properties" class="card">
            <!-- Listed Properties Section -->
            <h2>Listed Properties</h2>
            <p>Properties for Rent: <?php echo $rent_count; ?></p>
            <p>Properties for Sale: <?php echo $sale_count; ?></p>
            <p>Total Properties: <?php echo $total_count; ?></p>
        </section>

        <section id="update-information" class="card">
            <!-- Settings Section -->
            <h2>Update Your Information</h2>
            <!-- Display success or error message -->
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="success-message"><?php echo $_SESSION['success_message']; ?></div>
                <?php unset($_SESSION['success_message']); ?>
                <?php elseif (isset($_SESSION['error_message'])): ?>
                    <div class="error-message"><?php echo $_SESSION['error_message']; ?></div>
                    <?php unset($_SESSION['error_message']); ?>
                    <?php endif; ?>
            <!-- Form to update user details -->
            <form action="update_dashboard.php" method="post" onsubmit="return validateSettingsForm()">
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" value="<?php echo $user['full_name']; ?>" required><br><br>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" autocomplete="on"><br><br>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $user['phone']; ?>" autocomplete="on"><br><br>
            </div>
            <div class="form-group">
                <label for="avatar_url">Profile Picture URL:</label>
                <input type="url" id="avatar_url" name="avatar_url" value="<?php echo $user['avatar_url']; ?>"><br><br>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password"><br><br>
            </div>
                <button type="submit" id="update">Update Information</button>
            </form>
        </section>
        <section id="reviews" class="card">
        <h2>Write a Review</h2>
        <form id="reviewForm" action="submit_review.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Name:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="user_image">Upload Image:</label>
                <input type="file" id="user_image" name="user_image">
            </div>
            <div class="form-group">
                <label for="rating">Rating:</label>
                <input type="number" id="rating" name="rating" step="0.1" min="1" max="5" required>
            </div>
            <div class="form-group">
                <label for="review">Review:</label>
                <textarea id="review" name="review" rows="4" required></textarea>
            </div>
            <button type="submit">Submit Review</button>
        </form>
    </section>
    </div>

    <!--js for validating the settings form-->
    <script>
        function validateSettingsForm() {
        var email = document.getElementById("email").value;
        var phone = document.getElementById("phone").value;
        var password = document.getElementById("password").value;

        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var phonePattern = /^[0-9]{10}$/;
        var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        // Validate Email
        if (!emailPattern.test(email)) {
            alert('Please enter a valid email address.');
            return false;
        }

        // Validate Phone Number
        if (!phonePattern.test(phone)) {
            alert('Phone number must be exactly 10 digits and contain only numbers.');
            return false;
        }

        // Validate Password
        if (!passwordPattern.test(password)) {
            alert('Password must contain at least 8 characters, including uppercase, lowercase, a number, and a special character.');
            return false;
        }

        // All validations passed
        return true;
    }
    document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('reviewForm');

    form.addEventListener('submit', function(event) {
        const rating = parseFloat(document.getElementById('rating').value);
        if (rating < 1 || rating > 5) {
            alert('Rating must be between 1 and 5.');
            event.preventDefault();
        }
    });
    });

    </script>
</body>
</html>