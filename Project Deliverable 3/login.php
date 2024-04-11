<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Login Page</title>
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
        <h1><a href="home.html">GroceryPricer.ca</a></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Login</li>
            </ol>
        </nav>
        <hr>
    </div>

    <div class="col-6 mx-auto">
        <h2>Welcome Back, Saver</h2>
        <div class="login-container">
            <form action="php/loginbackend.php" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="name" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <?php
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            echo "<script>alert('$error')</script>";
        }
        ?>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>