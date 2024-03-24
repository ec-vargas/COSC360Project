<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Main Page</title>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
    <style>
        .scroll-container {
            margin-top: 10px;
            margin-bottom: 20px;
            overflow-x: auto;
            white-space: nowrap;
            background-color: #fff;
            width: 100%;
            height: 100%;
        }

        .product-card {
            display: inline-block;
            margin-right: 20px;
            text-align: center;
            background-color: #fff;
            padding: 10px;
        }

        .product-card img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container-fluid-2">
        <div class="d-flex justify-content-between align-items-center">
            <h1><a href="home.html">GroceryPricer.ca</a></h1>
            <div class="header2">
                <a href="login.html" class="btn btn-link" style="font-size: 2em;">Login</a>
                <a href="adminLogin.html" class="btn btn-link" style="font-size: 2em;">Admin Login</a>
            </div>
        </div>
        <hr>
    </div>
    <h2 style="margin-left: 4%; margin-bottom: 0;">Welcome to GroceryPrice Tracker</h2>
    <h3 style="margin-left: 4%; margin-bottom: 5px;">Search For Products</h3>
    <form method="POST" action="itemResult.php">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-11">
                        <input type="text" class="search" id="contains" name="contains"
                            placeholder="Enter keyword to search" autocomplete="off"
                            style="margin-top: 10px; padding: 5px 20px;">
                        <input type="submit">
                    </div>
                </div>
            </div>
        </section>
    </form>
    <h3 style="margin-left: 4%; margin-bottom: 0%;"> Recommended For You </h3>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="scroll-container">
                    <?php
                    // Connect to your database
                    $host = "localhost";
                    $database = "GPT";
                    $user = "root";
                    $password = "66060229";

                    $connection = mysqli_connect($host, $user, $password, $database);

                    // Check connection
                    if (mysqli_connect_errno()) {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        exit();
                    }

                    // Fetch lowest prices for products with photos
                    $sql = "SELECT p.ProductName, pr.Price, p.Photo
                    FROM Products p
                    INNER JOIN Prices pr ON p.ProductID = pr.ProductID
                    ORDER BY pr.Price DESC
                    LIMIT 10";
                    $result = mysqli_query($connection, $sql);

                    // Display products with lowest prices and photos
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='product-card'>";
                        echo "<img src='" . $row['Photo'] . "' alt='" . $row['ProductName'] . "'>";
                        echo "<h4>" . $row['ProductName'] . "</h4>";
                        echo "<p>Price: $" . $row['Price'] . "</p>";
                        echo "</div>";
                    }

                    // Free result set
                    mysqli_free_result($result);

                    // Close connection
                    mysqli_close($connection);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <h3 style="margin-left: 4%; margin-bottom: 5px;"><a href="searchStores.php">Search For Stores</a></h3>


    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>

</body>

</html>