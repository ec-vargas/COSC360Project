<?php include 'dbconnection.php';
session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price Data Page</title>
    <link rel="stylesheet" href="../css/reset.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        h2 {
            margin-top: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        #buttonactions {
            padding: 8px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        #buttonactions {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        #buttonactions:hover {
            background-color: #0056b3;
        }

        #priceChartContainer {
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="container-fluid-2">
        <div class="d-flex justify-content-between align-items-center">
            <?php
                if (isset($_SESSION['username'])) {echo "<h1>GroceryPricer.ca</h1>";}
                else {echo "<h1><a href='../home.html'>GroceryPricer.ca</a></h1>";}
            ?>
            <div class="header2">
                <button style="margin-right: 2%;"><?php echo $_SESSION['username'];?></button>
                <a href="logout.php" class="btn btn-link" style="font-size: 2em;">LogOut</a>
                <a href="../adminLogin.php" class="btn btn-link" style="font-size: 2em;">Admin Login</a>
            </div>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../main.php">Home</a></li>
                <li class="breadcrumb-item"><a href="../searchStores.php">Search for Prices</a></li>
                <li class="breadcrumb-item active" aria-current="page">Price Data</li>
            </ol>
        </nav>
        <hr>
    </div>
    <?php
    if(isset($_POST['storeName'])) {
        $storeName = $_POST['storeName'];
    ?>
    <h2>Search for Product:</h2>
    <form method="post" action="price_data_page.php"> 
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" placeholder="Enter product name...">
        <label for="startDate">Start Date:</label>
        <input type="date" name="startDate" id="startDate" value="2024-01-01" required>
        <label for="endDate">End Date:</label>
        <input type="date" name="endDate" id="endDate" value="2024-03-20" required>
        <input type="hidden" name="storeName" value="<?php echo $storeName; ?>">
        <button type="submit" name="search" id="buttonactions">Search</button>
    </form>
    <?php
    } else {
        echo "No store name provided.";
    }
    ?>

    <?php
    if(isset($_POST['search'])) {
        $query = "SELECT P.ProductID, Pr.PriceID, Pr.StoreID, Pr.Price, Pr.PriceDate, S.StoreName
                FROM prices Pr
                INNER JOIN products P ON Pr.ProductID = P.ProductID
                INNER JOIN stores S ON Pr.StoreID = S.StoreID
                WHERE P.ProductName = ?
                AND Pr.PriceDate BETWEEN ? AND ?
                AND S.StoreName = ?";

        $statement = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($statement, "ssss", $_POST['productName'], $_POST['startDate'], $_POST['endDate'], $storeName);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        $prices = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $labels = [];
        $data = [];
        foreach ($prices as $price) {
            $labels[] = $price['PriceDate'];
            $data[] = $price['Price'];
        }

        if (count($prices) > 0) {
            echo "<h2>Price Data for Product '{$_POST['productName']}' at $storeName from {$_POST['startDate']} to {$_POST['endDate']}</h2>";
            echo "<canvas id='priceChart'></canvas>"; 

            echo "<script>
                    var ctx = document.getElementById('priceChart').getContext('2d');
                    var priceChart = new Chart(ctx, {
                        type: 'line', // Change to line graph
                        data: {
                            labels: " . json_encode($labels) . ",
                            datasets: [{
                                label: 'Price',
                                data: " . json_encode($data) . ",
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                  </script>";

            echo "<form method='post' action='compare_prices.php'>"; 
            echo "<input type='hidden' name='productName' value='{$_POST['productName']}'>";
            echo "<input type='hidden' name='startDate' value='{$_POST['startDate']}'>";
            echo "<input type='hidden' name='endDate' value='{$_POST['endDate']}'>";
            echo "<button type='submit' name='compare' id='buttonactions'>Compare prices at other stores</button>";
            echo "</form>";
        } else {
            echo "No price data found for Product '{$_POST['productName']}' at $storeName within the specified date range.";
        }
    }
    ?>
    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>
</html>
