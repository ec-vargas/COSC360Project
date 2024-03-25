<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "dbconnection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to fetch user from database
    $sql = "SELECT * FROM Users WHERE username='$username'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['Password'])) {
            // Password is correct, set up session
            $_SESSION['username'] = $username;

            header("Location:../main.php");
            $connection->close();
            exit();
        } else {
            // Redirect to login page with error message
            header("Location: ../login.php?error=Invalid password");
            echo "Invalid password.";
            $connection->close();
            exit();
        }
    } else {
        // Redirect to login page with error message
        header("Location: ../login.php?error=User not found");
        echo "User not found.";
        $connection->close();
        exit();
    }
}
