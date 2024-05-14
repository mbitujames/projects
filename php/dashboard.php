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
    .sidebar {
    height: 100%;
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #f2f6f7;
    padding-top: 20px;
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
    background-color: #f0f0f0;
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
    width: 40%;
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
    width: 20%;
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
            <li><a href="./index.php">Home</a></li>
            <li><a href="#profile">Profile</a></li>
            <li><a href="./properties.php">Listed Properties</a></li> <!--./properties.php-->
            <li><a href="#settings">Settings</a></li>
            <li><a href="#reports">Reports</a></li>
            <button><span> <a href="logout.php">Logout</a></span></button>
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
            <img src="<?php echo $user['avatar_url']; ?>" alt="User Image">
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

        <section id="settings" class="card">
            <!-- Settings Section -->
            <h2>Settings</h2>
            <!-- Display success or error message -->
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="success-message"><?php echo $_SESSION['success_message']; ?></div>
                <?php unset($_SESSION['success_message']); ?>
                <?php elseif (isset($_SESSION['error_message'])): ?>
                    <div class="error-message"><?php echo $_SESSION['error_message']; ?></div>
                    <?php unset($_SESSION['error_message']); ?>
                    <?php endif; ?>
            <!-- Form to update user details -->
            <form action="update_dashboard.php" method="post">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" autocomplete="on"><br><br>
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $user['phone']; ?>" autocomplete="on"><br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password"><br><br>
                <button type="submit" id="update">Update Information</button>
            </form>
        </section>

        <section id="reports" class="card">
            <!-- Reports Section -->
            <h2>Reports</h2>
            <!-- Add functionality to print reports -->
            <button onclick="window.print()">Print Reports</button>
        </section>
    </div>
</body>
</html>