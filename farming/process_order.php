<?php
include 'db_connection.php'; // your DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'] ?? null;

    if (!$product_id) {
        echo "❌ Missing data in POST request.";
        exit;
    }

    // Fetch product details from DB
    $query = "SELECT * FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Now insert into orders table
        $insert = $conn->prepare("INSERT INTO orders (product_id, order_date) VALUES (?, NOW())");
        $insert->bind_param("i", $product_id);
        if ($insert->execute()) {
            echo "✅ Order placed for product: " . htmlspecialchars($row['name']);
        } else {
            echo "❌ Failed to place order.";
        }
    } else {
        echo "❌ Product not found.";
    }
}
?>
