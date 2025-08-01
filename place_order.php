<?php
session_start();
$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    die("Cart is empty!");
}

// Connect to DB
$conn = new mysqli("localhost", "root", "2352005", "lucky_saree");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data safely
$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$address = $_POST['address'] ?? '';
$total = $_POST['total_amount'] ?? 0;

// Insert order
$stmt = $conn->prepare("INSERT INTO orders (name, phone, email, address, total_amount) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssd", $name, $phone, $email, $address, $total);
$stmt->execute();
$order_id = $stmt->insert_id;
$stmt->close();

// Insert items
foreach ($cart as $item) {
    $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_name, price, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isdi", $order_id, $item['name'], $item['price'], $item['qty']);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
unset($_SESSION['cart']);

echo "<script>alert('✅ Order placed successfully!'); window.location='products.html';</script>";
?>
