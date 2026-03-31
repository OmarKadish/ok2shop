<?php
$theme = $_SESSION['theme'] ?? "theme-default.css";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="OK2shop An Online shopping platform">
    <meta name="author" content="Omar Kadish">
    <title>Omar's Shop</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../resources/css/styles.css">
    <link rel="stylesheet" href="../resources/css/<?php echo $theme; ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

<header>
    <section>
        <div id="container">
            <!-- SHOP NAME -->
            <div id="shopName"><a href="/index.php">
                    <img src="/logo.jpg" alt="OK2Shop Logo">
                </a></div>
            <nav id="mainMenu">
                <ul style="display: flex; list-style: none; gap: 20px;">
                    <li><a href="/index.php">Home</a></li>
                    <li><a href="/about.php">About</a></li>
                    <li><a href="/wiki.php">Help Guide</a></li> </ul>
            </nav>
            <!-- USER SECTION -->
            <div style="display: inline-flex;" id="user">
                <a href="../cart.php"><i class="material-icons">shopping_cart</i></a>
                <?php if (isset($_SESSION['user_id'])) :
                    echo '<a class="link" href="../server/logout.php" style="color: #e74c3c;">logout</a>';
                ?>
                <?php include('./admin/themes.php'); ?>
                <?php else:
                    echo '<a href="../server/register.php">Register</a> | ';
                    echo '<a href="../server/login.php">Login</a>';
                endif ?>
            </div>
        </div>

    </section>
</header>