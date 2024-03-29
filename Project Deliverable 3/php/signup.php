<?php {
    require_once "dbconnection.php";
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
            header("Location: ../signup.html?error=Passwords do not match");
            exit();
        }

        $profile_picture = '';
        if (isset ($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = '../uploads/'; // Directory to upload profile pictures
            $file_name = $_FILES['profilePicture']['name'];
            $file_tmp = $_FILES['profilePicture']['tmp_name'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($file_ext, $allowed_ext)) {
                $profile_picture = $upload_dir . uniqid() . '.' . $file_ext;
                move_uploaded_file($file_tmp, $profile_picture);
            } else {

                header("Location: ../signup.html?error=Invalid file type for profile picture");
                exit();
            }
        }
        // Hash the password
        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // SQL query to insert user into database
        $sql = "INSERT INTO users (Email, Username, Password, ProfilePicture) VALUES ('$email', '$username', '$password', '$profile_picture')";

        if ($connection->query($sql) === TRUE) {
            // Registration successful
            $_SESSION['username'] = $username;
            header("Location: ../main.php");
            exit();
        } else {
            // Registration failed
            header("Location: ../signup.html?error=Registration failed. Please try again later.");
            exit();
        }

        // Close the database connection
    }
    $connection->close();

}