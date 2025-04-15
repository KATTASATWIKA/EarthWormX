<?php
// cancel_order.php
session_start();
include 'database_connection.php';

// Check if user is logged in
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

// Check if order ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = "Invalid order ID";
    header("Location: orders.php");
    exit;
}

$order_id = (int)$_GET['id'];

// Verify the order belongs to the current user
$stmt = $conn->prepare("SELECT id, status FROM orders WHERE order_id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = "Order not found";
    header("Location: orders.php");
    exit;
}

$order = $result->fetch_assoc();

// Check if the order belongs to the current user
if ($order['id'] != $_SESSION['id']) {
    $_SESSION['error'] = "You don't have permission to cancel this order";
    header("Location: orders.php");
    exit;
}

// Check if the order is still in 'Pending' status
if ($order['status'] !== 'Pending') {
    $_SESSION['error'] = "Only pending orders can be cancelled";
    header("Location: orders.php");
    exit;
}

// Start transaction
$conn->begin_transaction();

try {
    // Update order status
    $stmt = $conn->prepare("UPDATE orders SET status = 'Cancelled' WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    
    // Return items to inventory
    $stmt = $conn->prepare("
        SELECT oi.product_id, oi.quantity 
        FROM order_items oi 
        WHERE oi.order_id = ? AND oi.product_id > 0
    ");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
    // Update product stock for each item
    foreach ($items as $item) {
        if ($item['product_id'] > 0) {
            $updateStmt = $conn->prepare("UPDATE products SET stock = stock + ? WHERE product_id = ?");
            $updateStmt->bind_param("ii", $item['quantity'], $item['product_id']);
            $updateStmt->execute();
        }
    }
    
    // Commit transaction
    $conn->commit();
    
    $_SESSION['success'] = "Order #" . $order_id . " has been cancelled successfully";
} catch (Exception $e) {
    // Rollback on error
    $conn->rollback();
    $_SESSION['error'] = "Failed to cancel order: " . $e->getMessage();
}

header("Location: orders.php");
exit;