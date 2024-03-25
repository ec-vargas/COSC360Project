<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Items Result - Guest Panel</title>
    <link rel="stylesheet" href="css/reset.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css" />
    <style>
        img {
            width: 60%;
            height: 60%;
        }
    </style>
</head>

<body>
    <div class="container-fluid-2">
        <div class="d-flex justify-content-between align-items-center">
            <h1><a href=" ../home.html">GroceryPricer.ca</a></h1>
            <div class="header2">
                <a href=" ../login.html" style="font-size: 2em; margin-right: 10px;">Login </a>
                <a href=" ../adminLogin.html" style="font-size: 2em;"> Admin Login</a>
            </div>
        </div>
        <hr>
    </div>

    <div class="col-6 mx-auto">
        <?php
        require_once "dbconnection.php";
        $contains;
        $doesnotcontain;
        $category;
        $store;
        if (isset ($_POST["contains"])) {
            $contains = $_POST["contains"];
        }
        echo "<h2>Results for Search '" . $contains . "'</h2>";
        echo "<Button id ='button' onclick=\"location.href=' ../guest.php'\">Back to Search</Button>";
        if (isset ($_POST["does-not-contain"])) {
            $doesnotcontain = $_POST["does-not-contain"];
        }
        if (isset ($_POST["category"])) {
            $category = $_POST["category"];
        }
        if (isset ($_POST["store-name"])) {
            $store = $_POST["store-name"];
        }
            //and fetch results
            $sql;
            if (!empty ($_POST["does-not-contain"])) {
                $sql = "SELECT p.*, pr.Price
                    FROM products p
                    JOIN categories c ON p.categoryID = c.categoryID 
                    JOIN productstores ps ON p.productID = ps.productID 
                    JOIN stores s ON ps.StoreID = s.StoreID
                    LEFT JOIN prices pr ON p.productID = pr.ProductID AND s.StoreID = pr.StoreID
                    WHERE p.ProductName LIKE CONCAT('%', ?, '%') AND p.ProductName NOT LIKE CONCAT('%', ?, '%');";

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
                        echo "<div><a href='../signup.html'><img src='../" . $row['Photo'] . "' width='200px' height='200px'></a><br>" . $row['ProductName'] . "<br>Price: $" . $row['Price'] . "</div>";
                    }
                }
            } else {
                $sql = "SELECT p.*, pr.Price
                    FROM products p
                    JOIN categories c ON p.categoryID = c.categoryID 
                    JOIN productstores ps ON p.productID = ps.productID 
                    JOIN stores s ON ps.StoreID = s.StoreID 
                    LEFT JOIN prices pr ON p.productID = pr.ProductID AND s.StoreID = pr.StoreID
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
                        echo "<div><a href='../signup.html'><img src='../" . $row['Photo'] . "' width='200px' height='200px'></a><br>" . $row['ProductName'] . "<br>Price: $" . $row['Price'] . "</div>";
                    }
                }
            }
            mysqli_free_result($results);
            mysqli_close($connection);
        ?>
    </div>
    <hr>
    <h3 style="margin-bottom: 0;"><a href=" ../signup.html">Sign Up</a></h3>
    <footer>
        <p style="margin-top: 10px;"><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>