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
    <style>
        h1,
        h2,
        button {
            margin-left: 20px;
        }

        #button {
            border: 0;
            line-height: 1.65;
            padding: 0 20px;
            font-size: 1rem;
            text-align: center;
            text-decoration: none;
            color: #090909;
            border-radius: 10px;
            background-color: rgb(255, 246, 246);
            display: block;
        }

        #button:hover {
            background-color: #1fe600;
        }

        div {
            padding: 10px;
            margin: 5px 5px 5px 65px;
            background-color: rgb(171, 223, 117);
            width: 200px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <h1><a href=" ../home.html">GroceryPricer.ca</a></h1>
    <hr id="tophr">

    <?php
    $contains;
    $doesnotcontain;
    $category;
    $store;
    if (isset ($_POST["contains"])) {
        $contains = $_POST["contains"];
    }
    echo "<h2>Results for Search '" . $contains . "'</h2>";
    echo "<Button id ='button' onclick=\"location.href=' ../guest.html'\">Back to Search</Button>";
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
            $sql = "SELECT * 
                        FROM products JOIN categories on products.categoryID = categories.categoryID 
                        JOIN productstores on products.productID = productStores.productID 
                        JOIN stores on productstores.StoreID = stores.StoreID
                        WHERE ProductName LIKE CONCAT('%', ?, '%') AND ProductName NOT LIKE CONCAT('%', ?, '%');";

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
                    echo "<div><a href='adminChangePriceData.html'><img src='" . $row['Photo'] . "' width = 200px height = 200px></a><br>" . $row['ProductName'] . "</div>";
                }
            }
        } else {
            $sql = "SELECT * FROM products 
                JOIN categories on products.categoryID = categories.categoryID 
                JOIN productstores on products.productID = productStores.productID 
                JOIN stores on productstores.StoreID = stores.StoreID 
                WHERE ProductName LIKE CONCAT('%', ?, '%')";

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
                    echo "<div><a href='adminChangePriceData.php?ProductID=" . $row['ProductID'] . "'><img src='" . $row['Photo'] . "' width = 200px height = 200px></a><br>" . $row['ProductName'] . "</div>";
                }
            }
        }
        mysqli_free_result($results);
        mysqli_close($connection);
    } ?>

    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>