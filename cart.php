<?php
include("./config.php");
require_once(ROOT_PATH."/server/db.php");

if (!isset($_SESSION['user_id'])) {
    echo "<p>Please <a href='server/login.php'>login</a> to view your cart.</p>";
    exit();
}

$user_id = $_SESSION['user_id'];

$cart_query = "SELECT c.*, p.name, p.price, p.image FROM cart c 
               INNER JOIN products p ON p.id = c.product_id
               WHERE c.user_id = ?";
$stmt = $conn->prepare($cart_query);
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
    <link rel="stylesheet" href="./resources/css/cart.css">
    <link rel="stylesheet" href="../resources/css/<?php echo $theme; ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
<?php include('./layout/header.php'); ?>
    <section>
        <h1>Shopping Cart</h1>
        <h1>Make sure you don't forget anything!</h1>
        <div id="cart-container">
            <?php if (empty($cart_items)): ?>
                <p>Your cart is empty.</p>
            <?php else:
                foreach ($cart_items as $item):
                    $item_total = $item['price'] * $item['quantity'];
                    echo '<div class="cart-item">
                        <h2>' . htmlspecialchars($item['name']) . '</h2>
                        <p class= "price">Unit Price:' . number_format($item['price'], 2) . '</p>
                        <p class="quantity">Quantity:' . $item['quantity'] . '</p>
                        <p class="item-total-price">$ '. number_format($item_total, 2) .'</p>
                        <button class="remove-btn" data-id="'. $item['id'].'" >Remove</button>   
                    </div>';
                endforeach;
            endif; ?>

        </div>
        <div id="total-display">
            <h3>Total: <span id="total-amount">0.00</span></h3>
        </div>
        <button id="checkout">Checkout</button>
    </section>

<script src="./resources/script.js"></script>
<?php include('./layout/footer.html'); ?>
