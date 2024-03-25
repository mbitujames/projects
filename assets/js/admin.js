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