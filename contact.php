<?php
$host = "localhost";
$username = "root";
$password = "2352005";
$database = "lucky_saree";

// DB connection
$conn = new mysqli($host, $username, $password, $database);

// Check
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch POST data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$message = $_POST['message'] ?? '';

// Validate input (optional: add more checks)
if ($name && $email && $phone && $message) {
  $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, message) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $email, $phone, $message);
  
  if ($stmt->execute()) {
    echo "<script>alert('Message sent successfully!'); window.location.href='contact.html';</script>";
  } else {
    echo "<script>alert('Failed to send message. Try again later.'); window.history.back();</script>";
  }

  $stmt->close();
} else {
  echo "<script>alert('Please fill all fields.'); window.history.back();</script>";
}

$conn->close();
?>
