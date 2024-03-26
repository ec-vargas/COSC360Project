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
                header("Location: ../adminOptions.php"); // Redirect to welcome page after successful login
                exit();
            } else {
                header("Location: ../adminLogin.html?error=Invalid password");
                exit();
            }
        } else {
            // User not found
            header("Location: ../adminLogin.html?error=User not found");
            exit();
        }

    }
    $connection->close();
}
