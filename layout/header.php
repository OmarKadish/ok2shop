<?php

?>

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
                    echo '<a class="link" href="../admin/index.php">Dashboard</a>';
                    echo '<a class="link" href="../server/logout.php" style="color: #e74c3c;">logout</a>';
                ?>
                <?php include(ROOT_PATH.'/admin/themes.php'); ?>
                <?php else:
                    echo '<a href="../server/register.php">Register</a> | ';
                    echo '<a href="../server/login.php">Login</a>';
                endif ?>
            </div>
        </div>

    </section>
</header>