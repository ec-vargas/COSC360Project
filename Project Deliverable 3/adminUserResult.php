<?php session_start();?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>User Results - Admin Panel</title>
    <link rel="stylesheet" href="css/reset.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
    <style>
        img {
            display: inline;
            width: 30px;
            height: 30px;
        }
    </style>
</head>

<body>

    <div class="container-fluid-2">
        <div class="row align-items-center">
            <div class="col">
                <?php
                    if (isset($_SESSION['AdminUsername'])) {echo "<h1>GroceryPricer.ca</h1>";}
                    else {echo "<h1><a href='home.html'>GroceryPricer.ca</a></h1>";}
                ?>
            </div>
            <div class="col text-end">
            <button style="margin-right: 2%;"><?php if (isset($_SESSION['AdminUsername'])) {echo $_SESSION['AdminUsername'];}?></button>
                <button id="home" class="adminButton" onclick="location.href='adminOptions.php'">
                    <span>Admin Home</span>
                </button>
            </div>
        </div>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="adminOptions.php">Home</a></li>
            <li class="breadcrumb-item"><a href="adminFindUser.php">Find User</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Results</li>
        </ol>
        </nav>
        <hr>
    </div>
    <div class="col-8 mx-auto">
        <h2>Results for User Search</h2>
        <Button id="button" onclick="location.href='adminFindUser.php'">Back to Search</Button>

        <?php
        require_once "php/dbconnection.php";
        $firstname;
        $lastname;
        $email;
        $location;
        $start;
        $end;
        if (isset ($_POST["username"])) {
            $username = $_POST["username"];
        }
        if (isset ($_POST["Email"])) {
            $email = $_POST["Email"];
        }
        if (isset ($_POST["start"])) {
            $start = $_POST["start"];
        }
        if (isset ($_POST["end"])) {
            $end = $_POST["end"];
        }
            $sql = "SELECT * FROM users;";

            $results = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_assoc($results)) {
                if (!empty ($_POST["username"])) {
                    if (!(strpos(strtoupper($row['Username']), strtoupper($username)) !== false)) {
                        continue;
                    }
                }
                if (!empty ($_POST["Email"])) {
                    if (!(strpos(strtoupper($row['Email']), strtoupper($email)) !== false)) {
                        continue;
                    }
                }
                if (!empty ($_POST["start"])) {
                    if (strtotime($row['RegistrationDate']) < strtotime($start)) {
                        continue;
                    }
                }
                if (!empty ($_POST["end"])) {
                    if (strtotime($row['RegistrationDate']) > strtotime($end)) {
                        continue;
                    }
                }
                echo "<div><img class='img-thumbnail' src='" . $row['ProfilePicture'] . "' /><p><a href='adminEditUser.php?email=" . $row['Email'] . "'>" . $row['Username'] . "</a></p><br>";
                echo "Email: " . $row['Email'] . "<br>";
                echo "Date joined: " . $row['RegistrationDate'] . "</div>";
            }
            mysqli_free_result($results);
            mysqli_close($connection);?>
    </div>
    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>