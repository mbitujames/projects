<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Collect form data
    $propertyType = $_GET['property_type'];
    $location = $_GET['location'];
    $keyword = $_GET['keyword'];

    // Database connection
    require_once '../data/db.php';

    // Construct the SQL query with placeholders
    $query = "SELECT * FROM properties WHERE property_type = ?";
    $params = array($propertyType);

    // Add conditions based on available input values
    if (!empty($location)) {
        $query .= " AND location LIKE ?";
        $params[] = "%" . $conn->real_escape_string($location) . "%";
    }
    if (!empty($keyword)) {
        $query .= " AND (title LIKE ? OR description LIKE ?)";
        $keyword = "%" . $conn->real_escape_string($keyword) . "%";
        $params[] = $keyword;
        $params[] = $keyword;
    }

    // Prepare and bind parameters
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $types = str_repeat("s", count($params)); // All parameters are strings
        $stmt->bind_param($types, ...$params);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                // Output the retrieved data as needed
                echo "Property Title: " . $row["title"] . "<br>";
                echo "Location: " . $row["location"] . "<br>";
                // Output other property details as needed
                echo "<hr>";
            }
        } else {
            echo "No properties found matching your search criteria.";
        }

        // Close statement
        $stmt->close();
    } else {
        // Handle query preparation error
        echo "Error preparing statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
