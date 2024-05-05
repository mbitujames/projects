<?php
// Establishes a connection to the database
require_once './data/db.php';

// Check if the search parameters are provided
if (isset($_GET['property_type']) && isset($_GET['location']) && isset($_GET['keyword'])) {
    // Sanitize and store search parameters
    $propertyType = $_GET['property_type'];
    $location = $_GET['location'];
    $keyword = '%' . $_GET['keyword'] . '%'; // Add wildcard characters for a partial match

    // Construct the SQL query based on the search parameters
    $sql = "SELECT * FROM Properties WHERE property_type = ? AND location = ? AND keyword LIKE ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sss", $propertyType, $location, $keyword);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Loop through the results and display them
        while ($row = mysqli_fetch_assoc($result)) {
            // Output each property information
            echo "<p>Title: " . $row['title'] . "</p>";
            echo "<p>Description: " . $row['description'] . "</p>";
            echo "<p>Bedrooms: " . $row['bedrooms'] . "</p>";
            echo "<p>Bathrooms: " . $row['bathrooms'] . "</p>";
            echo "<p>Square Feet: " . $row['square_ft'] . "</p>";
            echo "<p>Price: $" . $row['price'] . "</p>";
            // Output other property details as needed
        }
    } else {
        echo "No properties found matching the search criteria.";
    }

    // Close the statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    // Handle case when search parameters are not provided
    echo "Please provide search parameters.";
}
?>
