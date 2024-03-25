<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Find Items - Guest Panel</title>
    <link rel="stylesheet" href="css/reset.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
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
                <h1><a href="home.html">GroceryPricer.ca</a></h1>
            </div>
            <div class="col">
                <div class="header2">
                    <a href="login.html" class="btn btn-link" style="font-size: 2em;">Login</a>
                    <a href="adminLogin.html" class="btn btn-link" style="font-size: 2em;">Admin Login</a>
                </div>
            </div>
        </div>
        <hr>
    </div>

    <div class="container text-center">
        <?php
        require_once "php/dbconnection.php";
        $contains;
        if (isset ($_POST["contains"])) {
            $contains = $_POST["contains"];
        }
        echo "<h2>Results for Keyword Search '" . $contains . "'</h2>";
        echo "<Button id='button' onclick=\"location.href='main.php'\">Back to Search</Button>";

        $sql = "SELECT p.*, pr.Price, s.StoreName
                FROM products p 
                JOIN categories c ON p.categoryID = c.categoryID 
                JOIN productstores ps ON p.productID = ps.productID 
                JOIN stores s ON ps.StoreID = s.StoreID
                LEFT JOIN prices pr ON p.ProductID = pr.ProductID
                WHERE p.ProductName LIKE CONCAT('%', ?, '%') AND PriceDate IN (SELECT MAX(PriceDate) FROM products JOIN prices on products.ProductID = prices.ProductID)";

        if ($statement = mysqli_prepare($connection, $sql)) {
            mysqli_stmt_bind_param($statement, "s", $contains);
            mysqli_stmt_execute($statement);

                    $results = mysqli_stmt_get_result($statement);
                    $resultsperrow = 0;
                    echo "<div class='row align-items-start'>";
                    while ($row = mysqli_fetch_assoc($results)) {
                        if (!empty ($_POST["category"])) {
                            if (!(strpos(strtoupper($row['CategoryName']), strtoupper($category)) !== false)) {
                                continue;
                            }
                        }
                        if (!empty ($_POST["store-name"])) {
                            if (!(strpos(strtoupper($row['StoreName']), strtoupper($store)) !== false)) {
                                continue;
                            }
                        }
                        // Output product details inline with the image, name, price, and store name
                        
                        if ($resultsperrow == 4) {
                            echo "</div><div class='row row-cols-2 row-cols-lg-4 g-2 g-lg-3'>";
                            echo "<div class='col'><a href='UserItem.php?ProductID=" . $row['ProductID'] . "&Contains=".$contains."'><img src='" . $row['Photo'] . "' width='200px' height='200px'></a><br>" . $row['ProductName'] . " - $" . $row['Price'] . " at " . $row['StoreName'] . "</div>";
                            $resultsperrow = 1;
                        } else {
                            echo "<div class='col'><a href='UserItem.php?ProductID=" . $row['ProductID'] . "&Contains=".$contains."'><img src='" . $row['Photo'] . "' width='200px' height='200px'></a><br>" . $row['ProductName'] . " - $" . $row['Price'] . " at " . $row['StoreName'] . "</div>";
                            $resultsperrow++;
                        }
                        
                    }
                }
                if (!empty ($_POST["store-name"])) {
                    if (!(strpos(strtoupper($row['StoreName']), strtoupper($store)) !== false)) {
                        continue;
                    }
                }
                // Output product details inline with the image, name, price, and store name
        
                if ($resultsperrow == 4) {
                    echo "</div><div class='row row-cols-2 row-cols-lg-4 g-2 g-lg-3'>";
                    echo "<div class='col'><a href='itemResult.php?ProductID=" . $row['ProductID'] . "'><img src='" . $row['Photo'] . "' width='200px' height='200px'></a><br>" . $row['ProductName'] . " - $" . $row['Price'] . " at " . $row['StoreName'] . "</div>";
                    $resultsperrow = 1;
                } else {
                    echo "<div class='col'><a href='itemResult.php?ProductID=" . $row['ProductID'] . "'><img src='" . $row['Photo'] . "' width='200px' height='200px'></a><br>" . $row['ProductName'] . " - $" . $row['Price'] . " at " . $row['StoreName'] . "</div>";
                    $resultsperrow++;
                }

            }
        }
        mysqli_free_result($results);
        mysqli_close($connection);
        ?>
    </div>
    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>