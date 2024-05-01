<!DOCTYPE html>
<html lang="en">

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

      <!-- #REVIEWS-->
      <section class="reviews" id="reviews">
        <div class="container">
          <p class="section-subtitle">Reviews</p>
          <h2 class="h2 section-title">Latest Client's Reviews</h2>
          <div class="box-container">
            <div class="box">
              <div class="user">
                <img src="./data/uploads/pic1.jpg" alt="pic1">
                <div>
                  <h3>Collins Tyler </h3>
                  <div class="stars">
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-half-outline"></ion-icon>
                  </div>
                </div>
              </div>
              <p>I recently purchased a property through this website, and I'm extremely satisfied. The listings were detailed, and the agents were professional and helpful throughout the process. I would definitely use this platform again.
              </p>
            </div>
            <div class="box">
              <div class="user">
                <img src="./data/uploads/pic2.jpg" alt="pic2">
                <div>
                  <h3>Serah Wangeci </h3>
                  <div class="stars">
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-half-outline"></ion-icon>
                  </div>
                </div>
              </div>
              <p>This website is amazing! I found my dream house here, and the service was top-notch. The photos were accurate, and the descriptions were clear. Thank you for helping me find a great home!
              </p>
            </div>
            <div class="box">
              <div class="user">
                <img src="./data/uploads/pic3.jpg" alt="pic3">
                <div>
                  <h3>Simon Tembu </h3>
                  <div class="stars">
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-half-outline"></ion-icon>
                  </div>
                </div>
              </div>
              <p>I've had a great experience renting through this website. The search filters made it easy to find properties that matched my preferences, and the communication with the landlord was smooth and efficient. Definitely a trustworthy platform
              </p>
            </div>
            <div class="box">
              <div class="user">
                <img src="./data/uploads/pic4.png" alt="pic4">
                <div>
                  <h3>Mbue Peter </h3>
                  <div class="stars">
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-half-outline"></ion-icon>
                  </div>
                </div>
              </div>
              <p>I found my dream apartment on this website, and it exceeded all my expectations. Highly recommended!
              </p>
            </div>
            <div class="box">
              <div class="user">
                <img src="./data/uploads/pic5.jpg" alt="pic5">
                <div>
                  <h3>Tiffany Wainaina </h3>
                  <div class="stars">
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-half-outline"></ion-icon>
                  </div>
                </div>
              </div>
              <p>I've been using this website for real estate investments, and it's become my go-to platform. The market trends and analysis tools provided valuable insights, helping me make informed decisions. The user interface is intuitive, making it easy to navigate through different properties and neighborhoods. If you're serious about real estate investing, this is the site to use.
              </p>
            </div>
            <div class="box">
              <div class="user">
                <img src="./data/uploads/pic6.jpg" alt="pic6">
                <div>
                  <h3>Mickey Kendi </h3>
                  <div class="stars">
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-half-outline"></ion-icon>
                  </div>
                </div>
              </div>
              <p>I listed my property for sale on this website, and I was impressed by the level of exposure it received. The analytics provided helped me track the interest in my listing, and the communication tools made it easy to connect with potential buyers. The property sold quickly, and I attribute much of that success to the visibility this website provided. Highly recommended for sellers!
              </p>
            </div>
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
            <form action="send_email.php" method="post">
              <h3>Contact us</h3>
              <label for="name">Name:</label>
              <input type="text" name="name" required maxlength="50" placeholder="Enter your name" class="box">
              <label for="email">Email:</label>
              <input type="email" name="email" required maxlength="50" placeholder="Enter your email" class="box">
              <label for="number">Phone Number:</label>
              <input type="number" name="number" required maxlength="10" min="0" max="999999999" placeholder="Enter your number" class="box">
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
  <!-- custom js link-->
  <script src="./assets/js/script.js"></script>

  <!-- ionicon link-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>