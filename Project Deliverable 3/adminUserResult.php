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
            margin: 5px 5px 5px 65px;
            background-color: rgb(171, 223, 117);
            width: 200px;
            display: inline-block;
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
        $datebeforefilter;
        $dateafterfilter;
        if (isset($_POST["firstname"])) {
            $contains = $_POST["firstname"];
        }
        if (isset($_POST["lastname"])) {
            $doesnotcontain = $_POST["lastname"];
        }
        if (isset($_POST["email"])) {
            $category = $_POST["email"];
        }
        if (isset($_POST["location"])) {
            $store = $_POST["location"];
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
                if (!empty($_POST["firstname"])) {
                    if (!(strpos(strtoupper($row['FirstName']), strtoupper($first)) !== false)) {continue;}
                }
                if (!empty($_POST["lastname"])) {
                    if (!(strpos(strtoupper($row['LastName']), strtoupper($last)) !== false)) {continue;}
                }
                if (!empty($_POST["email"])) {
                    if (!(strpos(strtoupper($row['email']), strtoupper($first)) !== false)) {continue;}
                }
                if (!empty($_POST["location"])) {
                    if (!(strpos(strtoupper($row['location']), strtoupper($last)) !== false)) {continue;}
                }
                echo "<a href='adminEnableDisableUser.html'><div><img src='".$row['Photo']."' width = 200px height = 200px></div></a><br>".$row['ProductName']."";
            }
        }
            mysqli_free_result($results);
            mysqli_close($connection);
        }?>

    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>
