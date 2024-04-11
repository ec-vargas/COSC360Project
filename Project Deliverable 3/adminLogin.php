<?php session_start();?>
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
                <?php
                    if (isset($_SESSION['username'])) {echo "<h1>GroceryPricer.ca</h1>";}
                    else {echo "<h1><a href='home.html'>GroceryPricer.ca</a></h1>";}
                ?>
            </div>
            <div class="col text-end">
                <?php if (isset ($_SESSION['profile_photo'])): ?>
                    <img src="<?php echo $_SESSION['profile_photo']; ?>" alt="User Profile Photo" class="img-thumbnail">
                <?php endif; 
                    if (isset($_SESSION['username'])) {echo "<button style='margin-right: 2%;' onclick=\"location.href='UserAccount.php'\">".$_SESSION['username']."</button>";}
                ?>
            </div>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <?php
                    if (isset($_SESSION['username'])) {echo "<li class='breadcrumb-item'><a href='main.php'>Home</a></li>";}
                    else {echo "<li class='breadcrumb-item'><a href='home.html'>Home</a></li>";}
                    ?>
                
                <li class="breadcrumb-item active" aria-current="page">Admin Login</li>
            </ol>
        </nav>
        <hr>
    </div>
    <div class="col-6 mx-auto">
        <h2 id="secondarytitle">Welcome Back, Admin</h2>
        <div class="search-form-container">
            <p style="font-size: 24px; margin-top: 5px;">Login: </p>
            <form action="php/adminloginbackend.php" method="post">
                <div class="form-group">
                    <label for="AdminUsername">Username:</label>
                    <input type="AdminUsername" id="AdminUsername" name="AdminUsername" required>
                </div>
                <div class="form-group">
                    <label for="AdminPassword">Password:</label>
                    <input type="password" id="AdminPassword" name="AdminPassword" required>
                </div>
                <button type="submit" style="width: 20%; margin-top: 10px;">Login</button>

            </form>
        </div>
    </div>
    <?php
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            echo "<script>alert('$error')</script>";
        }
        ?>

    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>