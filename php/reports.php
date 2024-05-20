<!DOCTYPE html>
<html lang="en">
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>KREPM Reports</title>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/reports.css">
        <style>
        .navbar-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        align-items: center;
        }

        .navbar-list .dropdown {
            position: relative;
        }

        .navbar-list .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            min-width: 200px;
        }

        .navbar-list .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .navbar-list .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .navbar-list .dropdown:hover .dropdown-content {
            display: block;
        }

        .navbar-list .dropdown:hover > a {
            background-color: #ddd;
        }
        /* Responsive table */
        @media screen and (max-width: 768px) {
        table {
            overflow-x: auto;
            display: block;
            white-space: nowrap;
        }
        }
        </style>
        <!-- google font link-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
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
                
                    </div>
                </div>
            </div>
            <div class="header-bottom">
                <div class="container">
                    <a href="#home" class="logo">
                    <img src="../assets/images/logo1.jpg" alt="KREPM">
                    </a>
                    <nav class="navbar" data-navbar>
                        <div class="navbar-top">
                            <a href="#home" class="logo">
                                <img src="../assets/images/logo1.jpg" alt="KREPM">
                            </a>

                            <button class="nav-close-btn" data-nav-close-btn aria-label="Close Menu">
                                <ion-icon name="close-outline"></ion-icon>
                            </button>
                        </div>

                        <div class="navbar-bottom">
                            <ul class="navbar-list">
                                <li>
                                    <a href="../index.php" class="navbar-link" data-nav-link>Home</a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="navbar-link" data-nav-link>User Reports</a>
                                    <ul class="dropdown-content">
                                        <li><a href="#active-user-reports">Active User Reports</a></li>
                                        <li><a href="#user-search-report">User Search Report</a></li>
                                        <li><a href="#user-activities-report">User Activities Report</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="navbar-link" data-nav-link>Property Reports</a>
                                    <ul class="dropdown-content">
                                        <li><a href="#property-inventory-report">Property Inventory Report</a></li>
                                        <li><a href="#property-views-report">Property Views Report</a></li>
                                        <li><a href="#property-reservation-reports">Property Reservation Reports</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="navbar-link" data-nav-link>Payment Reports</a>
                                    <ul class="dropdown-content">
                                        <li><a href="#sales-performance-report">Sales Performance Report</a></li>
                                        <li><a href="#payment-method-report">Payment Method Report</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="../php/dashboard.php" class="navbar-link" data-nav-link>Dashboard</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="header-bottom-actions">
                <div class="dropdown">
                    <button class="header-bottom-actions-btn" aria-label="reports" id="dropdown-btn">
                        <ion-icon name="newspaper-outline"></ion-icon>
                        <span>Reports</span>
                    </button>
                </div>

                    <button class="header-bottom-actions-btn" data-nav-open-btn aria-label="Open Menu">
                        <ion-icon name="menu-outline"></ion-icon>
                        <span>Menu</span>
                    </button>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <h2> KITALE REAL ESTATE MANAGEMENT SYSTEM - REPORTS</h2>
            <!-- User Reports Section -->
            <section id="user-reports">
                <h3>USER REPORTS</h3>
                <?php
                // Include database connection
                include '../data/db.php';

                // SQL query to retrieve active user reports
                $sql_active = "SELECT * FROM Users WHERE is_active = 1";
                $result_active = mysqli_query($conn, $sql_active);

                // SQL query to retrieve inactive user reports
                $sql_inactive = "SELECT * FROM Users WHERE is_active = 0";
                $result_inactive = mysqli_query($conn, $sql_inactive);

                if (!$result_active || !$result_inactive) {
                    die("Error retrieving user reports: " . mysqli_error($conn));
                }
                ?>
                <div id="active-user-reports">
                    <h4>Active Users</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row_active = mysqli_fetch_assoc($result_active)) {
                                echo "<tr>";
                                echo "<td>" . $row_active['user_id'] . "</td>";
                                echo "<td>" . $row_active['full_name'] . "</td>";
                                echo "<td>" . $row_active['email'] . "</td>";
                                echo "<td>" . $row_active['phone'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <h4>Inactive Users</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row_inactive = mysqli_fetch_assoc($result_inactive)) {
                                echo "<tr>";
                                echo "<td>" . $row_inactive['user_id'] . "</td>";
                                echo "<td>" . $row_inactive['full_name'] . "</td>";
                                echo "<td>" . $row_inactive['email'] . "</td>";
                                echo "<td>" . $row_inactive['phone'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div id="user-search-report">
                    <h4>User Search Report</h4>
                    <?php
                    // Include your database connection file
                    include '../data/db.php';
                    // Query to retrieve the search history
                    $sql = "
                    SELECT p.property_id, p.title, p.location, p.price, COUNT(s.search_id) AS search_count
                    FROM search s
                    JOIN properties p ON s.property_id = p.property_id
                    GROUP BY p.property_id
                    ORDER BY search_count DESC, s.search_date DESC
                    LIMIT 10";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        echo '<table>';
                        echo '<tr><th>Title</th><th>Location</th><th>Price</th><th>Search Count</th></tr>';
                         while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row['title'] . '</td>';
                            echo '<td>' . $row['location'] . '</td>';
                            echo '<td>Ksh. ' . $row['price'] . '</td>';
                            echo '<td>' . $row['search_count'] . '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    } else {
                        echo "No search history found.";
                    }
                    $conn->close();
                    ?>
                </div>
                <div id="user-activities-report">
                    <h4>User Activities Report</h4>
                    <?php
                    // Include your database connection file
                    include '../data/db.php';
                    // Query to retrieve user activities
                    $sql = "
                    SELECT a.activity_id, u.username, a.activity_description, a.activity_date
                    FROM activities a
                    JOIN users u ON a.user_id = u.user_id
                    ORDER BY a.activity_date DESC
                    LIMIT 15";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        echo '<table>';
                        echo '<tr><th>Activity ID</th><th>Username</th><th>Description</th><th>Date</th></tr>';
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row['activity_id'] . '</td>';
                            echo '<td>' . $row['username'] . '</td>';
                            echo '<td>' . $row['activity_description'] . '</td>';
                            echo '<td>' . $row['activity_date'] . '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    } else {
                        echo 'No activities found.';
                    }
                    // Close the database connection
                    //$conn->close();
                    ?>
                </div>
            </section>
            <!-- Property Reports Section -->
            <?php
            include '../data/db.php';
            // Define a query to fetch the total count of listed properties
            $totalCountQuery = "SELECT COUNT(*) AS total_count FROM properties WHERE status IN ('For Rent', 'For Sale')";
            // Execute the query and store the result
            $totalCountResult = mysqli_query($conn, $totalCountQuery);
            // Check if the query was successful
            if ($totalCountResult) {
                $totalCountRow = mysqli_fetch_assoc($totalCountResult);
                $total_count = $totalCountRow['total_count'];
            } else {
                // Handle error if query fails
                echo "Error fetching total property count";
            }
            ?>
            <section id="property-reports">
                <h3>PROPERTY LISTINGS REPORTS</h3>
                <div id="property-inventory-report">
                    <h4>Property Inventory Report</h4>
                    <strong><p>Total Properties: <?php echo $total_count; ?></p></strong>
                    <?php
                    // Connect to your database 
                    include '../data/db.php';

                    // Define queries to fetch properties for rent and sale
                    $rentQuery = "SELECT * FROM properties WHERE property_type = 'rent' AND status = 'For Rent'";
                    $saleQuery = "SELECT * FROM properties WHERE property_type = 'buy' AND status = 'For Sale'";
                    // Execute queries and store results
                    $rentResult = mysqli_query($conn, $rentQuery);
                    $saleResult = mysqli_query($conn, $saleQuery);

                    // Function to display property table row
                    function displayPropertyRow($row) {
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
                    echo "<td>" . $row['availability'] . "</td>";
                    echo "</tr>";
                    }

                    ?>
                    <h4>Properties For Rent</h4>
                    <table class="property-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Price</th>
                                <th>Bedrooms</th>
                                <th>Bathrooms</th>
                                <th>Sq Ft</th>
                                <th>Type</th>
                                <th>Availability</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Display rent properties
                            if (mysqli_num_rows($rentResult) > 0) {
                                while ($row = mysqli_fetch_assoc($rentResult)) {
                                    displayPropertyRow($row);
                                }
                            } else {
                                echo "<tr><td colspan='10'>No properties available for Rent.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <h4>Properties For Sale</h4>
                    <table class="property-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Price</th>
                                <th>Bedrooms</th>
                                <th>Bathrooms</th>
                                <th>Sq Ft</th>
                                <th>Type</th>
                                <th>Availability</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Display sale properties
                            if (mysqli_num_rows($saleResult) > 0) {
                                while ($row = mysqli_fetch_assoc($saleResult)) {
                                    displayPropertyRow($row);
                                }
                            } else {
                                echo "<tr><td colspan='10'>No properties available for Sale.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div id="property-views-report">
                    <h4>Property Views Report</h4>
                    <!--Most popular properties starts here-->
                    <?php
                    require_once '../data/db.php';
                    // Retrieve the top 10 most popular properties
                    $sql = "SELECT 
                    properties.property_id,
                    properties.title,
                    properties.location,
                    properties.status,
                    properties.price,
                    properties.bedrooms,
                    properties.bathrooms,
                    properties.square_ft,
                    properties.property_type,
                    COUNT(search.search_id) AS search_count
                    FROM 
                    properties
                    JOIN 
                    search ON properties.property_id = search.property_id
                    GROUP BY 
                    properties.property_id
                    ORDER BY 
                    search_count DESC
                    LIMIT 10";
                    $result = mysqli_query($conn, $sql);
                    // Check if there are results
                    if (mysqli_num_rows($result) > 0) {
                        echo '<div id="property-views-report">';
                        echo '<h4>Top 10 Most Popular Properties</h4>';
                        echo '<table>';
                        echo '<tr>';
                        echo '<th>Property ID</th>';
                        echo '<th>Title</th>';
                        echo '<th>Location</th>';
                        echo '<th>Status</th>';
                        echo '<th>Price</th>';
                        echo '<th>Bedrooms</th>';
                        echo '<th>Bathrooms</th>';
                        echo '<th>Square Feet</th>';
                        echo '<th>Property Type</th>';
                        echo '<th>Search Count</th>';
                        echo '</tr>';
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
                            echo "<td>" . $row['search_count'] . "</td>";
                            echo "</tr>";
                        }
                        echo '</table>';
                        echo '</div>';
                    } else {
                        echo '<div id="property-views-report">';
                        echo '<h4>Top 10 Most Popular Properties</h4>';
                        echo '<p>No properties found.</p>';
                        echo '</div>';
                    }
                    mysqli_close($conn);
                    ?>
                    <!--Most popular properties end here-->

                    <!--Most Expensive properties starts here-->
                    <?php
                    include ('../data/db.php');
                    // Retrieve and display featured properties
                    $sql_featured = "SELECT 
                    property_id,
                    title,
                    location,
                    status,
                    price,
                    bedrooms,
                    bathrooms,
                    square_ft,
                    property_type,
                    availability,
                    featured
                    FROM 
                    properties
                    WHERE 
                    featured = 1";
                    $result_featured = mysqli_query($conn, $sql_featured);
                    // Check if there are results for featured properties
                    if (mysqli_num_rows($result_featured) > 0) {
                        echo '<div id="featured-properties-report">';
                        echo '<h4>Featured Properties</h4>';
                        echo '<table>';
                        echo '<tr>';
                        echo '<th>Property ID</th>';
                        echo '<th>Title</th>';
                        echo '<th>Location</th>';
                        echo '<th>Status</th>';
                        echo '<th>Price</th>';
                        echo '<th>Bedrooms</th>';
                        echo '<th>Bathrooms</th>';
                        echo '<th>Square Feet</th>';
                        echo '<th>Property Type</th>';
                        echo '<th>Availability</th>';
                        echo '<th>Featured</th>';
                        echo '</tr>';
                        while ($row = mysqli_fetch_assoc($result_featured)) {
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
                            echo "<td>" . $row['availability'] ."</td>";
                            echo "<td>" . $row['featured'] ."</td>";
                            echo "</tr>";
                        }
                        echo '</table>';
                        echo '</div>';
                    } else {
                        echo '<div id="featured-properties-report">';
                        echo '<h4>Featured Properties</h4>';
                        echo '<p>No featured properties found.</p>';
                        echo '</div>';
                    }
                    //end of featured properties

                    //start of most expensive properties
                    // Define queries for most expensive properties
                    $rentQuery = "SELECT * FROM properties WHERE status = 'For Rent' ORDER BY price DESC LIMIT 5";
                    $saleQuery = "SELECT * FROM properties WHERE status = 'For Sale' ORDER BY price DESC LIMIT 5";
                    // Execute queries and store results
                    $rentResult = mysqli_query($conn, $rentQuery);
                    $saleResult = mysqli_query($conn, $saleQuery);
                    ?>
                    <h4>Most Expensive Properties</h4>
                    <h4>For Rent</h4>
                    <table class="property-table">
                        <thead>
                            <tr>
                                <th>Property ID</th>
                                <th>Title</th>
                                <th>Location</th>
                                <th>Price</th>
                                <th>Bedrooms</th>
                                <th>Bathrooms</th>
                                <th>Sq Ft</th>
                                <th>Type</th>
                                <th>Availability</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($rentResult) > 0) {
                                while ($row = mysqli_fetch_assoc($rentResult)) {
                                    // You can modify this part to display the information you need from the table
                                    echo "<tr>";
                                    echo "<td>" . $row['property_id'] . "</td>";
                                    echo "<td>" . $row['title'] . "</td>";
                                    echo "<td>" . $row['location'] . "</td>";
                                    echo "<td>" . $row['price'] . "</td>";
                                    echo "<td>" . $row['bedrooms'] . "</td>";
                                    echo "<td>" . $row['bathrooms'] . "</td>";
                                    echo "<td>" . $row['square_ft'] . "</td>";
                                    echo "<td>" . $row['property_type'] . "</td>";
                                    echo "<td>" . $row['availability'] ."</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9'>No properties available for Rent.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <h4>For Sale</h4>
                    <table class="property-table">
                        <thead>
                            <tr>
                                <th>Property ID</th>
                                <th>Title</th>
                                <th>Location</th>
                                <th>Price</th>
                                <th>Bedrooms</th>
                                <th>Bathrooms</th>
                                <th>Sq Ft</th>
                                <th>Type</th>
                                <th>Availability</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($saleResult) > 0) {
                                while ($row = mysqli_fetch_assoc($saleResult)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['property_id'] . "</td>";
                                    echo "<td>" . $row['title'] . "</td>";
                                    echo "<td>" . $row['location'] . "</td>";
                                    echo "<td>" . $row['price'] . "</td>";
                                    echo "<td>" . $row['bedrooms'] . "</td>";
                                    echo "<td>" . $row['bathrooms'] . "</td>";
                                    echo "<td>" . $row['square_ft'] . "</td>";
                                    echo "<td>" . $row['property_type'] . "</td>";
                                    echo "<td>" . $row['availability'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9'>No properties available for Sale.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!--Most Expensive properties starts here-->

                <div id="property-reservation-reports">
                    <?php
                    require_once '../data/db.php';
                    // Retrieve reserved properties for rent
                    $sql_rent = "SELECT 
                    properties.property_id,
                    properties.title,
                    properties.location,
                    properties.price,
                    properties.bedrooms,
                    properties.bathrooms,
                    properties.square_ft,
                    properties.property_type,
                    payments.payment_date
                    FROM 
                    properties
                    INNER JOIN 
                    payments ON properties.property_id = payments.property_id
                    WHERE 
                    payments.payment_status = 'reserved' AND properties.status = 'For Rent'
                    ORDER BY 
                    payments.payment_date DESC";
                    $result_rent = mysqli_query($conn, $sql_rent);
                    
                    // Retrieve reserved properties for sale
                    $sql_sale = "SELECT 
                    properties.property_id,
                    properties.title,
                    properties.location,
                    properties.price,
                    properties.bedrooms,
                    properties.bathrooms,
                    properties.square_ft,
                    properties.property_type,
                    payments.payment_date
                    FROM 
                    properties
                    INNER JOIN 
                    payments ON properties.property_id = payments.property_id
                    WHERE 
                    payments.payment_status = 'reserved' AND properties.status = 'For Sale'
                    ORDER BY 
                    payments.payment_date DESC";
                    $result_sale = mysqli_query($conn, $sql_sale);
                    ?>

                    <h4>Property Reservation Reports</h4>
                    <h4>For Rent</h4>
                    <table>
                        <tr>
                            <th>Property ID</th>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Price</th>
                            <th>Bedrooms</th>
                            <th>Bathrooms</th>
                            <th>Square Feet</th>
                            <th>Property Type</th>
                            <th>Reservation Date</th>
                        </tr>
                        <?php while ($row = mysqli_fetch_assoc($result_rent)) { ?>
                            <tr>
                                <td><?php echo $row['property_id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['location']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['bedrooms']; ?></td>
                                <td><?php echo $row['bathrooms']; ?></td>
                                <td><?php echo $row['square_ft']; ?></td>
                                <td><?php echo $row['property_type']; ?></td>
                                <td><?php echo $row['payment_date']; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                    <h4>For Sale</h4>
                    <table>
                        <tr>
                            <th>Property ID</th>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Price</th>
                            <th>Bedrooms</th>
                            <th>Bathrooms</th>
                            <th>Square Feet</th>
                            <th>Property Type</th>
                            <th>Reservation Date</th>
                        </tr>
                        <?php while ($row = mysqli_fetch_assoc($result_sale)) { ?>
                            <tr>
                                <td><?php echo $row['property_id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['location']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['bedrooms']; ?></td>
                                <td><?php echo $row['bathrooms']; ?></td>
                                <td><?php echo $row['square_ft']; ?></td>
                                <td><?php echo $row['property_type']; ?></td>
                                <td><?php echo $row['payment_date']; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </section>

            <!-- Payment Reports Section -->
            <section id="payment-reports">
                <h3>PAYMENTS REPORTS</h3>
                <div id="sales-performance-report">
                    <h4>Sales Performance Report</h4>
                    <!-- Content for Sales Performance Report -->
                </div>
                <div id="payment-method-report">
                    <h4>Payment Method Report</h4>
                    <!-- Content for Payment Method Report -->
                </div>
            </section>
        </main>
        <!-- #FOOTER-->
        <?php
        require('../php/components/footer.php');
        ?>
        <!-- custom js link-->
        <script src="../assets/js/script.js"></script>
        <!-- ionicon link-->
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
</html>