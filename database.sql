CREATE TABLE users
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name  VARCHAR(50),
    email      VARCHAR(100) UNIQUE,
    is_admin TINYINT(1) DEFAULT 0,
    address    TEXT,
    phone      VARCHAR(20),
    password   VARCHAR(255)
);

-- user info:
-- email: omar@gmail.com
-- password: 123456789
-- Set myself as admin
UPDATE users SET is_admin = 1 WHERE email = 'omar@gmail.com';

CREATE TABLE cart
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    user_id        INT NOT NULL,
    product_id     INT NOT NULL,
    option_details VARCHAR(255), -- Stores selected options like "Red, Large"
    quantity       INT NOT NULL DEFAULT 1,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE
);

/* Products Table */
CREATE TABLE products
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(255)   NOT NULL,
    description TEXT,
    price       DECIMAL(10, 2) NOT NULL,
    image       VARCHAR(255),
    stock       INT DEFAULT 10
);

/* Product Options (e.g., Size, Color, Material) */
CREATE TABLE product_options
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    product_id   INT,
    option_name  VARCHAR(50), -- e.g., 'Size'
    option_value VARCHAR(50), -- e.g., 'Large'
    FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE
);

-- Seeding DB
-- Inserting 20 Products
INSERT INTO products (name, description, price, image)
VALUES ('Pro Laptop X1', 'High-performance laptop for creators.', 1299.00, 'laptop.jpg'),
       ('Smart Watch V2', 'Track your health and notifications.', 199.00, 'watch.jpg'),
       ('Noise Cancelling Headphones', 'Pure sound, zero distractions.', 299.00, 'headphones.jpg'),
       ('Mechanical Keyboard', 'RGB backlit with tactile switches.', 89.00, 'keyboard.jpg'),
       ('Gaming Mouse', 'High DPI wireless gaming mouse.', 59.00, 'mouse.jpg'),
       ('4K Monitor 27"', 'Ultra HD display with HDR support.', 349.00, 'monitor.jpg'),
       ('External SSD 1TB', 'Fast data transfer in a compact size.', 120.00, 'ssd.jpg'),
       ('Webcam 1080p', 'Clear video for meetings and streaming.', 45.00, 'webcam.jpg'),
       ('Ergonomic Office Chair', 'Support for long working hours.', 250.00, 'chair.jpg'),
       ('Smartphone Z', 'Latest flagship with pro camera.', 999.00, 'phone.jpg'),
       ('Bluetooth Speaker', 'Waterproof portable sound.', 75.00, 'speaker.jpg'),
       ('Tablet Pro', 'Perfect for drawing and productivity.', 599.00, 'tablet.jpg'),
       ('USB-C Hub', '7-in-1 connectivity expansion.', 35.00, 'hub.jpg'),
       ('Desk Lamp', 'Adjustable brightness and color temp.', 25.00, 'lamp.jpg'),
       ('Wireless Charger', 'Fast charging for multiple devices.', 40.00, 'charger.jpg'),
       ('VR Headset', 'Immersive virtual reality experience.', 399.00, 'vr.jpg'),
       ('Microphone', 'Studio quality for podcasting.', 130.00, 'mic.jpg'),
       ('Smart Home Hub', 'Control your lights and locks.', 90.00, 'smarthome.jpg'),
       ('Laptop Stand', 'Aluminum stand for better posture.', 30.00, 'stand.jpg'),
       ('Graphic Tablet', 'Pressure sensitive for digital art.', 150.00, 'graphictablet.jpg');

-- Insert Options for few products
INSERT INTO product_options (product_id, option_name, option_value)
VALUES (1, 'RAM', '16GB'),
       (1, 'RAM', '32GB'),
       (2, 'Color', 'Black'),
       (2, 'Color', 'Silver'),
       (3, 'Color', 'Midnight'),
       (3, 'Color', 'White'),
       (4, 'Switch Type', 'Blue Clicky'),
       (4, 'Switch Type', 'Brown Tactile'),
       (10, 'Storage', '128GB'),
       (10, 'Storage', '256GB');
