<?php
// Database connection parameters
$host = "localhost";
$username = "root";
$password = ""; // This may vary if you have set a password for your MySQL root user
$database = "password";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the email already exists in the 'users' table
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $email = $_POST["email"];
    $checkEmailQuery = "SELECT COUNT(*) AS count FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result && $row = $result->fetch_assoc()) {
        $count = $row["count"];
        echo ($count > 0) ? 'exists' : 'not_exists';
    } else {
        echo 'error';
    }
} else {
    echo 'invalid_request';
}

// Close the database connection
$conn->close();
?>
