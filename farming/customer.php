<?php
// customer.php
// Customer dashboard page
session_start();
include 'database_connection.php';

// Check if user is logged in and is a customer
if (!isset($_SESSION['loggedin']) || $_SESSION['user_type'] !== 'customer') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - Farm System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background: #4CAF50;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        nav {
            background: #333;
            color: #fff;
        }
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }
        nav ul li {
            padding: 10px 15px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
        }
        .main-content {
            padding: 20px;
            background: #fff;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .user-info {
            margin-top: 20px;
            padding: 10px;
            background: #e8f5e9;
            border-radius: 5px;
        }
        .product-categories {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
        }
        .category-card {
            flex: 1;
            min-width: 200px;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s;
        }
        .category-card:hover {
            transform: translateY(-10px);
        }
        .category-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .btn:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Farm Connection System</h1>
    </header>
    
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="customer.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    
    <div class="container">
        <div class="main-content">
            <h2>Customer Dashboard</h2>
            
            <div class="user-info">
                <h3>Welcome, <?php echo $_SESSION['full_name']; ?>!</h3>
                <p>Browse farming products by category below.</p>
            </div>
            
            <div class="product-categories">
                <div class="category-card">
                    <div class="category-icon">🌱</div>
                    <h3>Seeds</h3>
                    <p>Browse various seed types for your farming needs.</p>
                    <a href="seeds.php" class="btn">View Seeds</a>
                </div>
                
                <div class="category-card">
                    <div class="category-icon">🚜</div>
                    <h3>Ploughing</h3>
                    <p>Explore ploughing equipment and services.</p>
                    <a href="ploughing.php" class="btn">View Ploughing</a>
                </div>
                
                <div class="category-card">
                    <div class="category-icon">💧</div>
                    <h3>Irrigation</h3>
                    <p>Discover irrigation systems for effective water management.</p>
                    <a href="irrigation.php" class="btn">View Irrigation</a>
                </div>
                
                <div class="category-card">
                    <div class="category-icon">🧪</div>
                    <h3>Fertilizer</h3>
                    <p>Find the right fertilizers for optimal crop growth.</p>
                    <a href="fertilizer.php" class="btn">View Fertilizers</a>
                </div>
                
                <div class="category-card">
                    <div class="category-icon">🌾</div>
                    <h3>Harvesting</h3>
                    <p>Access harvesting equipment and services.</p>
                    <a href="harvesting.php" class="btn">View Harvesting</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>