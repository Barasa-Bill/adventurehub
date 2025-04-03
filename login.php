<?php
session_start();

// Check if user is already logged in
if(isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

// Check for login errors
$login_error = '';
if(isset($_SESSION['login_error'])) {
    $login_error = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}

// Check for success messages (like after registration)
$success_message = '';
if(isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Safiri Travels</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        /* Basic styling if styles.css is not available */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f5f5f5;
        }
        .nav {
            background-color: #2c3e50;
            padding: 1rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
            flex-wrap: wrap;
        }
        .nav li {
            margin: 0 15px;
        }
        .nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        .nav a:hover {
            color: #3498db;
        }
        h1 {
            text-align: center;
            margin-top: 2rem;
            color: #2c3e50;
        }
        p.subtitle {
            text-align: center;
            color: #7f8c8d;
            margin-bottom: 2rem;
        }
        .login-form {
            max-width: 400px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .login-form label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #2c3e50;
        }
        .login-form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border 0.3s;
        }
        .login-form input:focus {
            border-color: #3498db;
            outline: none;
        }
        .login-form button {
            width: 100%;
            background-color: #3498db;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s;
        }
        .login-form button:hover {
            background-color: #2980b9;
        }
        .login-form p {
            text-align: center;
            margin-top: 1rem;
        }
        .login-form a {
            color: #3498db;
            text-decoration: none;
        }
        .login-form a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: #e74c3c;
            background-color: #fadbd8;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 1rem;
            text-align: center;
        }
        .success-message {
            color: #27ae60;
            background-color: #d5f5e3;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 1rem;
            text-align: center;
        }
        .footer {
            text-align: center;
            padding: 1.5rem;
            background-color: #2c3e50;
            color: white;
            margin-top: 2rem;
        }
        .password-container {
            position: relative;
        }
        .show-password {
            position: absolute;
            right: 10px;
            top: 35px;
            cursor: pointer;
            color: #7f8c8d;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <nav class="nav">
        <ul>
            <li><a href="home.php">Home</a></li>    
            <li><a href="destinations.php">Destinations</a></li>
            
            <li><a href="register.php">Register</a></li>
        </ul>   
    </nav> 

    <main>
        <h1>Login to Your Account</h1>
        <p class="subtitle">Welcome back! Please enter your credentials to continue.</p>

        <div class="login-form">
            <?php if($login_error): ?>
                <div class="error-message"><?php echo htmlspecialchars($login_error); ?></div>
            <?php endif; ?>
            
            <?php if($success_message): ?>
                <div class="success-message"><?php echo htmlspecialchars($success_message); ?></div>
            <?php endif; ?>

            <form action="login_process.php" method="POST">
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required autocomplete="email">
                </div>

                <div class="password-container">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password">
                    <span class="show-password" onclick="togglePassword()">Show Password</span>
                </div>

                <div style="margin-top: 1.5rem;">
                    <button type="submit">Login</button>
                </div>
                
                <p>Don't have an account? <a href="register.php">Sign up here</a></p>
                <p><a href="forgot_password.php">Forgot your password?</a></p>
            </form>
        </div>
    </main>

    <footer class="footer">
        <p>© 2025 Safiri Travels | Your Journey, Our Priority</p>
    </footer>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const showPasswordText = document.querySelector('.show-password');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                showPasswordText.textContent = 'Hide Password';
            } else {
                passwordField.type = 'password';
                showPasswordText.textContent = 'Show Password';
            }
        }

        // Focus on email field when page loads
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('email').focus();
        });
    </script>

</body>
</html>