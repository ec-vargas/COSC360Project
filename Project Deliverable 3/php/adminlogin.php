<?php {
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
        $username = $_POST['AdminUsername'];
        $password = $_POST['AdminPassword'];

        // SQL query to fetch user from database
        $sql = "SELECT * FROM Admin WHERE AdminUsername='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Compare plaintext passwords
            if ($password === $row['AdminPassword']) {
                // Password is correct, set up session
                $_SESSION['AdminUsername'] = $username;
                header("Location: ../adminOptions.html"); // Redirect to welcome page after successful login
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
    $conn->close();
}
