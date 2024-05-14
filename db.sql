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
    keyword VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);
-- users table with role column
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    full_name VARCHAR(50) UNIQUE,
    phone VARCHAR(10) NOT NULL,
    email VARCHAR(50) UNIQUE,
    role VARCHAR(10),
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    avatar_url VARCHAR(255)
);

-- store table reviews 
CREATE TABLE Testimonials (
    testimonial_id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(255),
    user_image_url VARCHAR(255),
    rating DECIMAL(3, 2),
    review TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE activities (
    activity_id INT AUTO_INCREMENT PRIMARY KEY,
    activity_description VARCHAR(255),
    activity_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Payments (
  payment_id INT AUTO_INCREMENT PRIMARY KEY,
  property_id INT NOT NULL,
  user_id INT NOT NULL,
  payment_amount DECIMAL(10, 2) NOT NULL,
  payment_method VARCHAR(50),  -- Optional: Specify payment method (e.g., 'credit card', 'bank transfer')
  payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (property_id) REFERENCES Properties(property_id),
  FOREIGN KEY (user_id) REFERENCES Users(user_id)
);
CREATE TABLE IssuedProperties (
    issue_id INT AUTO_INCREMENT PRIMARY KEY,
    property_id INT NOT NULL,
    user_id INT NOT NULL,
    date_taken DATE NOT NULL,
    agent_id INT NOT NULL,
    FOREIGN KEY (property_id) REFERENCES Properties(property_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (agent_id) REFERENCES Users(user_id)
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

--inserting Testimonials
INSERT INTO Testimonials (user_name, user_image_url, rating, review) VALUES
('Collins Tyler', './data/uploads/pic1.jpg', 4.5, 'I recently purchased a property through this website, and I\'m extremely satisfied. The listings were detailed, and the agents were professional and helpful throughout the process. I would definitely use this platform again.'),
('Serah Wangeci', './data/uploads/pic2.jpg', 4.0, 'This website is amazing! I found my dream house here, and the service was top-notch. The photos were accurate, and the descriptions were clear. Thank you for helping me find a great home!'),
('Simon Tembu', './data/uploads/pic3.jpg', 4.0, 'I\'ve had a great experience renting through this website. The search filters made it easy to find properties that matched my preferences, and the communication with the landlord was smooth and efficient. Definitely a trustworthy platform.'),
('Mbue Peter', './data/uploads/pic4.png', 4.0, 'I found my dream apartment on this website, and it exceeded all my expectations. Highly recommended!'),
('Tiffany Wainaina', './data/uploads/pic5.jpg', 4.0, 'I\'ve been using this website for real estate investments, and it\'s become my go-to platform. The market trends and analysis tools provided valuable insights, helping me make informed decisions. The user interface is intuitive, making it easy to navigate through different properties and neighborhoods. If you\'re serious about real estate investing, this is the site to use.'),
('Mickey Kendi', './data/uploads/pic6.jpg', 4.0, 'I listed my property for sale on this website, and I was impressed by the level of exposure it received. The analytics provided helped me track the interest in my listing, and the communication tools made it easy to connect with potential buyers. The property sold quickly, and I attribute much of that success to the visibility this website provided. Highly recommended for sellers!');
