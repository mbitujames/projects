<?php
session_start();
require_once './data/db.php';

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
    header('Location: login.php');
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $status = $_POST['status'];
    $price = $_POST['price'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $square_ft = $_POST['square_ft'];
    $property_type = $_POST['property_type'];
    $image_url = $_POST['image_url'];

    // Prepare and execute the SQL query to insert property data
    $sql = "INSERT INTO properties (title, description, location, status, price, bedrooms, bathrooms, square_ft, property_type, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssiiiiis", $title, $description, $location, $status, $price, $bedrooms, $bathrooms, $square_ft, $property_type, $image_url);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirect to admin_panel.php after inserting the property
    header('Location: admin_panel.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="./assets/css/admin.css">
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <!-- custom css link-->
    <link rel="stylesheet" href="./assets/css/style.css">

    <!-- google font link-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
      href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Poppins:wght@400;500;600;700&display=swap"
      rel="stylesheet">
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>

</head>
<body>

  <header class="header" data-header>

  <div class="overlay" data-overlay></div>

  <div class="header-bottom">
    <div class="container">

      <a href="./index.php" class="logo">
        <img src="./assets/images/logo1.jpg" alt="KREPM">
      </a>

      <nav class="navbar" data-navbar>
        <div class="navbar-top">
          <a href="./index.php" class="logo">
            <img src="./assets/images/logo1.jpg" alt="KREPM">
          </a>

          <button class="nav-close-btn" data-nav-close-btn aria-label="Close Menu">
            <ion-icon name="close-outline"></ion-icon>
          </button>
        </div>

        <div class="navbar-bottom">
          <h2>Admin Panel</h2>
        </div>
        <button class="btn cta-btn">
          <a href="./logout.php"><span>Logout</span></a>
        </button>
      </nav>

    </div>
  </div>

</header>

    <div class="container">
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <hr>
  
    <div class="card total-users">
    <h2>Total Users</h2>
    <p>
      <?php
        // PHP code to retrieve total users from the database (same as before)
        require './data/db.php';
        $query = "SELECT COUNT(user_id) AS total_users FROM Users";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          echo "Total users: " . $row['total_users'];
        } else {
          echo "No users found.";
        }
      ?>
    </p>
    </div>
    <section class="update-user">
  <div class="card">
    <h2>Update User</h2>
    <form action="update_user.php" method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <button type="submit" name="submit">Update User</button>
    </form>
  </div>
</section>

    <div class="card recent-activities">
      <h2>Recent Activities</h2>
      <ul>
        <?php
          // PHP code to retrieve recent activities from the database (same as before)
          $query = "SELECT * FROM Activities ORDER BY activity_date DESC LIMIT 5";
          $result = mysqli_query($conn, $query);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<li>" . $row['activity'] . " - " . $row['activity_date'] . "</li>";
            }
          } else {
            echo "<li>No recent activities found.</li>";
          }
        ?>
      </ul>
    </div>
    <div class="card add-property">
    <h2>Add Property</h2>
    <form action="admin_panel.php" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
        <option value="buy">For Sale</option>
        <option value="rent">For Rent</option>
        </select>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>

        <label for="bedrooms">Bedrooms:</label>
        <input type="number" id="bedrooms" name="bedrooms" required>

        <label for="bathrooms">Bathrooms:</label>
        <input type="number" id="bathrooms" name="bathrooms" required>

        <label for="square_ft">Square Ft:</label>
        <input type="number" id="square_ft" name="square_ft" required>

        <label for="property_type">Type:</label>
        <select id="property_type" name="property_type" required>
        <option value="rent">Rent</option>
        <option value="sale">Sale</option>
        </select>

        <label for="image_url">Image URL:</label>
        <input type="url" id="image_url" name="image_url" required>
      
        <button type="submit" name="submit">Add Property</button>
    </form>
    </div>
    <div class="card properties">
  <h2>Properties</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Location</th>
        <th>Status</th>
        <th>Price</th>
        <th>Bedrooms</th>
        <th>Bathrooms</th>
        <th>Square Ft</th>
        <th>Type</th>
        <th>Image</th>
      </tr>
    </thead>
    <tbody>
      <?php
      //Query to fetch properties from your Properties table
      $query = "SELECT * FROM Properties ORDER BY property_id DESC"; 
      $result = mysqli_query($conn, $query);
      // Check if the query was successful
      if ($result === false) {
        echo "<tr><td colspan='10'>Error fetching properties: " . mysqli_error($conn) . "</td></tr>";
      } else {
        echo "Number of properties found: " . $result->num_rows . "<br>"; // Add this line
        // Fetch and display properties
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row['property_id'] . "</td>";
          echo "<td>" . $row['title'] . "</td>";
          echo "<td>" . $row['location'] . "</td>";
          echo "<td>" . $row['status'] . "</td>";
          echo "<td>" . $row['price'] . "</td>";
          echo "<td>" . $row['bedrooms'] . "</td>";
          echo "<td>" . $row['bathrooms'] . "</td>";
          echo "<td>" . $row['square_ft'] . "</td>";
          echo "<td>" . $row['property_type'] . "</td>";
          echo "<td><img src='" . $row['image_url'] . "' alt='" . $row['title'] . "' class='table-image'></td>";
          echo "</tr>";
        }
      }
      ?>
    </tbody>
  </table>
</div>

</body>


<!-- #FOOTER-->
<footer class="footer">
    <div class="footer-top">
      <div class="container">
        <div class="footer-brand">
          <a href="./index.php" class="logo">
            <img src="./assets/images/favicon.ico" alt="KREPM logo">
            <p >Kitale Real Estate & Property Management </p>
          </a>

          <p class="section-text">
            Feel free to explore our website and contact us for any inquiries or assistance.
          </p>

          <ul class="contact-list">
            <li>
              <a href="./index.php" class="contact-link">
                <ion-icon name="location-outline"></ion-icon>
                <address>4th Floor, One Tana Towers, Kitale</address>
              </a>
            </li>

            <li>
              <a href="tel:+254716519766" class="contact-link">
                <ion-icon name="call-outline"></ion-icon>
                <span>+254716519766</span>
              </a>
            </li>

            <li>
              <a href="mailto:mbitumutonga@gmail.com" class="contact-link" target="_blank">
                <ion-icon name="mail-outline"></ion-icon>
                <span>mbitumutonga@gmail.com</span>
              </a>
            </li>

          </ul>

          <ul class="social-list">
            <li>
              <a href="https://www.facebook.com/MbituJames" class="social-link" target="_blank">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>

            <li>
              <a href="https://x.com/mbituke?t=mv9XXsRlVtVuec1vDPbUbQ&s=09" class="social-link" target="_blank">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>

            <li>
              <a href="https://www.linkedin.com/in/mbitujames/" class="social-link" target="_blank">
                <ion-icon name="logo-linkedin"></ion-icon>
              </a>
            </li>
          </ul>
        </div>

        <div class="footer-link-box">
          <ul class="footer-list">
            <li>
              <p class="footer-list-title">Company</p>
            </li>

            <li>
              <a href="./index.php" class="footer-link">About Us</a>
            </li>

            <li>
              <a href="./index.php" class="footer-link">Reviews</a>
            </li>

            <li>
              <a href="./properties.php" class="footer-link">Properties</a>
            </li>

            <li>
              <a href="./index.php" class="footer-link">Contact us</a>
            </li>

          </ul>

          <ul class="footer-list">
            <li>
              <p class="footer-list-title">Services</p>
            </li>
            <li>
              <a href="./login.php" class="footer-link">Login</a>
            </li>

            <li>
              <a href="./admin_panel.php" class="footer-link">My account</a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        <p class="copyright">
          &copy; 2024 <a href="./index.php">Kitale Real Estate & Property Management</a>. All Rights Reserved
        </p>
      </div>
    </div>
  </footer>

  <!-- custom js link-->
  <script src="./assets/js/admin.js"></script>

  <!-- ionicon link-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</html>