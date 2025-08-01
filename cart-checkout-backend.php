<?php
$host = "localhost";
$user = "root";
$password = "2352005";
$dbname = "lucky_saree";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic validation to prevent error
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $total = $_POST['total'] ?? 0;

    // Escape inputs
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $phone = $conn->real_escape_string($phone);
    $address = $conn->real_escape_string($address);
    $total = floatval($total);

    if (!empty($name) && !empty($email) && !empty($phone)) {
        $sql = "INSERT INTO orders (customer_name, email, phone, address, total_amount) 
                VALUES ('$name', '$email', '$phone', '$address', $total)";

        if ($conn->query($sql) === TRUE) {
            echo "<h2>Thank you for your order, $name!</h2><p>We will contact you shortly on $phone or $email.</p>";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Missing required fields!";
    }
}

$conn->close();
?>
