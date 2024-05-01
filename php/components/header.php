<header class="header" data-header>
    <div class="overlay" data-overlay></div>
    <div class="header-top">
        <div class="container">
            <ul class="header-top-list">
                <li>
                    <a href="krepmestates@gmail.com" class="header-top-link">
                        <ion-icon name="mail-outline"></ion-icon>
                        <span>krepmestates@gmail.com</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="header-top-link">
                        <ion-icon name="location-outline"></ion-icon>
                        <address>4th Floor, One Tana Towers, Kitale</address>
                    </a>
                </li>
            </ul>
            <div class="wrapper">
                <ul class="header-top-social-list">
                    <li> <a href="https://www.facebook.com/MbituJames" class="header-top-social-link" target="_blank">
                            <ion-icon name="logo-facebook"></ion-icon>
                        </a>
                    </li>
                    <li>
                        <a href="https://x.com/mbituke?t=mv9XXsRlVtVuec1vDPbUbQ&s=09" class="header-top-social-link" target="_blank">
                            <ion-icon name="logo-twitter"></ion-icon>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/mbitu?igsh=MWs3bG53cHhwYWNpOA==" class="header-top-social-link" target="_blank">
                            <ion-icon name="logo-instagram"></ion-icon>
                        </a>
                    </li>
                    <li>
                        <a href="https://pin.it/2fseiKYde" class="header-top-social-link" target="_blank">
                            <ion-icon name="logo-pinterest"></ion-icon>
                        </a>
                    </li>
                </ul>
                <button class="header-top-btn" onclick="redirectToAdminPanel()">Add Listing</button>

                <script>
                function redirectToAdminPanel() {
                    // Check if the user is logged in as an admin
                    var isAdmin = true;
                    // If the user is an admin, redirect to the admin panel page
                    if (isAdmin) {
                        window.location.href = 'admin_panel.php'; 
                    } else {
                        window.location.href = 'index.php';
                        alert("Please log in as Admin");
                    }
                }
                </script>
                
            </div>
            </div>
        </div>
    </div>

    <div class="header-bottom">
        <div class="container">

            <a href="#home" class="logo">
                <img src="./assets/images/logo1.jpg" alt="KREPM">
            </a>

            <nav class="navbar" data-navbar>
                <div class="navbar-top">
                    <a href="#home" class="logo">
                        <img src="./assets/images/logo1.jpg" alt="KREPM">
                    </a>

                    <button class="nav-close-btn" data-nav-close-btn aria-label="Close Menu">
                        <ion-icon name="close-outline"></ion-icon>
                    </button>
                </div>

                <div class="navbar-bottom">
                    <ul class="navbar-list">
                        <li>
                            <a href="index.php#home" class="navbar-link" data-nav-link>Home</a>
                        </li>

                        <li>
                            <a href="index.php#about" class="navbar-link" data-nav-link>About</a>
                        </li>

                        <li>
                            <a href="index.php#service" class="navbar-link" data-nav-link>Service</a>
                        </li>

                        <li>
                            <a href="index.php#property" class="navbar-link" data-nav-link>Property</a>
                        </li>
                        <li>
                            <a href="./properties.php" class="navbar-link" data-nav-link>All Properties</a>
                        </li>

                        <li>
                            <a href="index.php#search-btn" class="navbar-link" data-nav-link>Search</a>
                        </li>

                        <li>
                            <a href="index.php#contact" class="navbar-link" data-nav-link>Contact</a>
                        </li>

                        <li>
                            <a href="index.php#reviews" class="navbar-link" data-nav-link>Reviews</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="header-bottom-actions">
                <button class="header-bottom-actions-btn" aria-label="Cart">
                    <ion-icon name="cart-outline"></ion-icon>
                    <span>Cart</span>
                </button>

                <div class="dropdown">
                    <button class="header-bottom-actions-btn" aria-label="Profile" id="dropdown-btn">
                        <ion-icon name="person-outline"></ion-icon>
                        <span>Profile</span>
                    </button>

                    <div id="dropdown-content" class="dropdown-content">
                        <a href="login.php">Login</a>
                        <a href="signup.php">Signup</a>
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