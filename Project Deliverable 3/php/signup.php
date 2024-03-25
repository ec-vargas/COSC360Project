<?php {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Start session
    session_start();

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get values from the form
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Check if passwords match
        if ($_POST['password'] !== $_POST['confirm_password']) {
            // Passwords don't match
            header("Location: signup.html?error=Passwords do not match");
            exit();
        }
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // SQL query to insert user into database
        $sql = "INSERT INTO Users (email, username, password) VALUES ('$email', '$username', '$hashed_password')";

        if ($connection->query($sql) === TRUE) {
            // Registration successful
            $_SESSION['username'] = $username;
            header("Location: ../home.html");
            exit();
        } else {
            // Registration failed
            header("Location: signup.html?error=Registration failed. Please try again later.");
            exit();
        }

        // Close the database connection
    }
    $connection->close();

}