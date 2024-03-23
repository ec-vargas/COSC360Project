<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>User Settings - Admin Panel</title>
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/AdminStyleSheets.css" />
    <style>

        h1,
        h2,
        section {
            margin-left: 20px;
            margin-right: 20px;
        }

        button:hover {
            background-color: #1fe600;
        }

        section {
            height: 200px;
            width: 600px;
            background-color: rgb(171, 223, 117);
        }

        .UserActions {
            display: inline;
            margin-left: 15px;
            margin-top: 10px;
            padding: 0 20px;
            border-radius: 5px;
            border: 0;
            line-height: 1.65;
        }

        button {
            padding: 0 20px;
            font-size: 1rem;
            text-align: center;
            text-decoration: none;
            color: #090909;
            border-radius: 10px;
            background-color: rgb(255, 246, 246);
        }

        #BacktoSearch {
            display: block;
            margin-left: 15px;
            margin-top: 100px;
            margin-bottom: 20px;
            border: 0;
            line-height: 1.65;
        }

        div {
            padding: 10px;
            margin: auto;
            margin-bottom: 10px;
            background-color: rgb(171, 223, 117);
            width: 50%;
            display: block;
            height: 160px;
        }

        img {
            display: inline;
            float: left;
            margin-right: 10px;
        }

        #RestrictUser {
            margin-left: 400px;
            margin-top: 50px;
        }

    </style>
</head>

<body>
    <button id="home" class="homebutton" onclick="location.href='adminOptions.html'"><span>Admin Home</span></button>
    <h1><a href="home.html">GroceryPricer.ca</a></h1>
    <hr id="tophr">
    <h2>User Info</h2>
        <?php
        $email;
        if (isset($_GET["email"])) {
            $email = $_GET["email"];
        }
        
        $host = "localhost";
        $database = "cosc360";
        $user = "83066985";
        $password = "83066985";

        $connection = mysqli_connect($host, $user, $password, $database);

        $error = mysqli_connect_error();
        if($error != null)
        {
        $output = "<p>Unable to connect to database!</p>";
        exit($output);
        }
        else
        {
            $sql = "SELECT * FROM users;";

            $results = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_assoc($results))
            {
                if ($row['Email'] === $email) {
                    echo "<div><img src='".$row['ProfilePicture']."' width = 150px height = 150px/><p><a href='adminEnableDisableUser.html'>".$row['Username']."</a></p><br>";
                    echo "Email: ".$row['Email']."<br><br>";
                    echo "Location: <br><br>";
                    echo "Date joined: ".$row['RegistrationDate']."</div>";
                    echo "<script>var userId = " . json_encode($row['UserID']) . ";</script>";
                }
            }
            mysqli_free_result($results);
            mysqli_close($connection);
            
        } ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#DeleteUser").click(function() {
            var userToDelete = userId;
            
            $.post("deleteUser.php", { userId: userToDelete }, function() {
                alert("User has been deleted.");
            });
        });
    });
    </script>
    <button id="RestrictUser" class="UserActions">Restrict User</button>
    <button id="DeleteUser" class="UserActions">Delete User</button>
    <button id="ReauthorizeUser" class="UserActions">Reauthorize User</button>
    <button id="BacktoSearch" onclick="location.href='adminUserResult.php'">Back to Results</button>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>