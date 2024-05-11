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
    $featuredProperties = $stmt->get_result();
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
                      <button class="btn" id="add-to-cart">Reserve</button>
                  </div>
              </div>
          </div>
      </li>';
      }
      echo '</ul>';
  } else {
      echo "0 results";
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
