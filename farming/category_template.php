<?php
// category_template.php
// Template for displaying products by category
function displayCategoryPage($category, $category_title, $category_icon) {
    session_start();
    include 'database_connection.php';
    
    // Check if user is logged in
    if (!isset($_SESSION['loggedin'])) {
        header("Location: login.php");
        exit;
    }
    
    // Fetch products for this category
    $stmt = $conn->prepare("SELECT * FROM products WHERE category = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // HTML output
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $category_title; ?> - Farm System</title>
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
            .category-header {
                display: flex;
                align-items: center;
                margin-bottom: 30px;
            }
            .category-icon {
                font-size: 48px;
                margin-right: 20px;
            }
            .product-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 20px;
            }
            .product-card {
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 15px;
                transition: transform 0.3s;
            }
            .product-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }
            .product-image {
                height: 150px;
                background-color: #eee;
                margin-bottom: 10px;
                border-radius: 3px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px;
            }
            .product-name {
                font-weight: bold;
                margin-bottom: 5px;
            }
            .product-price {
                color: #4CAF50;
                font-weight: bold;
                margin-bottom: 5px;
            }
            .product-stock {
                color: #777;
                font-size: 0.9em;
                margin-bottom: 10px;
            }
            .btn {
                display: inline-block;
                padding: 8px 12px;
                background: #4CAF50;
                color: #fff;
                text-decoration: none;
                border-radius: 3px;
                border: none;
                cursor: pointer;
                font-size: 0.9em;
            }
            .btn:hover {
                background: #45a049;
            }
            .back-link {
                margin-top: 20px;
                display: inline-block;
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
                <?php if($_SESSION['user_type'] == 'farmer'): ?>
                    <li><a href="farmer.php">Dashboard</a></li>
                <?php else: ?>
                    <li><a href="customer.php">Dashboard</a></li>
                <?php endif; ?>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        
        <div class="container">
            <div class="main-content">
                <div class="category-header">
                    <div class="category-icon"><?php echo $category_icon; ?></div>
                    <h2><?php echo $category_title; ?></h2>
                </div>
                
                <?php if($result->num_rows > 0): ?>
                    <div class="product-grid">
                        <?php while($product = $result->fetch_assoc()): ?>
                            <div class="product-card">
                                <div class="product-image">
                                    <?php echo substr($product['name'], 0, 1); ?>
                                </div>
                                <div class="product-name"><?php echo $product['name']; ?></div>
                                <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
                                <div class="product-stock">In stock: <?php echo $product['stock']; ?></div>
                                <p><?php echo substr($product['description'], 0, 80) . '...'; ?></p>
                                <button class="btn">Add to Cart</button>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <p>No products available in this category at the moment.</p>
                <?php endif; ?>
                
                <a href="<?php echo $_SESSION['user_type'] == 'farmer' ? 'farmer.php' : 'customer.php'; ?>" class="back-link">← Back to Dashboard</a>
            </div>
        </div>
    </body>
    </html>
    <?php
    
    $stmt->close();
}
?>