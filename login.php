<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require_once './data/db.php';

$errorMessage = ""; // Initialize empty variable for error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
          // Update user's activity status to active
          $user_id = $row['user_id'];
          $update_sql = "UPDATE Users SET is_active = 1 WHERE user_id = $user_id";
          mysqli_query($conn, $update_sql);
          // Log activity
          $action_description = "User logged in: " . $row['full_name'];
          $current_date_time = date("Y-m-d H:i:s");
          $insert_query = "INSERT INTO activities (user_id, activity_description, activity_date) VALUES ($user_id, '$action_description', '$current_date_time')";
          $insert_result = mysqli_query($conn, $insert_query);
          if (!$insert_result) {
              echo "Error logging activity: " . mysqli_error($conn);
          }
          // set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['full_name'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == 'admin') {
              header("Location: admin_panel.php");
            } else {
              header("Location: properties.php");
            }
            exit();
        } else {
          $errorMessage = "Invalid password";
        }
    } else {
      $errorMessage = "User not found";
    }
}
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    .error-message {
      color: red;
      font-weight: bold;
      margin-bottom: 10px;
    }
    body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
  margin: 0;
  padding: 0;
}
.login-section {
  background-image: url('./assets/images/hero-banner.jpg');
  background-size: cover;
  background-position: center;
}

.form-container {
  width: 100%;
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f0f7ff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
}

h2 {
  text-align: center;
  margin-bottom: 20px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="email"], input[type="password"], select {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ddd;
  border-radius: 3px;
}

button[type="submit"] {
  text-align: center;
  font-weight: bold;
  width: 100%;
  padding: 10px;
  background-color: #fa5b3d;
  border: black;
  border-radius: 5px;
  color: black;
  cursor: pointer;
  margin-inline: auto;
}

button[type="submit"]:hover {
  background: white;
  color: black;
  border-color: transparent;
  text-align: center;
  
}

a {
  color: red;
  text-decoration: none;
  font-weight: bold;
}

a:hover {
  color: green;
}

@media screen and (max-width: 768px) {
  .form-container {
    padding: 10px;
  }
}
  </style>

  <!-- favicon-->
  <!-- custom css link-->
  <link rel="stylesheet" href="./assets/css/style.css">

  <!-- google font link-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet">
</head>

<body>

  <!-- #HEADER-->

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
            <ul class="navbar-list">
              <li>
                <a href="./index.php" class="navbar-link" data-nav-link>Home</a>
              </li>
              <li>
                <a href="./signup.php" class="navbar-link" data-nav-link>Sign Up</a>
              </li>

            </ul>
          </div>

        </nav>

        <div class="header-bottom-actions">
          <div class="dropdown">
            <button class="header-bottom-actions-btn" aria-label="Profile" id="dropdown-btn">
              <ion-icon name="person-outline"></ion-icon>
              <span>Profile</span>
            </button>
        
            <div id="dropdown-content" class="dropdown-content">
              <a href="./login.php">Login</a>
              <a href="./signup.php">Signup</a>
            </div>
          </div>

          <button class="header-bottom-actions-btn" data-nav-open-btn aria-label="Open Menu">
            <ion-icon name="menu-outline"></ion-icon>
            <span>Menu</span>
          </button>
        </div>
      </div>
    </div>

  </header>
  <!--main-->
  <main>
    <!--sign in section-->
    <div class="login-section">
        <section class="form-container">
            <form action="" method="post">
                <h2>Welcome back!</h2>
                <?php if (!empty($errorMessage)) : ?>
                <div class="error-message">
                <?php echo $errorMessage; ?>
                </div>
                <?php endif; ?>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required maxlength="50" placeholder="Enter your email" class="box" autocomplete="on">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required maxlength="50" placeholder="Enter your password" class="box">
                <br>
                <p>don't have an account? <a href="./signup.php">register new</a></p><br>
                <button type="submit"> Log in</button>
            </form>
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
              <a href="/properties.php" class="footer-link">Properties</a>
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
  <script src="./assets/js/script.js"></script>

  <!-- ionicon link-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>