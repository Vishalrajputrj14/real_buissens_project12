<?php
// Step 1: Connect to database
$host = "localhost";
$dbUsername = "root";
$dbPassword = "2352005";
$dbName = "lucky_saree";

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Get POST data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// Step 3: Insert into table
$sql = "INSERT INTO contact_messages (name, email, phone, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $phone, $message);

if ($stmt->execute()) {
    echo "<script>alert('✅ Message Sent Successfully!'); window.location.href='contact.html';</script>";
} else {
    echo "<script>alert('❌ Failed to send message: " . $stmt->error . "');</script>";
}

$stmt->close();
$conn->close();
?>
