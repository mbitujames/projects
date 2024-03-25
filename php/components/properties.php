<section class="property" id="property">
    <div class="container">
        <p class="section-subtitle">Properties</p>
        <h2 class="h2 section-title">Featured Listings</h2>
        <?php
        require_once './data/db.php';
        // Fetch properties from the database
        $sql = "SELECT * FROM properties WHERE featured = 1 ORDER BY property_id DESC LIMIT 6";
        $featuredProperties = mysqli_query($conn, $sql);

        if (mysqli_num_rows($featuredProperties) > 0) {
            echo '<ul class="property-list has-scrollbar">';
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
                            <button class="btn" id="add-to-cart">Get Quote</button>
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
</section>
<!-- Latest 5 properties -->
<section class="allproperty" id="allproperty">
    <div class="property-list">
        <p class="section-subtitle">New Listings</p>
        <h2 class="h2 section-title"> Latest Properties Listings</h2>
        <!-- add link to all properties page -->
        <div class="filters">
            <select onchange="filterFunction()" id="sortby">
                <option value="property-type">Sort by Type</option>
                <option value="buy">Buy</option>
                <option value="rent">Rent</option>
            </select>
        </div>
        <!--List of Properties -->
        <?php
        require_once './data/db.php';
        $sql = "SELECT * FROM properties ORDER BY property_id DESC LIMIT 6";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<ul class="property-grid">';
            while ($row = mysqli_fetch_assoc($result)) {
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
                        <button class="btn" id="add-to-cart">Get Quote</button>
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
</section>