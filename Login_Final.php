<?php
    /*// Database connection parameters
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "password";

    // Create a database connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process login form data
    $loginErrorMessage = ""; // Initialize error message

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Check if the email exists in the database
        $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($checkEmailQuery);

        if ($result->num_rows > 0) {
            // Email exists, proceed with login
            $row = $result->fetch_assoc();
            $hashedPassword = $row["password"];

            if (password_verify($password, $hashedPassword)) {
                // Password is correct, perform login actions
                header("Location: Main.html");
                // You can redirect the user to a different page or perform other actions here
            } else {
                // Password is incorrect
                $loginErrorMessage = "Invalid password";
            }
        } else {
            // Email is not registered
            $loginErrorMessage = "User not registered";
        }
    }

    // Close the database connection
    $conn->close();*/

    // Database connection parameters
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "password";

    // Create a database connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process login form data
    $loginErrorMessage = ""; // Initialize error message

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Check if the email exists in the database
        $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($checkEmailQuery);

        if ($result->num_rows > 0) {
            // Email exists, proceed with login
            $row = $result->fetch_assoc();
            $hashedPassword = $row["password"];

            if (password_verify($password, $hashedPassword)) {
                // Password is correct, perform login actions
                echo '<script>window.location.href = "http://127.0.0.1:5000";</script>';
                exit; // Ensure that no further PHP code is executed after the redirect
            } else {
                // Password is incorrect
                $loginErrorMessage = "Invalid password";
            }
        } else {
            // Email is not registered
            $loginErrorMessage = "User not registered";
        }
    }

    // Close the database connection
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Your Website Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="Stylee.css">
    <style>
        .login-container {
            width: 65%;
            height: 135%;
            margin-top: -100px;
            margin-left: 18%;
            padding: 5px;
            background: rgba(0, 0, 0, 0.5); /* Transparent background */
            border-radius: 30px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            color: #fff; /* Text color */
            font-family: 'Times New Roman', Times, serif;
        }

        .login-container h2 {
            text-align: center;
            font-family: 'Times New Roman', Times, serif;
            color: #e50914;
        }

        .login-form {
            display: grid;
            gap: 15px;
            margin-top: 20px;
        }

        .form-group label {
            font-size: 1.2em;
            text-align: left;
            display: block;
            color: #fff; /* Text color */
        }

        .form-group input {
            padding: 10px;
            font-size: 1em;
            width: 100%;
            background: rgba(0, 0, 0, 0); /* Transparent background */
            border: 1px solid #fff;
            border-radius: 5px;
            color: #fff; /* Text color */
            font-family: 'Times New Roman', Times, serif;
        }

        .form-groups button {
            font-size: 100em;
            padding: 12px;
            background-color: #dcd1d100;
            color: #ffffff00;
            border: 0;
            border-radius: 5px;
            cursor: pointer;
        }

        .signup-link {
            text-align: center;
            margin-top: 15px;
            font-size: 1.1em;
            color: #fff; /* Text color */
        }

        .signup-link a {
            color: #e50914;
            text-decoration: underline;
            font-size: 1.05em;
        }
    </style>
</head>
<body bgcolor="black">
    <header>  
        <div>
            <a href="/" class="logo">
                <img src="Weblogo.png">
            </a>
        </div>
        <div>
            <div class="select">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M21.721 12.752a9.711 9.711 0 00-.945-5.003 12.754 12.754 0 01-4.339 2.708 18.991 18.991 0 01-.214 4.772 17.165 17.165 0 005.498-2.477zM14.634 15.55a17.324 17.324 0 00.332-4.647c-.952.227-1.945.347-2.966.347-1.021 0-2.014-.12-2.966-.347a17.515 17.515 0 00.332 4.647 17.385 17.385 0 005.268 0zM9.772 17.119a18.963 18.963 0 004.456 0A17.182 17.182 0 0112 21.724a17.18 17.18 0 01-2.228-4.605zM7.777 15.23a18.87 18.87 0 01-.214-4.774 12.753 12.753 0 01-4.34-2.708 9.711 9.711 0 00-.944 5.004 17.165 17.165 0 005.498 2.477zM21.356 14.752a9.765 9.765 0 01-7.478 6.817 18.64 18.64 0 001.988-4.718 18.627 18.627 0 005.49-2.098zM2.644 14.752c1.682.971 3.53 1.688 5.49 2.099a18.64 18.64 0 001.988 4.718 9.765 9.765 0 01-7.478-6.816zM13.878 2.43a9.755 9.755 0 016.116 3.986 11.267 11.267 0 01-3.746 2.504 18.63 18.63 0 00-2.37-6.49zM12 2.276a17.152 17.152 0 012.805 7.121c-.897.23-1.837.353-2.805.353-.968 0-1.908-.122-2.805-.353A17.151 17.151 0 0112 2.276zM10.122 2.43a18.629 18.629 0 00-2.37 6.49 11.266 11.266 0 01-3.746-2.504 9.754 9.754 0 016.116-3.985z" />
                </svg>
                <select style="font-family: 'Times New Roman', Times, serif;">
                    <option value="">English</option>
                    <option value="">Swedish</option>
                </select>                      
            </div>
        </div>
    </header>  

    <div class="splash">
        <div class="background">
            <img src="https://cdn.dribbble.com/users/1889975/screenshots/14337327/media/1deb140922c5e513b5b57d28f4bbad75.png">
            <div class="gradient"></div>
        </div>
        <div class="content">
            <div class="login-container">
                <form class="login-form" method="POST" action="Login_Final.php" onsubmit="return validateForm()">
                    <h2 style="margin-top: -2%; font-size: 1.9em;"><b>Login to WebStyx</b></h2>

                    <div class="form-group">
                        <label for="email" style="padding-bottom: 2%; margin-top: -5%;">Email address:</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" style="margin-bottom: 2%;" required oninput="validateEmail()">
                        <div id="emailValidationError" style="color: red; font-size: 1em; margin-bottom: 2%;"></div>
                    </div>
                    <div class="form-group">
                        <label for="password" style="padding-bottom: 2%; margin-top: -2%; ">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        <p id="passwordError" style="color: red; font-size: 1em; margin-bottom: -1%;"><?php echo $loginErrorMessage; ?></p>
                    </div>
                    <div class="form-groups">
                        <button type="submit" style="width: 100%; margin-left: 0%; font-family: 'Times New Roman', Times, serif;">Login</button>
                    </div>
                </form>

                <p class="signup-link" >New User ? <a href="Signup_Final.php">Register here</a></p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Attach the validate function to the input and change events of the form fields
            document.getElementById('email').addEventListener('input', validateEmail);
            document.getElementById('password').addEventListener('input', validateLoginForm);
        });

        function validateEmail() {
            // Reset the error message
            document.getElementById('emailValidationError').innerText = '';

            // Email validation
            var email = document.getElementById('email').value;
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(email) && email.length > 0) {
                document.getElementById('emailValidationError').innerText = 'Invalid email format';
                return;
            }

            // Make an asynchronous request to check if the email exists
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Response from the server
                        var response = JSON.parse(xhr.responseText);
                        if (response.exists) {
                            document.getElementById('emailValidationError').innerText = '';
                        } else {
                            document.getElementById('emailValidationError').innerText = 'User not registered';
                        }
                    }
                }
            };

            // Send the request to the server
            xhr.open('POST', 'Check.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('email=' + encodeURIComponent(email));
        }

        function validateLoginForm() {
            // Reset error message
            document.getElementById('passwordError').innerText = '';

            // Password validation
            var password = document.getElementById('password').value;

            if (password.length === 0) {
                document.getElementById('passwordError').innerText = 'Password is required';
                return false;
            }

            return true;
        }
    </script>

</body>
</html>
