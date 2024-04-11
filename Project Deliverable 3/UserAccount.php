<?php session_start();?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>User Profile - User Panel</title>
    <link rel="stylesheet" href="css/reset.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
    <style>

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

        img {
            display: inline;
            width: 30px;
            height: 30px;
        }

        #commentsblock {
            margin-top: 30px;
            margin-left: 850px;
            padding-top: 20px;
            background-color: rgba(245, 245, 220, 0.5);
            align-items: center;
            text-align: center;
            height: 300px;
            overflow: auto;
        }

        .offset-md-1 {
            float: left;
            
        }

        footer {
            clear: left;
        }
    </style>
</head>

<body>
    <div class="container-fluid-2">
        <div class="row align-items-center">
            <div class="col">
                <?php
                    if (isset($_SESSION['username'])) {echo "<h1>GroceryPricer.ca</h1>";}
                    else {echo "<h1><a href='home.html'>GroceryPricer.ca</a></h1>";}
                ?>
            </div>
            <div class="col text-end">
                <?php if (isset ($_SESSION['profile_photo'])): ?>
                    <img src="<?php echo $_SESSION['profile_photo']; ?>" alt="User Profile Photo" class="img-thumbnail">
                <?php endif; ?>
                <button style="margin-right: 2%;"><?php echo $_SESSION['username'];?></button>
                <a href="php/logout.php" style="font-size: 2em;">LogOut&nbsp;</a>
                <a href="adminLogin.php" style="font-size: 2em;">&nbsp;Admin Login</a>
            </div>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
        </nav>
        <hr>
    </div>

    <div class="col-6 offset-md-1">
        <h2>User Info</h2>
        <?php
        require_once "php/dbconnection.php";
        $username;
        if (isset($_SESSION['username'])) {$username = $_SESSION['username'];}

            $sql = "SELECT * FROM users;";

            $results = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_assoc($results)) {
                if ($row['Username'] === $username) {
                    echo "<div><img class='img-thumbnail' src='".$row['ProfilePicture']."' width = 150px height = 150px/><p id='user'><strong> Username: </strong>".$row['Username']."</p><br>";
                    echo "<strong>Email: </strong>".$row['Email']."<br><br>";
                    echo "<strong>Date joined: </strong>".$row['RegistrationDate']."</div>";
                    echo "<script>var userId = " . json_encode($row['UserID']) . ";</script>";
                    echo "<script>var username = " . json_encode($row['Username']) . ";</script>";
                }
            } ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#EditUsername").click(function() {
            var input = "<input id='text' type='text' placeholder='Enter new username'><button id='save'>Save</button>";
            var editUser = userId;
            var newUsername;
            if ($("#text").length==0) {
                $("#user").after(input);
            }
            $("#save").click(function() {
                newUsername = $("#text").val();
                $.post("php/editUsername.php", { UserID: editUser, newUsername: newUsername }, function(response) {
                    $("#text").remove();
                    $("#save").remove();
                    if (response.length == 0) {alert("Username saved.");}
                    else {alert("Error saving username.");}
                });
            });
            
        });
    });
    </script>
    <button id="EditUsername" class="UserActions">Edit Username</button>
    <button id="BacktoSearch" onclick="location.href='main.php'">Home</button>
</div>
<div id="commentsblock" class="col-md-3">
    <h2>Comments</h2>
    <?php
        $sql = "SELECT * FROM comments JOIN users on comments.UserID = users.UserID 
                JOIN products on comments.ProductID = products.ProductID
                JOIN productstores on products.productID = productstores.ProductID
                JOIN stores on productstores.StoreID = stores.StoreID WHERE Username = '$username'";
        $results = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_assoc($results)) {
            echo "<strong>" . $row['ProductName'] . " at " . $row['StoreName'] . "</strong>";
            echo "<div id='productcomments'>" . $row['Comment'] . "<br> - " . $row['Username'] . "</div><br>";
        }
        mysqli_free_result($results);
        mysqli_close($connection);
    ?>
</div>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>