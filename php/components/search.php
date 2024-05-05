<section class="Search" id="search-section">
    <h2>Search for your desired Property</h2>
    <div class="search-container">
        <select id="property-type">
            <option value="">Property Type</option>
            <option value="buy">Buy</option>
            <option value="rent">Rent</option>
        </select>
        <input type="text" id="location" placeholder="Location">
        <input type="text" id="keyword" placeholder="Keyword">
        <button class="btn">Search</button>
    </div>
</section>
<div id="search-results"></div>

<!-- JavaScript code -->

<script>
    document.querySelector('.btn').addEventListener('click', function() {
    var propertyType = document.getElementById('property-type').value;
    var location = document.getElementById('location').value;
    var keyword = document.getElementById('keyword').value;

    // Make sure all fields are filled
    if (propertyType !== '' && location !== '' && keyword !== '') {
        // Send AJAX request to the server-side script
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'search_properties.php?property_type=' + propertyType + '&location=' + location + '&keyword=' + keyword, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Display the search results in the search-results div
                document.getElementById('search-results').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    } else {
        alert('Please fill in all fields.');
    }
});

</script>