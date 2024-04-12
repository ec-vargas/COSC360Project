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
    $sql = "SELECT * FROM users WHERE Username='$username'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['Password'])) {
            // Password is correct, set up session
            $_SESSION['username'] = $username;

            // Fetch profile photo for the signed-in user
            $profile_sql = "SELECT ProfilePicture FROM users WHERE Username = '$username'";
            $profile_result = $connection->query($profile_sql);

            if ($profile_result->num_rows > 0) {
                $profile_row = $profile_result->fetch_assoc();
                $profile_photo_data = $profile_row['ProfilePicture'];
                $_SESSION['profile_photo'] = base64_encode($profile_photo_data);
            }

            // Redirect to main page
            header("Location:../main.php");
            $connection->close();
            exit();
        } else {
            // Redirect to login page with error message "Invalid password."
            header("Location: ../login.php?error=Invalid password");
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
