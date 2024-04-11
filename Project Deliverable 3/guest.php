<?php
    require_once "php/dbconnection.php";

    $sql = "SELECT ProductID, SearchCount, LastSearchDate FROM search";
    $results = mysqli_query($connection, $sql);
    $currentDate=date("Y-m-d");
    while($row = mysqli_fetch_assoc($results)) {
        $ProductID = $row['ProductID'];
        $lastSearchDate = $row['LastSearchDate'];
        if($lastSearchDate < $currentDate) {
        // Reset search counts if it's a new day
            $sql = "UPDATE search SET SearchCount = 0 WHERE ProductID = $ProductID";
            mysqli_query($connection, $sql);
        }
    }
    ?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Guest Page</title>
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
        <div class="d-flex justify-content-between align-items-center">
            <h1><a href="home.html">GroceryPricer.ca</a></h1>
            <div class="header2">
                <a href="login.php" style="font-size: 2em;">Login&nbsp;</a>
                <a href="adminLogin.php" style="font-size: 2em;">&nbsp;Admin Login</a>
            </div>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Search</li>
            </ol>
        </nav>
        <hr>
    </div>

    <form method="POST" action="php/guestItemResult.php">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-11">
                        <input type="text" class="search" id="contains" name="contains"
                            placeholder="Enter keyword to search" autocomplete="off"
                            style="margin-top: 20px; padding: 5px 20px;">
                        <input type="submit" value="Search">
                    </div>
                </div>
            </div>
        </section>
    </form>

    <br>

    <h3 style="margin-left: 4%;">Lowest Prices Available</h3>
    <hr>

    <div class="container">
        <div class="row">
            <?php
            
            // Fetch lowest prices for products with photos
            $sql = "SELECT p.ProductName, pr.Price, p.Photo, s.SearchCount
        FROM products p
        INNER JOIN prices pr ON p.ProductID = pr.ProductID
        LEFT JOIN search s ON p.ProductID = s.ProductID
        ORDER BY pr.Price ASC
        LIMIT 5";
            $result = mysqli_query($connection, $sql);

            // Display products with lowest prices and photos
            echo "<div class='container'>";
            echo "<div class='row'>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='col'>";
                if ($row['SearchCount'] > 3) {
                    echo "<img style='box-shadow: 3px 3px 20px yellow, 3px 3px 20px orange, 3px 3px 20px orangered; height: 200px; width: 200px' src='" . $row['Photo'] . "' alt='" . $row['ProductName'] . "'>";
                } else {
                    echo "<img style='height: 200px; width: 200px' src='" . $row['Photo'] . "' alt='" . $row['ProductName'] . "'>";
                }
                echo "<h4>" . $row['ProductName'] . "</h4>";
                echo "<p>Price: $" . $row['Price'] . "</p>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";

            // Free result set
            mysqli_free_result($result);

            // Close connection
            mysqli_close($connection);
            ?>
        </div>
    </div>

    <hr>
    <h3><a href="signup.html" style="margin-left: 4%;">Sign Up</a></h3>
    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>