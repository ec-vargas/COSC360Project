<?php session_start();?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Find Post - Admin Panel</title>
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
                <li class="breadcrumb-item active" aria-current="page">Find Post</li>
            </ol>
        </nav>
        <hr>
    </div>
    <h2 id="secondarytitle">Find Posts</h2>
    <hr>

    <div class="col-8 mx-auto">
        <form id="date-range-form" method="POST" action="adminPostResult.php">
            <section>
                <h2>Words</h2>
                <div class="search-form-container">
                    <input type="text" id="contains" name="contains" placeholder="Contains:" autocomplete="off"><br>
                    <input type="text" id="does-not-contain" name="does-not-contain" placeholder="Does Not Contain:"
                        autocomplete="off"><br>
                </div>
            </section>

            <section>
                <h2>People</h2>
                <div class="search-form-container">
                    <input type="text" id="Email" name="Email" placeholder="Email Address" autocomplete="off"><br>
                    <input type="text" id="username" name="username" placeholder="Username:" autocomplete="off"><br>
                </div>
            </section>

            <section>
                <h2>Date Range:</h2>
                <div class="search-form-container">
                    <label for="category">Start</label><br>
                    <input type="date" id="start" name="start" placeholder="Start:" autocomplete="off"><br>
                    <label for="category">End</label><br>
                    <input type="date" id="end" name="end" placeholder="End:" autocomplete="off"><br>
                    <br>
                    <button id="search-button" type="submit">Search</button>
                </div>
            </section>
        </form>
    </div>

    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>