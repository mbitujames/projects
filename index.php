<!--check if session exist then redirect to login page-->
<!DOCTYPE html>
<html lang="en">
  <?php
  session_start(); 
  ?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kitale Real Estate & Property Management</title>
  <link rel="stylesheet" href="./assets/css/style.css">
  <!-- google font link-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
  <!-- #HEADER-->
  <?php include './php/components/header.php'; ?>

  <main>
    <article>
      <!-- #HERO-->
      <?php include './php/components/hero.php'; ?>
      <!--SEARCH BAR-->
      <?php include './php/components/search.php'; ?>
      <div id="search-results"></div>
      <!-- ABOUT US SECTION-->
      <?php include './php/components/about.php'; ?>
      <!-- #SERVICE-->
      <?php include './php/components/services.php'; ?>
      <!-- -#PROPERTY LISTING-->
      <?php include './php/components/properties.php'; ?>
      <!-- #FEATURES-->
      <section class="features">
        <div class="container">
          <p class="section-subtitle">Our Amenities</p>
          <h2 class="h2 section-title">Building Amenities</h2>
          <ul class="features-list">
            <li>
              <div class="features-card">
                <div class="card-icon">
                  <ion-icon name="car-sport-outline"></ion-icon>
                </div>
                <h3 class="card-title">Parking Space</h3>
              </div>
            </li>

            <li>
              <div class="features-card">
                <div class="card-icon">
                  <ion-icon name="water-outline"></ion-icon>
                </div>
                <h3 class="card-title">Swimming Pool</h3>
              </div>
            </li>

            <li>
              <div class="features-card">
                <div class="card-icon">
                  <ion-icon name="shield-checkmark-outline"></ion-icon>
                </div>
                <h3 class="card-title">Private Security</h3>
              </div>
            </li>

            <li>
              <div class="features-card">
                <div class="card-icon">
                  <ion-icon name="fitness-outline"></ion-icon>
                </div>
                <h3 class="card-title">Medical Center</h3>
              </div>
            </li>

            <li>
              <div class="features-card">
                <div class="card-icon">
                  <ion-icon name="library-outline"></ion-icon>
                </div>
                <h3 class="card-title">Library Area</h3>
              </div>
            </li>

            <li>
              <div class="features-card">
                <div class="card-icon">
                  <ion-icon name="bed-outline"></ion-icon>
                </div>
                <h3 class="card-title">King Size Beds</h3>
              </div>
            </li>

            <li>
              <a href="#" class="features-card">
                <div class="card-icon">
                  <ion-icon name="football-outline"></ion-icon>
                </div>
                <h3 class="card-title">Kid’s Playland</h3>
              </a>
            </li>

          </ul>

        </div>
      </section>

      <?php
      // Database connection
      require ('./data/db.php');
      // Fetch reviews from the database
      $sql = "SELECT username, user_image_url, rating, review FROM Testimonials ORDER BY rating DESC LIMIT 6";
      $result = $conn->query($sql);
      ?>

      <!-- #REVIEWS-->
      <section class="reviews" id="reviews">
          <div class="container">
              <p class="section-subtitle">Reviews</p>
              <h2 class="h2 section-title">Latest Client's Reviews</h2>
              <div class="box-container">
                  <?php
                  if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          $username = htmlspecialchars($row['username']);
                          $user_image_url = htmlspecialchars($row['user_image_url']);
                          $rating = htmlspecialchars($row['rating']);
                          $review = htmlspecialchars($row['review']);
                          $full_stars = floor($rating);
                          $half_star = ($rating - $full_stars >= 0.5) ? true : false;
                          $empty_stars = 5 - $full_stars - ($half_star ? 1 : 0);
                          ?>

                          <div class="box">
                              <div class="user">
                                  <img src="<?php echo $user_image_url; ?>" alt="<?php echo $username; ?>">
                                  <div>
                                      <h3><?php echo $username; ?></h3>
                                      <div class="stars">
                                          <?php for ($i = 0; $i < $full_stars; $i++) { ?>
                                              <ion-icon name="star-outline"></ion-icon>
                                          <?php } ?>
                                          <?php if ($half_star) { ?>
                                              <ion-icon name="star-half-outline"></ion-icon>
                                          <?php } ?>
                                          <?php for ($i = 0; $i < $empty_stars; $i++) { ?>
                                              <ion-icon name="star-outline"></ion-icon>
                                          <?php } ?>
                                      </div>
                                  </div>
                              </div>
                              <p><?php echo $review; ?></p>
                          </div>

                          <?php
                      }
                  } else {
                      echo "<p>No reviews available.</p>";
                  }
                  $conn->close();
                  ?>
              </div>
          </div>
      </section>
      <!--CONTACT US-->
      <section class="contact" id="contact">
        <div class="container">
          <p class="section-subtitle">Contact Us</p>
          <div class="row">
            <figure class="about-banner">
              <img src="./assets/images/contactus.png" alt="About us">
            </figure>
            <form id="contact-form" action="send_email.php" method="post" onsubmit="return validateForm()">
              <h3>Contact us</h3>
              <label for="name"> Name: </label>
              <input type="text" name="name" required maxlength="50" placeholder="Enter your name" class="box" autocomplete="on">
              <label for="email">Email:</label>
              <input type="email" name="email" required maxlength="50" placeholder="Enter your email" class="box" autocomplete="on">
              <label for="number">Phone Number:</label>
              <input type="number" name="number" required maxlength="10" placeholder="Enter your number" class="box" autocomplete="on">
              <label for="message">Message:</label>
              <textarea name="message" placeholder="Enter your message here..." required maxlength="1000" cols="30" rows="10" class="box"></textarea>
              <input type="submit" value="Send Message" name="send" class="btn">
            </form>
            <!-- Display success or error messages -->
            <?php
            if (isset($_SESSION['message'])) {
                echo "<p>{$_SESSION['message']}</p>";
                unset($_SESSION['message']);
            }
            if (isset($_SESSION['error'])) {
                echo "<p>{$_SESSION['error']}</p>";
                unset($_SESSION['error']);
            }
            ?>
          </div>
        </div>
      </section>

      <!-- #CTA -->
      <section class="cta">
        <div class="container">

          <div class="cta-card">
            <div class="card-content">
              <h2 class="h2 card-title">Looking for a dream home?</h2>

              <p class="card-text">We can help you realize your dream of a new home</p>
            </div>

            <button class="btn cta-btn">
              <a href="#allproperty"><span>Explore Properties</span></a>
              <ion-icon name="arrow-forward-outline"></ion-icon>
            </button>
          </div>

        </div>
      </section>

    </article>
  </main>
  <!-- #FOOTER-->
  <?php
  require('./php/components/footer.php');
  ?>

  <!-- jquery link-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- custom js link-->
  <script src="./assets/js/script.js"></script>

  <!-- ionicon link-->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>