<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "password";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);

    $response = ['exists' => ($result->num_rows > 0)];
    echo json_encode($response);
}

$conn->close();
?>
