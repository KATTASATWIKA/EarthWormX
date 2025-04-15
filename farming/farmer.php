<?php
// farmer.php
// Farmer dashboard page
session_start();
include 'database_connection.php';

// Check if user is logged in and is a farmer
if (!isset($_SESSION['loggedin']) || $_SESSION['user_type'] !== 'farmer') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Dashboard - Farm System</title>
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
        .farming-categories {
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
        <h1>EarthWormX</h1>
    </header>
    
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="farmer.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
            <li><a href="orders.php">Orders & Previous Transactions</a></li>

        </ul>
    </nav>
    
    <div class="container">
        <div class="main-content">
            <h2>Farmer Dashboard</h2>
            
            <div class="user-info">
                <h3>Welcome, <?php echo $_SESSION['full_name']; ?>!</h3>
                <p>Manage your farming activities and resources through the categories below.</p>
            </div>
            
            <div class="farming-categories">
                <div class="category-card">
                    <div class="category-icon">🌱</div>
                    <h3>Seeds</h3>
                    <p>Browse and manage your seed inventory. Add new seed types and check availability.</p>
                    <a href="seeds.php" class="btn">View Seeds</a>
                </div>
                
                <div class="category-card">
                    <div class="category-icon">🚜</div>
                    <h3>Ploughing</h3>
                    <p>Access ploughing equipment and services for field preparation.</p>
                    <a href="ploughing.php" class="btn">View Ploughing</a>
                </div>
                
                <div class="category-card">
                    <div class="category-icon">💧</div>
                    <h3>Irrigation</h3>
                    <p>Manage irrigation systems and water resources for optimal crop growth.</p>
                    <a href="irrigation.php" class="btn">View Irrigation</a>
                </div>
                
                <div class="category-card">
                    <div class="category-icon">🧪</div>
                    <h3>Fertilizer</h3>
                    <p>Access various fertilizers and soil amendments for your crops.</p>
                    <a href="fertilizer.php" class="btn">View Fertilizers</a>
                </div>
                
                <div class="category-card">
                    <div class="category-icon">🌾</div>
                    <h3>Harvesting</h3>
                    <p>Manage harvesting equipment and services for your crops.</p>
                    <a href="harvesting.php" class="btn">View Harvesting</a>
                </div>
                <div class="category-card">
                    <div class="category-icon">$</div>
                    <h3>Sell</h3>
                    <p>Sell crop.</p>
                    <a href="sell.php" class="btn">View page</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script>const apiKey = "64407747bc494dba954222024250904";
const city = "Hyderabad"; // or use geolocation
const url = `https://api.openweathermap.org/data/2.5/forecast/daily?q=${city}&cnt=10&units=metric&appid=${apiKey}`;

async function fetchWeather() {
  try {
    const res = await fetch(url);
    const data = await res.json();
    displayWeather(data.list);
  } catch (err) {
    console.error("Error fetching weather:", err);
  }
}

function displayWeather(forecast) {
  const list = document.getElementById("weather-list");
  list.innerHTML = "";
  forecast.forEach((day, index) => {
    const date = new Date(day.dt * 1000).toDateString();
    const temp = day.temp.day;
    const desc = day.weather[0].description;
    const item = document.createElement("li");
    item.textContent = `${date}: ${temp}°C, ${desc}`;
    list.appendChild(item);
  });
}



  
fetchWeather();
</script>
</html>