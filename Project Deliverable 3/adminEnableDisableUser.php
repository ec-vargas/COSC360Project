<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>User Settings - Admin Panel</title>
    <link rel="stylesheet" href="css/reset.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
    <style>
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
/* 
        #BacktoSearch {
            display: block;
            margin-left: 15px;
            margin-top: 100px;
            margin-bottom: 20px;
            border: 0;
            line-height: 1.65;
        } */

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
                <h1><a href="home.html">GroceryPricer.ca</a></h1>
            </div>
            <div class="col text-end">
                <button id="home" class="adminButton" onclick="location.href='adminOptions.html'">
                    <span>Admin Home</span>
                </button>
            </div>
        </div>
        <hr>
    </div>

    <div class="col-6 mx-auto">
        <h2>User Info</h2>
        <?php
        require_once "php/dbconnection.php";
        $email;
        if (isset ($_GET["email"])) {
            $email = $_GET["email"];
        }

            $sql = "SELECT * FROM users;";

            $results = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_assoc($results)) {
                if ($row['Email'] === $email) {
                    echo "<div><img class='img-thumbnail' src='".$row['ProfilePicture']."' width = 150px height = 150px/><p id='user'>".$row['Username']."</p><br>";
                    echo "Email: ".$row['Email']."<br><br>";
                    echo "Date joined: ".$row['RegistrationDate']."</div>";
                    echo "<script>var userId = " . json_encode($row['UserID']) . ";</script>";
                    echo "<script>var username = " . json_encode($row['Username']) . ";</script>";
                }
            }
            mysqli_free_result($results);
            mysqli_close($connection); ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#DeleteUser").click(function() {
            var userToDelete = userId;
            
            $.post("php/deleteUser.php", { UserID: userToDelete }, function() {
                alert("User has been deleted.");
            });
        });
        $("#EditUsername").click(function() {
            var input = "<input id='text' type='text' placeholder='Enter new username'><button id='save'>Save</button>";
            var editUser = userId;
            var newUsername;
            $("#user").after(input);
            $("#save").click(function() {
                newUsername = $("#text").val();
                $.post("php/editUsername.php", { UserID: editUser, newUsername: newUsername }, function(response) {
                $("#EditUsername").text("Save");
                $("#text").remove();
                $("#save").remove();
            });
            });
            
        });
    });
    </script>
    <button id="EditUsername" class="UserActions">Edit Username</button>
    <button id="DeleteUser" class="UserActions">Delete User</button>
    <button id="BacktoSearch" onclick="location.href='adminUserResult.php'">Back to Results</button>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>