<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

        if (password_verify($password, $row['Password'])) {
            // Password is correct, set up session
            $_SESSION['username'] = $username;

            header("Location:../main.html");
            $conn->close();
            exit();
        } else {
            // Redirect to login page with error message
            header("Location: login.php?error=Invalid password");
            $conn->close();
            exit();
        }
    } else {
        // Redirect to login page with error message
        header("Location: login.php?error=User not found");
        $conn->close();
        exit();
    }
}
