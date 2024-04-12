<?php {
    require_once "php/dbconnection.php";
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Start session
    session_start();

    $target_file;
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

        // $target_dir = "uploads/";
        // $target_file = $target_dir . basename($_FILES["profilepicture"]["name"]);
        // $uploadOk = 1;
        // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        // if(isset($_POST["submit"])) {
        // $check = getimagesize($_FILES["profilepicture"]["tmp_name"]);
        // if($check !== false) {
        //     echo "File is an image - " . $check["mime"] . ".";
        //     $uploadOk = 1;
        // } else {
        //     echo "File is not an image.";
        //     $uploadOk = 0;
        // }
        // }

        // if (file_exists($target_file)) {
        //     echo "Sorry, file already exists.";
        //     $uploadOk = 0;
        // }

        // Check file size
        if ($_FILES["profilepicture"]["size"] > 100000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        }


            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $imagedata = file_get_contents($_FILES["profilepicture"]["tmp_name"]);

        $sql = "INSERT INTO users (Email, Username, Password, ProfilePicture) VALUES(?,?,?,?);";
        // '$email', '$username', '$hashed_password','$target_file'
        if ($stmt = mysqli_stmt_init($connection)) { //init prepared statement object 
        mysqli_stmt_prepare($stmt, $sql);
        $null = NULL;
            mysqli_stmt_bind_param($stmt, "sssb", $email, $username, $hashed_password, $null);

            mysqli_stmt_send_long_data($stmt, 3, $imagedata);

            $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));

            $_SESSION['username'] = $username;
            $_SESSION['profile_photo'] = base64_encode($imagedata);
            // Close the database connection
    mysqli_close($connection);
            header("Location: main.php");
            exit();
        } else {
            // Registration failed
            // Close the database connection
    mysqli_close($connection);
            header("Location: signup.html?error=Registration failed. Please try again later.");
            exit();
        }

        // Close the database connection
    }
    $connection->close();

}