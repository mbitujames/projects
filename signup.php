<!DOCTYPE html>
<html lang="en">

<?php
// Include database connection file
include_once './data/db.php';

$signup_success_message = "";  // Initialize empty variable for success message

// Process signup form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];  
    $email = $_POST['email'];
    $role = $_POST['user_type'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Insert user data into the database
    $sql = "INSERT INTO Users (username,full_name,phone, email, role, password) VALUES ('$username','$full_name','$phone', '$email', '$role', '$password')";
    if (mysqli_query($conn, $sql)) {
      $signup_success_message = "Sign Up Successful!";  // update success message

      // Retrieve the user_id of the newly signed-up user
      $user_id = mysqli_insert_id($conn);

        // Insert activity into the Activities table
        $action_description = "New user signed up: $full_name";
        $current_date_time = date("Y-m-d H:i:s");
        $insert_activity_query = "INSERT INTO Activities (user_id, activity_description, activity_date) VALUES ('$user_id', '$action_description', '$current_date_time')";
        
        if (mysqli_query($conn, $insert_activity_query)) {
            echo "Activity logged successfully.";
        } else {
            echo "Error logging activity: " . mysqli_error($conn);
        }
      
        // Redirect user to login page after a short delay
        header("Refresh: 3; url=login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup</title>
  <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .logo img {
        max-width: 100px; /* Adjust this value to reduce the size of the logo image */
        height: auto;
    }
    .signup-section {
        background-image: url('./assets/images/hero-banner.jpg');
        background-size: cover;
        background-position: center;
}
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }
    .form-container {
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
        padding: 20px 0;
        background-color: #f0f7ff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        box-sizing: border-box;
    }
    form {
        display: flex;
        flex-direction: column;
    }
    label {
        margin-bottom: 5px;
        display: block;
    }
    input, select {
        width: 100%;
        margin-bottom: 20px;
        padding: 10px;
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
    
    button:hover {
        background: white;
        color: black;
        border-color: black;
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
    @media (max-width: 768px) {
        .form-container {
            width: 100%;
            padding: 0;
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
<header>
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
                    <a href="./login.php" class="navbar-link" data-nav-link>Log in</a>
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
</header>  
<main>
    <!--sign up section-->
    <div class="signup-section">
    <section class="form-container">
    <?php
    if (!empty($signup_success_message)) : ?>
    <p style='color: green;'><?php echo $signup_success_message; ?></p>
    <?php endif; ?>
        <form action="" method="post" onsubmit="return validatePassword()">
            <h2>Create an account!</h2>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required maxlength="50" placeholder="Enter your username" class="box" autocomplete="on"> 
            <label for="full_name">Full name</label>
            <input type="text" id="full_name" name="full_name" required maxlength="50" placeholder="Enter your full name" class="box">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" required maxlength="10" placeholder="Enter your phone number" class="box" autocomplete="on">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required maxlength="50" placeholder="Enter your email" class="box" autocomplete="on">
            <label for="user_type">User Type</label>
            <select name="user_type" id="user_type">
            <option value="admin">Admin</option>
            <option value="user">User</option>
            </select>
            <br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required maxlength="50" placeholder="Enter your password" class="box">
            <label for="password">Confirm Password</label>
            <input type="password" id="cpassword" name="cpassword" required maxlength="50" placeholder="Confirm your password" class="box">
            <!-- A div to display password requirements -->
            <div id="password-requirements" style="display: none; color: red;">
            </div>
            <p>already have an account? <a href="./login.php">Login now</a></p><br>
            <button type="submit"> Sign Up</button>
        </form>
    </section>
</div>

</main>
<!-- #FOOTER-->
<footer class="footer">
  <div class="footer-top">
    <div class="container">
      <div class="footer-brand">
        <a href="./login.php" class="logo">
          <img src="./assets/images/favicon.ico" alt="KREPM logo">
          <p >Kitale Real Estate & Property Management </p>
        </a>

        <p class="section-text">
          Feel free to explore our website and contact us for any inquiries or assistance.
        </p>

        <ul class="contact-list">
          <li>
            <a href="index.php" class="contact-link">
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
  <script src="./assets/js/script.js"></script>
  <!-- the JavaScript validation -->
  <script src="./assets/js/password-validation.js"></script>

  <!-- ionicon link-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>