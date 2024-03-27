<?php {
    session_start();
    require_once "dbconnection.php";

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Get username and password from the form
        $username = $_POST['AdminUsername'];
        $password = $_POST['AdminPassword'];

        // SQL query to fetch user from database
        $sql = "SELECT * FROM Admin WHERE AdminUsername='$username'";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($password === $row['AdminPassword']) {
                // Password is correct, set up session
                $_SESSION['AdminUsername'] = $username;

                // Fetch profile photo for the signed-in user
                $profile_sql = "SELECT ProfilePicture FROM Users WHERE Username = '$username'";
                $profile_result = $connection->query($profile_sql);

                if ($profile_result->num_rows > 0) {
                    $profile_row = $profile_result->fetch_assoc();
                    $_SESSION['profile_photo'] = $profile_row['ProfilePicture'];
                }

                header("Location: ../adminOptions.php"); // Redirect to welcome page after successful login
                $connection->close();
                exit();
            } else {
                header("Location: ../adminLogin.php?error=Invalid password");
                echo "Invalid password.";
                $connection->close();
                exit();
            }
        } else {
            // User not found
            header("Location: ../adminLogin.php?error=User not found");
            echo "User not found.";
            $connection->close();
            exit();
        }

    }
}
