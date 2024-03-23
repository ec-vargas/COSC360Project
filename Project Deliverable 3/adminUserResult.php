<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Find User - Admin Panel</title>
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/AdminStyleSheets.css" />
    <style>
        
        h1,h2,button {
            margin-left: 20px;
        }

        #button {
            border: 0;
            line-height: 1.65;
            padding: 0 20px;
            font-size: 1rem;
            text-align: center;
            text-decoration: none;
            color: #090909;
            border-radius: 10px;
            background-color: rgb(255, 246, 246);
            display: block;
        }
        
        #button:hover {
            background-color: #1fe600;
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
    </style>
</head>

<body>
    <button id="home" class="homebutton" onclick="location.href='adminOptions.html'"><span>Admin Home</span></button>
    <h1>GroceryPricer.ca</h1>
    <hr id="tophr">

    <h2>Results for Advanced Search</h2>
    <Button id ="button" onclick="location.href='adminFindUser.html'">Back to Search</Button>

    <?php
        $firstname;
        $lastname;
        $email;
        $location;
        $start;
        $end;
        if (isset($_POST["username"])) {
            $username = $_POST["username"];
        }
        if (isset($_POST["Email"])) {
            $email = $_POST["Email"];
        }
        if (isset($_POST["start"])) {
            $start = $_POST["start"];
        }
        if (isset($_POST["end"])) {
            $end = $_POST["end"];
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
                if (!empty($_POST["username"])) {
                    if (!(strpos(strtoupper($row['Username']), strtoupper($username)) !== false)) {continue;}
                }
                if (!empty($_POST["Email"])) {
                    if (!(strpos(strtoupper($row['Email']), strtoupper($email)) !== false)) {continue;}
                }
                if (!empty($_POST["start"])) {
                    if (strtotime($row['RegistrationDate']) < strtotime($start)) {continue;}
                }
                if (!empty($_POST["end"])) {
                    if (strtotime($row['RegistrationDate']) > strtotime($end)) {continue;}
                }
                echo "<div><img src='".$row['ProfilePicture']."' width = 150px height = 150px/><p><a href='adminEnableDisableUser.php?email=".$row['Email']."'>".$row['Username']."</a></p><br>";
                echo "Email: ".$row['Email']."<br><br>";
                echo "Date joined: ".$row['RegistrationDate']."</div>";
            }
            mysqli_free_result($results);
            mysqli_close($connection);
        } ?>

    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>
