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
<script>
    document.querySelector(".search-container .btn").addEventListener("click", function() {
        searchProperties();
    });

    function searchProperties() {
        var propertyType = document.getElementById("property-type").value;
        var location = document.getElementById("location").value;
        var keyword = document.getElementById("keyword").value;

        var xhr = new XMLHttpRequest();
        var url = "search_properties.php?property_type=" + encodeURIComponent(propertyType) + "&location=" + encodeURIComponent(location) + "&keyword=" + encodeURIComponent(keyword);
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    document.getElementById("search-results").innerHTML = xhr.responseText;
                } else {
                    console.error("Error: " + xhr.status);
                }
            }
        };
        xhr.send();
    }
</script>
