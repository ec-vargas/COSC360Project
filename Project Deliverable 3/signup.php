
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "GPT";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    if ($password !== $confirm_password) {
        header("Location: ../signup.html?error=Passwords do not match");
        exit();
    }


    $profile_picture = ''; 
    if(isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/'; // Directory to upload profile pictures
        $file_name = $_FILES['profile_picture']['name'];
        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif'); 
        if(in_array($file_ext, $allowed_ext)) {
            $profile_picture = $upload_dir . uniqid() . '.' . $file_ext; 
            move_uploaded_file($file_tmp, $profile_picture); 
        } else {
    
            header("Location: ../signup.html?error=Invalid file type for profile picture");
            exit();
        }
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  
    $sql = "INSERT INTO Users (email, username, password, ProfilePicture) 
            VALUES ('$email', '$username', '$hashed_password', '$profile_picture')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['username'] = $username;
        header("Location: ../home.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error; 
        exit();
   
    }
}