<?php
session_start();
include 'database_connection.php';

$error = '';
$success = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $user_type = $_POST['user_type'];
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    
    // Validate inputs
    if (empty($username) || empty($password) || empty($user_type) || empty($full_name)) {
        $error = "All required fields must be filled";
    } elseif ($password != $confirm_password) {
        $error = "Passwords do not match";
    } else {
        // Check if username already exists
        $check_sql = "SELECT * FROM users WHERE username = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $result = $check_stmt->get_result();
        
        if ($result->num_rows > 0) {
            $error = "Username already exists. Please choose another.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO users (username, password, user_type, full_name, phone) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $hashed_password, $user_type, $full_name, $phone);
            
            // Execute the statement
            if ($stmt->execute()) {
                $success = "Registration successful! You can now log in.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
            
            $stmt->close();
        }
        $check_stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Farm System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            background: url(https://images.unsplash.com/photo-1498408040764-ab6eb772a145?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y3JvcHN8ZW58MHx8MHx8fDA%3D);
            background-size:cover;
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
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
        .form-group input, .form-group select {
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
        .success {
            color: green;
            margin-bottom: 10px;
        }
        .login-link {
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
            <h2>Register</h2>
            
            <?php if($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            
            <?php if($success): ?>
                <p class="success"><?php echo $success; ?></p>
            <?php endif; ?>
            
            <form action="register.php" method="post">
                <div class="form-group">
                    <label for="username">Username *</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password *</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm Password *</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                
                <div class="form-group">
                    <label for="user_type">Register as *</label>
                    <select id="user_type" name="user_type" required>
                        <option value="">Select Type</option>
                        <option value="farmer">Farmer</option>
                        <option value="customer">Customer</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="full_name">Full Name *</label>
                    <input type="text" id="full_name" name="full_name" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone">
                </div>
                
                <button type="submit" class="btn">Register</button>
            </form>
            
            <div class="login-link">
                Already have an account? <a href="login.php">Login here</a>
            </div>
        </div>
    </div>
</body>
</html>