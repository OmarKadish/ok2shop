<?php
require_once("./server/db.php");

if (!isset($_SESSION['user_id'])) {
    echo "<p>Please <a href='server/login.php'>login</a> to view your cart.</p>";
    exit();
}

$user_id = $_SESSION['user_id'];

$cart_query = "SELECT * FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($cart_query);
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<?php include('./layout/header.php'); ?>
    <section>
        <h1>Shopping Cart</h1>
        <h1>Make sure you don't forget anything!</h1>
        <div id="cart-container">
            <?php if (empty($cart_items)): ?>
                <p>Your cart is empty.</p>
            <?php else:
                foreach ($cart_items as $item):
                    echo '<div class="cart-item">
                        <h2>' . $item['product_name'] . '</h2>
                        <p class= "price">Price:' . number_format($item['price'], 2) . '</p>
                        <p class="quantity">Quantity:' . $item['quantity'] . '</p>
                    </div>';
                endforeach;
            endif; ?>

        </div>
        <h4 id="total">total:</h4>
        <button id="checkout">Checkout</button>
    </section>

<script src="./resources/script.js"></script>
<?php include('./layout/footer.html'); ?>
