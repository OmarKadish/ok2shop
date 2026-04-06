<?php
include('./config.php');

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
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
              rel="stylesheet">
    </head>
<body>
<?php include('./layout/header.php'); ?>

    <section class="about-content">
        <h1>About OK2Shop</h1>

        <p>
            OK2Shop is an online shopping platform that allows users to browse and purchase
            technology accessories such as headphones, keyboards, computer mice, and
            mobile devices. Customers can explore the product catalog, view product
            details, add items to their shopping cart, and complete purchases through a
            secure checkout system.
            <br>
            Registered users can manage their shopping cart, review order history, and
            update their personal profile information. The platform also provides an
            administrative dashboard where administrators can manage product listings,
            control user accounts, monitor system status, and customize the website
            appearance through multiple themes.
            <br>
            The goal of this project is to demonstrate a full client-server web application
            using HTML5, CSS, JavaScript, PHP, and MySQL with responsive design and
            dynamic page generation.
        </p>

    </section>

<?php include("./layout/footer.html"); ?>