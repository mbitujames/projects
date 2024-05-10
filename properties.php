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
    <?php include "./php/components/header.php";
    ?>
</header>

    <main>
        <article>
            <div class="container">
                <p class="section-subtitle">All Properties</p>
                <?php
                require_once './data/db.php';
                // Fetch properties from the database
                $sql = "SELECT * FROM properties";
                $featuredProperties = mysqli_query($conn, $sql);

                if (mysqli_num_rows($featuredProperties) > 0) {
                    echo '<ul class="property-grid">';
                    while ($row = mysqli_fetch_assoc($featuredProperties)) {
                        echo '<li>
                    <div class="property-card" data-property-type="' . $row['property_type'] . '">
                        <figure class="card-banner">
                            <a href="#' . $row['property_type'] . '">
                                <img src="' . $row['image_url'] . '" alt="' . $row['title'] . '" class="w-100">
                            </a>
                            <div class="card-badge green">' . $row['status'] . '</div>
                            <div class="banner-actions">
                                <button class="banner-actions-btn">
                                    <ion-icon name="location"></ion-icon>
                                    <address>' . $row['location'] . '</address>
                                </button>
        
                                <button class="banner-actions-btn">
                                    <ion-icon name="camera"></ion-icon>
                                    <span>1</span>
                                </button>
                            </div>
                        </figure>
        
                        <div class="card-content">
                            <div class="card-price">
                                <strong>Ksh. ' . $row['price'] . '</strong>/Month
                            </div>
        
                            <h3 class="h3 card-title">
                                <a href="#allproperty">' . $row['title'] . '</a>
                            </h3>
        
                            <p class="card-text">' . $row['description'] . '</p>
        
                            <ul class="card-list">
                                <li class="card-item">
                                    <strong>' . $row['bedrooms'] . '</strong>
                                    <ion-icon name="bed-outline"></ion-icon>
                                    <span>Bedrooms</span>
                                </li>
        
                                <li class="card-item">
                                    <strong>' . $row['bathrooms'] . '</strong>
                                    <ion-icon name="man-outline"></ion-icon>
                                    <span>Bathrooms</span>
                                </li>
        
                                <li class="card-item">
                                    <strong>' . $row['square_ft'] . '</strong>
                                    <ion-icon name="square-outline"></ion-icon>
                                    <span>Square Ft</span>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <div class="card-author">
                                <figure class="author-avatar">
                                    <img src="./data/uploads/admin.jpg" alt="M J" class="w-100">
                                </figure>
                                <div>
                                    <p class="author-name">
                                        <a href="#">M J</a>
                                    </p>
                                    <p class="author-title">KREPM Agents</p>
                                </div>
                            </div>
                            <div class="card-footer-actions">
                                <button class="btn" id="add-to-cart"> Reserve </button>
                            </div>
                        </div>
                    </div>
                </li>';
                    }
                    echo '</ul>';
                } else {
                    echo "0 results";
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </div>


        </article>
    </main>
    <!-- #FOOTER-->
    <?php
    require('./php/components/footer.php')
    ?>
    <!-- custom js link-->
    <script src="./assets/js/script.js"></script>

    <!-- ionicon link-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>