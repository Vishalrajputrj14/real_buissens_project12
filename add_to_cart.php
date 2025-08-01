<?php
session_start();

// Get product data
$id = $_POST['product_id'];
$name = $_POST['product_name'];
$price = $_POST['product_price'];

// Create cart item array
$item = [
  'id' => $id,
  'name' => $name,
  'price' => $price,
  'qty' => 1
];

// Add to session cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// If item already in cart, increase quantity
$found = false;
foreach ($_SESSION['cart'] as &$cartItem) {
    if ($cartItem['id'] == $id) {
        $cartItem['qty']++;
        $found = true;
        break;
    }
}
if (!$found) {
    $_SESSION['cart'][] = $item;
}

header('Location: cart.php');
exit;
?>
