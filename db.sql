-- property listing table
CREATE TABLE Properties (
    property_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    property_type VARCHAR(10),
    image_url VARCHAR(255),
    status VARCHAR(20),
    location VARCHAR(255),
    price DECIMAL(10, 2),
    title VARCHAR(255),
    description TEXT,
    bedrooms INT,
    bathrooms INT,
    square_ft INT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);
-- users table with role column
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) UNIQUE,
    email VARCHAR(255) UNIQUE,
    role VARCHAR(10),
    password VARCHAR(255),
    avatar_url VARCHAR(255)
);
-- store table reviews 
CREATE TABLE Testimonials (
    testimonial_id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(255),
    user_image_url VARCHAR(255),
    rating DECIMAL(3, 2),
    review TEXT
);

CREATE TABLE activities (
    activity_id INT AUTO_INCREMENT PRIMARY KEY,
    activity_description VARCHAR(255),
    activity_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- featured properties 

-- Property 1
INSERT INTO Properties (user_id, property_type, image_url, status, location, price, title, description, bedrooms, bathrooms, square_ft)
VALUES (1, 'rent', './data/uploads/property-1.jpg', 'For Rent', 'Milimani, Kitale', 50000, 'Elegant Country Mansion', 'Beautiful Huge 1 Family House In Heart Of Milimani. Newly Renovated With New Wood', 3, 2, 3450);

-- Property 2
INSERT INTO Properties (user_id, property_type, image_url, status, location, price, title, description, bedrooms, bathrooms, square_ft)
VALUES (1, 'buy', './data/uploads/img_2.jpg', 'For Sale', 'Gatua, Kitale', 2000000, 'Modern 4 Bedroom House for Sale', 'Modern house fitted with elegant furniture and appliances. It is located in the quiet region of Gatua and has a green compound.', 4, 4, 4500);

-- Property 3
INSERT INTO Properties (user_id, property_type, image_url, status, location, price, title, description, bedrooms, bathrooms, square_ft)
VALUES (1, 'rent', './data/uploads/img_3.jpg', 'For Rent', 'Mitume, Kitale', 35000, 'Furnished 2 Bedrooms Apartment for Rent in Mitume', 'Presenting a remarkable fully furnished 2 bedroom apartment nestled in the lush and leafy suburbs of Mitume. This residence epitomizes contemporary living, placing a strong emphasis on both comfort and style.', 2, 2, 1800);

-- Property 4
INSERT INTO Properties (user_id, property_type, image_url, status, location, price, title, description, bedrooms, bathrooms, square_ft)
VALUES (1, 'buy', './data/uploads/img_4.jpg', 'For Sale', 'Section Six, Kitale', 1500000, 'Cozy Suburban Home', 'A charming 3-Bedroom home in a quiet environment. Features a spacious garden, modern kitchen and a sun-filled living room.', 3, 3, 3250);
