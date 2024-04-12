<?php session_start();?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Find Items - User Panel</title>
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
                <?php
                    if (isset($_SESSION['username'])) {echo "<h1>GroceryPricer.ca</h1>";}
                    else {echo "<h1><a href='home.html'>GroceryPricer.ca</a></h1>";}
                ?>
            </div>
            <div class="col">
                <div class="header2">
                    <?php if (isset ($_SESSION['profile_photo'])): ?>
                        <img src="data:image/jpeg;base64,<?php echo $_SESSION['profile_photo']?>" alt="User Profile Photo" class="img-thumbnail">
                    <?php endif; ?>
                    <button style="margin-right: 2%;" onclick="location.href='UserAccount.php'"><?php echo $_SESSION['username'];?></button>
                    <a href="php/logout.php" style="font-size: 2em;">LogOut&nbsp;</a>
                    <a href="adminLogin.php" style="font-size: 2em;">&nbsp;Admin Login</a>
                </div>
            </div>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="main.php">Home</a></li>
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
        if (isset ($_POST["contains"])) {
            $contains = $_POST["contains"];
        }
        echo "<h2>Results for Keyword Search '" . $contains . "'</h2>";
        echo "<Button id='button' onclick=\"location.href='main.php'\">Back to Search</Button>";

        $sql = "SELECT p.*, c.CategoryName, pr.Price, s.StoreName
                FROM products p 
                JOIN categories c ON p.categoryID = c.categoryID 
                JOIN productstores ps ON p.productID = ps.productID 
                JOIN stores s ON ps.StoreID = s.StoreID
                LEFT JOIN prices pr ON p.ProductID = pr.ProductID
                WHERE p.ProductName LIKE CONCAT('%', ?, '%') AND (pr.ProductID, pr.PriceDate) IN (SELECT products.ProductID, MAX(PriceDate) FROM products JOIN prices on products.ProductID = prices.ProductID GROUP BY products.ProductID)";

        if ($statement = mysqli_prepare($connection, $sql)) {
            mysqli_stmt_bind_param($statement, "s", $contains);
            mysqli_stmt_execute($statement);

                    $results = mysqli_stmt_get_result($statement);
                    $resultsperrow = 0;
                    echo "<div class='row align-items-start'>";
                    while ($row = mysqli_fetch_assoc($results)) {
                        // Output product details inline with the image, name, price, and store name
                        
                        if ($resultsperrow == 4) {
                            echo "</div><div class='row row-cols-2 row-cols-lg-4 g-2 g-lg-3'>";
                            echo "<div class='col'><a href='UserItem.php?ProductID=" . $row['ProductID'] . "&Contains=".$contains."'><img src='" . $row['Photo'] . "' width='200px' height='200px'></a><br>" . $row['ProductName'] . " - $" . $row['Price'] . " at " . $row['StoreName'] . "</div>";
                            $resultsperrow = 1;
                        } else {
                            echo "<div class='col'><a href='UserItem.php?ProductID=" . $row['ProductID'] . "&Contains=".$contains."'><img src='" . $row['Photo'] . "' width='200px' height='200px'></a><br>" . $row['ProductName'] . " - $" . $row['Price'] . " at " . $row['StoreName'] . "</div>";
                            $resultsperrow++;
                        }
                        
                        //echo "</div>";
                        $SearchTime = date("Y/m/d");
                        $ProductID = $row['ProductID'];
                        $sql = "INSERT INTO search (ProductID, SearchCount, LastSearchDate) VALUES ('$ProductID', 1, '$SearchTime') 
                                ON DUPLICATE KEY UPDATE SearchCount = SearchCount + 1, LastSearchDate = VALUES(LastSearchDate);";
                        mysqli_query($connection, $sql);
                // Output product details inline with the image, name, price, and store name
            }
        }
        mysqli_free_result($results);
        mysqli_close($connection);
        ?>
        </div>
    </div>
    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>