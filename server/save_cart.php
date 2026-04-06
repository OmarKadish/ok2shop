<?php
require_once("db.php");

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
//    echo ($_POST['name']) ?? 0;
    exit();
}

$type = $_POST['type'] ?? 'add';
$user_id = $_SESSION['user_id'];

if ($type === 'remove') {
    if (!isset($_POST['cart_id'])) {
        echo json_encode(['success' => false, 'message' => 'Missing cart ID']);
        exit();
    }

    $cart_id = intval($_POST['cart_id']);

    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
    $stmt->execute([$cart_id, $user_id]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Item not found or unauthorized']);
    }
    exit();
}

if ($type === 'add') {

    if (!isset($_POST['product_id'], $_POST['quantity'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
        echo($_POST['name']);
        exit();
    }


//prapare data
    $product_id = intval($_POST['product_id'] ?? 0);
//$product_name = $_POST['name'];
//$product_price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity'] ?? 1);
    $option = $_POST['option'] ?? "";

//// Check if already in cart
//$check = $conn->prepare("SELECT id FROM cart WHERE user_id = ? AND product_id = ?");
//$check->execute([$user_id, $product_id]);
//$item = $check->fetch();

// Check if the item is already in the cart
    $insertQuery = "INSERT INTO cart (user_id, product_id, option_details, quantity) 
                VALUES (?, ?, ?, ?) 
                ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)";

    $stmt = $conn->prepare($insertQuery);
    $stmt->execute([$user_id, $product_id, $option, $quantity]);

    echo json_encode(["success" => true]);
    header('Location:' . $GLOBALS['home_url']);
}
