<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Admin Login Page</title>
    <link rel="stylesheet" href="css/reset.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <div class="container-fluid-2">
        <div class="row align-items-center">
            <div class="col">
                <h1><a href="home.html">GroceryPricer.ca</a></h1>
            </div>
            <div class="col text-end">
                <button style="margin-right: 2%;"><?php echo $_SESSION['AdminUsername'];?></button>
                <button id="home" class="adminButton" onclick="location.href='adminOptions.php'">
                    <span>Admin Home</span>
                </button>
            </div>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
        </nav>
        <hr>
    </div>

    <div class="col-6 mx-auto" style="display: flex; flex-direction: column; align-items: center;">
        <h2 id="secondarytitle">Welcome, Admin.</h2>
        <button id="finduser" class="homebutton" style="margin: 5px 0;"
            onclick="location.href='adminFindUser.php'">Find a
            user by name, <br> email or post.</button>
        <button id="finditems" class="homebutton" style="margin: 5px 0;"
            onclick="location.href='adminFindItems.php'">Find
            Items</button>
        <button id="findpost" class="homebutton" style="margin: 5px 0;"
            onclick="location.href='adminFindPost.php'">Find a
            Post</button>
        <button id="adminLogout" class="signout" style="margin: 5px 0;" onclick="location.href='adminLogin.html'">Logout
            as
            Admin</button>
    </div>


    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>