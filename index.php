<?php
include("./config.php");
require(ROOT_PATH."/server/db.php");
// Fetch all products
$query = "SELECT * FROM products";
$stmt = $conn->query($query);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="OK2shop An Online shopping platform">
    <meta name="author" content="Omar Kadish">
    <title>Omar's Shop</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="./resources/css/styles.css">
    <link rel="stylesheet" href="../resources/css/<?php echo $theme; ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include('./layout/header.php'); ?>

<section id="main-content">
    <?php if (isset($_SESSION['user_name'])) : ?>
        <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
    <?php endif; ?>
    <h1>Product List</h1>
    <div class="products">
        <?php foreach ($products as $product) : ?>
            <div class="product"
                 data-id="<?php echo $product['id'] ?>"
                 data-name="<?php echo $product['name'] ?>"
                 data-price="<?php echo $product['price'] ?>">
                <img src="./resources/images/<?php echo $product['image'] ?>" alt="<?php echo $product['description'] ?>">
                <h2><?php echo $product['name'] ?></h2>
                <p><?php echo $product['price'] ?></p>
                <select class="product-option" style="margin-bottom: 10px; width: 80%;">

                    <?php
                    // Fetch options for THIS specific product
                    $optStmt = $conn->prepare("SELECT * FROM product_options WHERE product_id = ?");
                    $optStmt->execute([$product['id']]);
                    $options = $optStmt->fetchAll();
                    foreach ($options as $opt) {
                        echo "<option value='{$opt['option_value']}'>{$opt['option_name']}: {$opt['option_value']}</option>";
                    }
                    ?>
                </select>
                <button class="add-to-cart">
                    <i class="material-icons">add_shopping_cart</i> Add to Cart
                </button>
            </div>
        <?php endforeach; ?>
    </div>

</section>
<script src="./resources/script.js"></script>
<?php include('./layout/footer.html'); ?>

<!--Instructions-->
<!--For this project you are asked to develop fully functional website hosted remotely (e.g. myweb.cs.uwindsor.ca) that is capable of client-server features using PHP and MySQL.-->
<!--Here are some examples to inspire you:-->
<!--1. An online store with shopping cart: An e-commerce application for an online store. Admin interface: Add/Edit products, view orders, respond to customer questions.-->
<!--Front-End User Interface: Search products, view product details, rate product, add to shopping cart, checkout, track order and history. e.g. Amazon-->
<!--2. An online service where you provide a Front-end interface for the users to submit requests for a service such as asking questions and attaching documents, rate service, view history.-->
<!--An admin interface: review service requests and provide responses/service.-->
<!--E.g. a tutoring site, or legal/travel advice, etc. you can be creative to develop something you enjoy doing.-->
<!---->
<!--I'll go with a shopping cart web app-->
<!---->
<!--The project must satisfy the following criteria:-->
<!--Frontend client interface presenting full interactive functionality-->
<!--- Use of HTML5, CSS, JavaScript.-->
<!--- Multimedia including: image(s), video(s), interactive map(s), interactive menu(es), data visualization/graph(s).-->
<!--- Minimum 20 unique Dynamic as well as minimum of 5 static pages.-->
<!--- Public and Private area (requiring user registration/authentication and user profile).-->
<!--- Front-end documentation.-->
<!--- Search engine optimization features.-->
<!--- Responsiveness on mobile platform and desktop platform. (works on at least one desktop and one mobile)-->
<!--- End user documentation; interactive user training or a step-by-step how to guide for using your site.-->
<!--Frontend Admin interface-->
<!--- Enable the switching of at least 3 different site templates (i.e. customizable color schemes and layout)-->
<!--- Enable the editing functionality of the data records (e.g. products, services, etc.)-->
<!--- User account administration features. (Admin can disable user accounts for example)-->
<!--- Admin user documentation.-->
<!--Backend interface presenting-->
<!--- A monitoring page reporting the status of the website (and all its feature services) in terms of their working conditions (online/offline).-->
<!--- A database with at least 20 records (e.g. 20 product items, or 20 service descriptions, etc.) (consider creating the data in MySQL)-->
<!--- PHP functionality for creating dynamic web pages.-->
<!---->
<!--Package interface-->
<!--- A software repository of all code/branches. (like github)-->
<!--- Installation documentation (how can someone install your app on a different website?)-->
<!---->
<!--Grading Scheme:-->
<!---->
<!--Requirement | Grading Scheme | (Points)-->
<!--1. Identify a business case of your choice to describe the catalogue that you want to develop. (e.g. books, cars, blinds, etc..) |-->
<!--A description (at least a paragraph) describing what this project is about. Can be placed in the "About" menu. | (0.5 pt)-->
<!---->
<!--2. Identify no less than 20 products, and each product may have at least 2 (or more) different options. (e.g. book cover type, car engine type, blind materials, etc...) |-->
<!--20 products included with minimum 2 options for each. | (1 pts)-->
<!---->
<!--3. There needs to be a common template for the site that can be dynamically changed. Have at least 3 different templates for the site:-->
<!--e.g. three different desktop themes (different look, e.g. Thanksgiving Theme or Christmas Theme, or Regular Theme that automatically changes each season). |-->
<!--3 site wide CSS template, and ability to change the template | (3 pts + 1 pt)-->
<!---->
<!--4. There needs to be dynamic HTML Forms on at least two pages.-->
<!--Example:  A form where you can calculate a quote for the car based on options selected. |-->
<!--HTML forms x 2 | (2 pts)-->
<!---->
<!--5.PHP code and MySQL database well documented |-->
<!--PHP documented files and MySQL database design included (see 7 below) | (5 pt)-->
<!---->
<!--6. All code must be properly commented. |-->
<!--Proper code documents (comments) throughout all HTML/CSS and JS code files | 2 pts-->
<!---->
<!--7. The project must have a help wiki page(s) to explain to the users how it works (at least 5 different pages).-->
<!--The context sensitive Help link to the corresponding page from the website should be available. |-->
<!--5 Wiki pages (0.5 pt each) | 2.5 pts-->
<!---->
<!--9. The site must have a menu, and responsive (i.e. different screen sizes). |-->
<!--One main menu | 1 pt-->
<!---->
<!--10. There needs to be at least 20 html pages and at least 1 external CSS, and 1 external JS file.-->
<!--Also, at least 20 images (copyright free) and at least 3 video or audio files. It is very important to make the site easy to modify (i.e. add/remove products in the catalogue so users can see fresh items).-->
<!--You can use JavaScript/JSON/CSS combinations for these but make sure it is clear and simple enough for a non-programmer to be able to update the site with basic instructions. (provide instructions in your help wiki page).|-->
<!--~20 dynamic HTML/PHP files-->
<!--1 CSS file-->
<!--1 JS file-->
<!--20 images files-->
<!--3 video/audio files-->
<!--Instructions how to update contents (ie images/video/audio files) | (1 pt, 0.5 pt, 0.5 pt, 1 pt, 1 pt, 0.5pt)-->
<!---->
<!--12. The site should have enough complexity in terms of fonts, menu boxes, transitions, etc. to demonstrate advanced and appropriate CSS functionality where needed. |-->
<!--Use of fonts, menu boxes, transitions, etc in CSS | (1 pt)-->
<!---->
<!--13. Make sure the website has the proper meta tags - such as icon, title, description, keywords, etc. to be SEO (search engine) friendly.-->
<!--| SEO optimization | 1 pts-->
<!---->
<!--Total 25 points-->