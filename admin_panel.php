<!DOCTYPE html>
<html lang="en">
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
  // Retrieve form data
  $title = $_POST['title'];
  $description = $_POST['description'];
  $location = $_POST['location'];
  $status = $_POST['status'];
  $price = $_POST['price'];
  $bedrooms = $_POST['bedrooms'];
  $bathrooms = $_POST['bathrooms'];
  $square_ft = $_POST['square_ft'];
  $property_type = $_POST['property_type'];
  $keyword = $_POST['keyword']; // Add keyword variable

  // Handle file upload
if ($_FILES['image']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['image']['tmp_name'])) {
  $uploadDir = './data/uploads/';
  $filename = uniqid('img_') . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
  if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename)) {
      // Construct the image URL
      $image_url = $uploadDir . $filename;

      // Prepare and execute the SQL query to insert property data
      $sql = "INSERT INTO properties (title, description, location, status, price, bedrooms, bathrooms, square_ft, property_type, image_url, keyword) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "ssssiiiisss", $title, $description, $location, $status, $price, $bedrooms, $bathrooms, $square_ft, $property_type, $image_url, $keyword); // Removed one "s" from the bind_param
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);

      // Log the activity in the activities table
      $action_description = "Admin added a new property: $title";
      $current_date_time = date("Y-m-d H:i:s");
      $insert_activity_query = "INSERT INTO activities (activity_description, activity_date) VALUES ('$action_description', '$current_date_time')";
      
      if (mysqli_query($conn, $insert_activity_query)) {
          echo "Activity logged successfully.";
      } else {
          echo "Error logging activity: " . mysqli_error($conn);
      }

      // Redirect to admin_panel.php after inserting the property
      header('Location: admin_panel.php');
      exit;
  } else {
      // Error moving file
      echo "Error uploading image.";
  }
} else {
  // No file uploaded or error occurred
  echo "Please select an image file.";
}
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    
    <link rel="stylesheet" href="./assets/css/admin.css">
    <link rel="stylesheet" href="./assets/css/style.css">

    <!-- google font link-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
      href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Poppins:wght@400;500;600;700&display=swap"
      rel="stylesheet">
</head>
<body>
  <header class="header" data-header>
    <div class="overlay" data-overlay></div>
    <div class="header-bottom">
      <div class="container">
        <a href="#home" class="logo">
        <img src="./assets/images/logo1.jpg" alt="KREPM">
        </a>
        <nav class="navbar" data-navbar>
          <div class="navbar-top">
              a href="#home" class="logo">
                <img src="./assets/images/logo1.jpg" alt="KREPM">
              </a>

              <button class="nav-close-btn" data-nav-close-btn aria-label="Close Menu">
                  <ion-icon name="close-outline"></ion-icon>
              </button>
          </div>

          <div class="navbar-bottom">
              <ul class="navbar-list">
                  <li>
                      <a href="index.php" class="navbar-link" data-nav-link>Home</a>
                  </li>
                  <li>
                      <a href="update_user.php" class="navbar-link" data-nav-link>Update User</a>
                  </li>
                  <li>
                      <a href="#recent-activities" class="navbar-link" data-nav-link>Recent Activities</a>
                  </li>
                  <li>
                      <a href="#add-property" class="navbar-link" data-nav-link>Add Properties</a>
                  </li>
                  <li>
                      <a href="#properties" class="navbar-link" data-nav-link>Properties</a>
                  </li>
              </ul>
          </div>
        </nav>
        <div class="header-bottom-actions">
          <button class="btn cta-btn">
            <a href="./logout.php"><span>Logout</span></a>
          </button>

          <button class="header-bottom-actions-btn" data-nav-open-btn aria-label="Open Menu">
            <ion-icon name="menu-outline"></ion-icon>
            <span>Menu</span>
          </button>
        </div>
      </div>
    </div>
  </header>
  <main>
    <div class="container">
      <div class="dashboard">
        <h1>KREPM ADMINISTRATION PANEL</h1>
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <hr>
        <p>Manage your properties, users, and reports here.</p></br>
      </div>

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

      <div class="card recent-activities">
        <h2>Recent Activities</h2>
        <ul>
          <?php
            // PHP code to retrieve recent activities from the database (same as before)
            require_once './data/db.php';
            $query = "SELECT * FROM Activities ORDER BY activity_date DESC LIMIT 5";
            $result = mysqli_query($conn, $query);
            //check if there are any results
            if (mysqli_num_rows($result) > 0) {
              //loop through each row and display the activities
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>" . $row['activity_description'] . " - " . $row['activity_date'] . "</li>";
              }
            } else {
              echo "<li>No recent activities found.</li>";
            }
          ?>
        </ul>
      </div>
      
      <section class="update-user">
          <div class="card">
              <h2>Update Users Information</h2>
              <form id="update-user-form" action="update_user.php" method="post">
                <!-- Admin should specify the user ID -->
                <?php if (isset($_SESSION['admin'])): ?>
                  <div class="form-group">
                    <label for="user_id">User ID:</label>
                    <input type="text" name="user_id" id="user_id" required>
                  </div>
                <?php endif; ?>
                <div class="form-group">
                  <label for="full_name">Full Name:</label>
                  <input type="text" name="full_name" id="full_name" required>
                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" name="email" id="email" class="custom-input" autocomplete="on">
                </div>
                <div class="form-group">
                  <label for="phone">Phone Number:</label>
                  <input type="tel" name="phone" id="phone" class="custom-input" placeholder="e.g. 0712345678" autocomplete="on">
                </div>
                <div class="form-group">
                  <label for="password">Password:</label>
                  <input type="password" name="password" id="password">
                  <span class="hint">Leave empty to keep current password.</span>
                </div>
                <div class="form-group">
                  <button type="submit">Update Information</button>
                </div>
                <div id="update-message"></div>
              </form>
          </div>
      </section>

      <div class="card add-property">
      <h2>Add Property</h2>
      <form action="admin_panel.php" method="post" enctype="multipart/form-data">
          <label for="title">Title:</label>
          <input type="text" id="title" name="title" required>
          
          <label for="description">Description:</label>
          <textarea id="description" name="description" required></textarea>
          <label for="location">Location:</label>
          <input type="text" id="location" name="location" required>

          <label for="status">Status:</label>
          <select id="status" name="status" required>
          <option value="For Sale ">For Sale</option>
          <option value="For Rent">For Rent</option>
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

          <label for="image">Image:</label>
          <input type="file" id="image" name="image" accept="image/*" required>

          <label for="keyword">Keyword(s):</label>
          <input type="text" id="keyword" name="keyword" required>
        
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
      <section id="reports" class="card">
            <!-- Reports Section -->
            <h2>Reports</h2>
            <!-- Add functionality to print reports -->
            <button onclick="window.print()">Print Reports</button>
        </section>
    </div>
  </main>
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
  
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  </body>
</html>