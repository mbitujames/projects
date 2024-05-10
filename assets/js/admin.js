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

//js for update user information section
document.getElementById('update-user-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    const full_name = document.getElementById('full_name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const password = document.getElementById('password').value;

    const url = './update_user.php'; // Replace with your script path

    fetch(url, {
        method: 'POST',
        body: JSON.stringify({
            full_name: full_name,
            email: email,
            phone: phone,
            password: password
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('update-message').textContent = data.message;
            document.getElementById('update-message').classList.add('success');
        } else {
            document.getElementById('update-message').textContent = data.error;
            document.getElementById('update-message').classList.add('error');
        }
    })
    .catch(error => {
        console.error("Error:", error);
        document.getElementById('update-message').textContent = "An error occurred. Please try again.";
        document.getElementById('update-message').classList.add('error');
    });
});
