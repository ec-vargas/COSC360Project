<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Items Result - Guest Panel</title>
    <link rel="stylesheet" href="css/reset.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
    <style>
        h2 {
            margin-left: 2%;
        }

        img {
            width: 200px;
            height: 200px;
        }
    </style>
</head>

<body>
    <div class="container-fluid-2">
        <div class="row">
            <div class="col">
                <h1><a href=" home.html">GroceryPricer.ca</a></h1>
            </div>
            <div class="col">
                <div class="header2">
                    <a href="login.php" style="font-size: 2em;">Login&nbsp;</a>
                    <a href="adminLogin.php" style="font-size: 2em;">&nbsp;Admin Login</a>
                </div>
            </div>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.html">Home</a></li>
                <li class="breadcrumb-item"><a href="guest.php">Search</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product Results</li>
            </ol>
        </nav>
        <hr>
    </div>

    <div class="container text-center">
        <!-- Button to toggle collapsible section -->
        <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
            aria-expanded="false" aria-controls="collapseExample">
            Toggle Results
        </button>

        <!-- Collapsible section -->
        <div class="collapse" id="collapseExample">
            <?php
            require_once "php/dbconnection.php";

            $contains;
            if (isset($_POST["contains"])) {
                $contains = $_POST["contains"];
            }
            echo "<h2>Results for Keyword Search '" . $contains . "'</h2>";
            echo "<Button id='button' onclick=\"location.href='../guest.php'\">Back to Search</Button>";

            // Updated SQL query
            $sql = "SELECT p.*, c.CategoryName, pr.Price, s.StoreName
                        FROM products p 
                        JOIN categories c ON p.categoryID = c.categoryID 
                        JOIN productstores ps ON p.productID = ps.productID 
                        JOIN stores s ON ps.StoreID = s.StoreID
                        LEFT JOIN prices pr ON p.ProductID = pr.ProductID
                        WHERE p.ProductName LIKE CONCAT('%', ?, '%')";

            if ($statement = mysqli_prepare($connection, $sql)) {
                mysqli_stmt_bind_param($statement, "s", $contains);
                mysqli_stmt_execute($statement);

                $results = mysqli_stmt_get_result($statement);
                $resultsperrow = 0;
                echo "<div class='row row-cols-2 row-cols-lg-4 g-2 g-lg-3'>";
                while ($row = mysqli_fetch_assoc($results)) {
                    echo "<div class='col'><a href='../signup.html'><img src='../" . $row['Photo'] . "' width='200px' height='200px'></a><br>" . $row['ProductName'] . " - $" . $row['Price'] . " at " . $row['StoreName'] . "</div>";
                }
                echo "</div>"; // Close the row after all results are displayed
                mysqli_free_result($results);
                mysqli_close($connection);
            }
            ?>
        </div>
    </div>
    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>