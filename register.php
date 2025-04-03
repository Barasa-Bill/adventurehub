<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - AdventureHub</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="signup.js" defer></script>
    <style>
        /* Basic styling if styles.css is not available */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .nav {
            background-color: #B3BFB8;
            padding: 1rem;
        }
        .nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
        }
        .nav li {
            margin: 0 15px;
        }
        .nav a {
            color: white;
            text-decoration: none;
        }
        .registration-form {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .registration-form label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        .registration-form input {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .registration-form button {
            background-color: #3498db;
            color: white;
            padding: 0.7rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }
        .registration-form button:hover {
            background-color: #2980b9;
        }
        .footer {
            text-align: center;
            padding: 1rem;
            background-color: #2c3e50;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .error {
            color: red;
            font-size: 0.9rem;
            margin-top: -0.5rem;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>

    <nav class="nav">
        <ul>
            <li><a href="home.php">Home</a></li>    
            <li><a href="destinations.php">Destinations</a></li>
            
            <li><a href="login.php">Login</a></li>
        </ul>   
    </nav> 

    <main>
        <h1 style="text-align: center; margin-top: 2rem;">Create Your Account</h1>
        <p style="text-align: center;">Register with Safiri Travels and start your adventure!</p>

        <div class="registration-form">
            <form id="registerForm" action="register_process.php" method="POST">
                <div>
                    <label for="full_name">Full Name:</label>
                    <input type="text" id="full_name" name="full_name" required 
                           pattern="[A-Za-z ]+" 
                           title="Name should contain only alphabets and spaces">
                    <div id="nameError" class="error"></div>
                </div>

                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    <div id="emailError" class="error"></div>
                </div>

                <div>
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" required>
                    <div id="phoneError" class="error"></div>
                </div>

                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required minlength="8">
                    <div id="passwordError" class="error"></div>
                </div>

                <div>
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                    <div id="confirmError" class="error"></div>
                </div>

                <div style="text-align: center; margin-top: 1.5rem;">
                    <button type="submit">Register</button>
                </div>
                
                <p style="text-align: center; margin-top: 1rem;">
                    Already have an account? <a href="login.php">Login here</a>
                </p>
            </form>
        </div>
    </main>

    <footer class="footer">
        <p>© 2025 AdventureHub | Your Journey, Our Priority</p>
    </footer>

    <script>
        // Basic client-side validation
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            let isValid = true;
            
            // Clear previous errors
            document.querySelectorAll('.error').forEach(el => el.textContent = '');
            
            // Name validation - only alphabets and spaces allowed
            const name = document.getElementById('full_name').value.trim();
            if (!/^[A-Za-z ]+$/.test(name)) {
                document.getElementById('nameError').textContent = 'Name should contain only alphabets and spaces';
                isValid = false;
            } else if (name.length < 2) {
                document.getElementById('nameError').textContent = 'Name must be at least 2 characters';
                isValid = false;
            }
            
            // Email validation
            const email = document.getElementById('email').value.trim();
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                document.getElementById('emailError').textContent = 'Please enter a valid email address';
                isValid = false;
            }
            
            // Phone validation
            const phone = document.getElementById('phone').value.trim();
            if (!/^[\d\s\-+]{10,15}$/.test(phone)) {
                document.getElementById('phoneError').textContent = 'Please enter a valid phone number';
                isValid = false;
            }
            
            // Password validation
            const password = document.getElementById('password').value;
            if (password.length < 8) {
                document.getElementById('passwordError').textContent = 'Password must be at least 8 characters';
                isValid = false;
            }
            
            // Confirm password
            const confirmPassword = document.getElementById('confirm_password').value;
            if (password !== confirmPassword) {
                document.getElementById('confirmError').textContent = 'Passwords do not match';
                isValid = false;
            }
            
            if (!isValid) {
                event.preventDefault();
            }
        });

        // Real-time name validation as user types
        document.getElementById('full_name').addEventListener('input', function() {
            const name = this.value.trim();
            const nameError = document.getElementById('nameError');
            
            if (!/^[A-Za-z ]*$/.test(name)) {
                nameError.textContent = 'Name can only contain letters and spaces';
            } else {
                nameError.textContent = '';
            }
        });
    </script>

</body>
</html>