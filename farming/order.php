<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "seed_store";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product_id = $_POST['product_id'];
$type = $_POST['type'];
$name = $_POST['name'];
$image = $_POST['image'];
$price = $_POST['price']; // ✅ Fixed by adding semicolon

$stmt = $conn->prepare("INSERT INTO orders (product_id, type, name, image, price) VALUES (?, ?, ?, ?, ?)");
if ($stmt) {
    $stmt->bind_param("isssd", $product_id, $type, $name, $image, $price);
    if ($stmt->execute()) {
        echo "✅ Order placed successfully!";
    } else {
        echo "❌ Execution error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "❌ Preparation error: " . $conn->error;
}

$conn->close();
?>
