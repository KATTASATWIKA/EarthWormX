<?php
session_start();
include 'database_connection.php';

$error = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Validate inputs
    if (empty($username) || empty($password)) {
        $error = "Username and password are required";
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("SELECT id, username, password, user_type, full_name FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        
        // Execute the statement
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
        
            if (password_verify($password, $user['password'])) {
                // Password is correct, start a new session
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_type'] = $user['user_type'];
                $_SESSION['full_name'] = $user['full_name'];
        
                // Redirect based on user type
                if ($user['user_type'] === 'farmer') {
                    header("Location: farmer.php");
                } elseif ($user['user_type'] === 'customer') {
                    header("Location: user.php");
                } else {
                    header("Location: dashboard.php");
                }
                exit;
            } else {
                $error = "Invalid username or password";
            }
        } else {
            $error = "Invalid username or password";
        }
        
        
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EARTHWORMX</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color:rgb(13, 13, 13);
            background: url(https://images.unsplash.com/photo-1498408040764-ab6eb772a145?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y3JvcHN8ZW58MHx8MHx8fDA%3D);
            background-size:cover;
        }
        .container {
            width: 80%;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background: #45a049;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .register-link {
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
    </header>
    
    <div class="container">
        <div class="form-container">
            <h2>Login</h2>
            
            <?php if($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn">Login</button>
            </form>
            
            <div class="register-link">
                Don't have an account? <a href="register.php">Register here</a>
            </div>
        </div>
    </div>
</body>
</html>

