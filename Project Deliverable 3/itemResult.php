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
            width: 60%;
            height: 60%;
            display: inline;
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

    <div class="col-10 mx-auto">
        <?php
        $contains;
        $doesnotcontain;
        $category;
        $store;
        if (isset ($_POST["contains"])) {
            $contains = $_POST["contains"];
        }
        echo "<h2>Results for Keyword Search '" . $contains . "'</h2>";
        echo "<Button id='button' onclick=\"location.href='main.php'\">Back to Search</Button>";
        if (isset ($_POST["does-not-contain"])) {
            $doesnotcontain = $_POST["does-not-contain"];
        }
        if (isset ($_POST["category"])) {
            $category = $_POST["category"];
        }
        if (isset ($_POST["store-name"])) {
            $store = $_POST["store-name"];
        }
        $host = "localhost";
        $database = "GPT";
        $user = "root";
        $password = "66060229";

        $connection = mysqli_connect($host, $user, $password, $database);

        $error = mysqli_connect_error();
        if ($error != null) {
            $output = "<p>Unable to connect to database!</p>";
            exit ($output);
        } else {
            //and fetch results
            $sql;
            if (!empty ($_POST["does-not-contain"])) {
                $sql = "SELECT p.*, pr.Price, s.StoreName
                FROM products p 
                JOIN categories c ON p.categoryID = c.categoryID 
                JOIN productstores ps ON p.productID = ps.productID 
                JOIN stores s ON ps.StoreID = s.StoreID
                LEFT JOIN prices pr ON p.ProductID = pr.ProductID
                WHERE p.ProductName LIKE CONCAT('%', ?, '%') 
                AND p.ProductName NOT LIKE CONCAT('%', ?, '%');";

                if ($statement = mysqli_prepare($connection, $sql)) {
                    mysqli_stmt_bind_param($statement, "ss", $contains, $doesnotcontain);
                    mysqli_stmt_execute($statement);

                    $results = mysqli_stmt_get_result($statement);
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
                        echo "<div><a href='guest.php'><img src='" . $row['Photo'] . "' width='200px' height='200px'></a><br>" . $row['ProductName'] . " - $" . $row['Price'] . " at " . $row['StoreName'] . "</div>";
                    }
                }
            } else {
                $sql = "SELECT p.*, pr.Price, s.StoreName
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
                        echo "<div><a href='itemResult.php?ProductID=" . $row['ProductID'] . "'><img src='" . $row['Photo'] . "' width='200px' height='200px'></a><br>" . $row['ProductName'] . " - $" . $row['Price'] . " at " . $row['StoreName'] . "</div>";
                    }
                }
            }
            mysqli_free_result($results);
            mysqli_close($connection);
        }
        ?>


    </div>
    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>