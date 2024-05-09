<?php
// Include your database connection file
include './data/db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $propertyType = $_POST['property_type'];
    $location = $_POST['location'];
    $keyword = $_POST['keyword'];

    // Prepare SQL query
    $sql = "SELECT * FROM properties WHERE property_type = ? AND location LIKE ? AND (description LIKE ? OR keyword LIKE ?)";
    $stmt = $conn->prepare($sql);

    // Append '%' wildcard characters to the location and keyword variables
    $location = "%$location%";
    $keyword = "%$keyword%";

    // Bind parameters
    $stmt->bind_param("ssss", $propertyType, $location, $keyword, $keyword);

    // Execute query
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Fetch and display results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Display each property
            echo "<div class='property'>";
            echo "<h3>". $row['title']. "</h3>";
            echo "<p>Location: ". $row['location']. "</p>";
            echo "<p>Type: ". $row['property_type']. "</p>";
            echo "<p>Description: ". $row['description']. "</p>";
            echo "<p>bedrooms: ". $row['bedrooms']. "</p>";
            echo "</div>";
        }
    } else {
        echo "No properties found.";
    }

    // Close statement and connection
    $stmt->close();
    //$conn->close();
}
?>
<style>
/*SEARCH SECTION*/
.Search {
  padding: 50px 0;
  background-color: #f9f9f9;
  text-align: center;
}

.Search h2 {
  margin-top: 20px;
  font-size: 32px;
  color: #444;
}
#search-form {
  margin-top: 30px;
}
.search-container {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;/* Allow fields to wrap to the next line on smaller screens */
}
.search-field {
  margin-right: 20px;
}
.search-field label {
  display: block;
  margin-bottom: 5px;
  font-size: 16px;
  color: black;
}

.search-field input[type="text"],
.search-field select {
  width: 200px;/* Adjust width as needed */
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
  color: #333;
}
#keyword {
  width: 300px; /* Adjust width as needed */
}
#search-btn {
  margin-top: 20px;
  padding: 12px 24px;
  background-color: none;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 18px;
  cursor: pointer;
  transition: background-color 0.3s;
}
#search-btn:hover {
  background: #ccc;
  color: #333;
  border-color: black;
}
#search-results {
  margin-top: 4rem;
  border: 1px solid #ccc;
  padding: 1rem;
}
</style>
<section class="Search" id="search-section">
<p class="section-subtitle">Search Bar</p>
    <h2>Search for your desired Property</h2>
    <form id="search-form" method="post">
        <div class="search-container">
            <div class="search-field">
            <label for="property-type">Property Type:</label>
            <select name="property_type" id="property-type">
                <option value="">Select</option>
                <option value="buy">Buy</option>
                <option value="rent">Rent</option>
            </select>
            </div>
            <div class="search-field">
                <label for="location">Location:</label>
                <input type="text" name="location" id="location" placeholder="Enter your desired location">
            </div>
            <div class="search-field">
                <label for="keyword">Keyword:</label>
                <input type="text" name="keyword" id="keyword" placeholder="Search by neighborhood, amenities etc.">
            </div>
            <button class="btn" id="search-btn">Search Properties</button>
        </div>
    </form>
    <div id="search-results"></div>
</section>

<script>
$(document).ready(function() {
    $('#search-form').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting via the browser.

        var propertyType = $('#property-type').val();
        var location = $('#location').val();
        var keyword = $('#keyword').val();

        $.ajax({
            url: 'search.php',
            type: 'post',
            data: {property_type: propertyType, location: location, keyword: keyword},
            success: function(response) {
                $('#search-results').html(response); // Update the search results with the response from the server.
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    });
});
</script>
