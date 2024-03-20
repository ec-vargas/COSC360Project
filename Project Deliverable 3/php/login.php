<?php
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "66060229";
    $dbname = "GPT";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die ("Connection failed: " . $conn->connect_error);
    }

    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to fetch user from database
    $sql = "SELECT * FROM Users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Inside the if condition where password_verify() is called
        if (password_verify($password, $row['password'])) {
            // Password is correct, set up session
            $_SESSION['username'] = $username;
            header("Location:../login.html"); // Redirect to welcome page after successful login
            //exit();
        } else {
            // Debugging: Echo or log the hashed passwords for comparison
            echo "Hash from DB: " . $row['password'] . "<br>";
            echo "Hash from input: " . password_hash($password, PASSWORD_DEFAULT) . "<br>";
            // Invalid password
            header("Location: ../login.html?error=Invalid password");
            exit();
        }
    }

    $conn->close();

}