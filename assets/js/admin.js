document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(form);
        const property = {
            title: formData.get('title'),
            location: formData.get('location'),
            status: formData.get('status'),
            price: formData.get('price'),
            bedrooms: formData.get('bedrooms'),
            bathrooms: formData.get('bathrooms'),
            square_ft: formData.get('square_ft'),
            property_type: formData.get('property_type'),
            image_url: formData.get('image_url')
        };

        // Add the property to the database
        // For example, using the Fetch API:
        fetch('https://your-api-url.com/properties', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(property)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Property added:', data);
            // Optionally, you can refresh the page or display a success message
        })
        .catch(error => {
            console.error('Error adding property:', error);
            // Optionally, you can display an error message
        });
    });
});

document.getElementById('update-user-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission
    const formData = new FormData(this); // Get form data
    const url = 'update_user.php'; // Replace with your script path
    fetch(url, {
        method: 'POST',
        mode: 'no-cors',
        credentials: 'include',
        body: formData, // Send form data directly
    })
    .then(response => response.json()) // Parse response as JSON
    .then(data => {
        // Handle response here
        console.log(data);
        if (data.success) {
            // Update was successful, show success message
            document.getElementById('update-message').textContent = data.message;
        } else {
            // Update failed, show error message
            document.getElementById('update-message').textContent = data.message;
        }
    })
    .catch(error => {
        console.error("Error:", error);
        document.getElementById('update-message').textContent = 'An error occurred while updating the user information.';
    });
});

//js for the navigation in the header
document.addEventListener('DOMContentLoaded', function () {
    const navOpenBtn = document.querySelector('[data-nav-open-btn]');
    const navCloseBtn = document.querySelector('[data-nav-close-btn]');
    const navbar = document.querySelector('[data-navbar]');
    const overlay = document.querySelector('[data-overlay]');

    if (navOpenBtn && navCloseBtn && navbar && overlay) {
        navOpenBtn.addEventListener('click', function () {
            console.log('Opening menu'); // Debug statement
            navbar.setAttribute('data-active', true);
            overlay.classList.add('active');
        });

        navCloseBtn.addEventListener('click', function () {
            console.log('Closing menu'); // Debug statement
            navbar.removeAttribute('data-active');
            overlay.classList.remove('active');
        });

        overlay.addEventListener('click', function () {
            console.log('Overlay clicked'); // Debug statement
            navbar.removeAttribute('data-active');
            overlay.classList.remove('active');
        });
    } else {
        console.error('Navigation elements not found');
    }
});