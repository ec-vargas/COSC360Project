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

        .store-price-info {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .store-price-info h3 {
            margin-bottom: 10px;
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
                <a href="logout.php" style="font-size: 2em;">LogOut&nbsp;</a>
                <a href="adminLogin.php" style="font-size: 2em;">&nbsp;Admin Login</a>
            </div>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../main.php">Home</a></li>
                <li class="breadcrumb-item"><a href="../searchStores.php">Search for Prices</a></li>
                <li class="breadcrumb-item"><a href="price_data_page.php">Price Data</a></li>
                <li class="breadcrumb-item active" aria-current="page">Compare Prices</li>
            </ol>
        </nav>
        <hr>
    </div>
<form method="post" action="">
    <label for="searchKeyword">Search for item:</label>
    <input type="text" name="searchKeyword" id="searchKeyword" required>
    <label for="startDate">Start Date:</label>
    <input type="date" name="startDate" id="startDate" value="2024-01-01" required>
    <label for="endDate">End Date:</label>
    <input type="date" name="endDate" id="endDate" value="2024-03-20" required>
    <button type="submit" name="search" id="buttonactions">Search</button>
</form>
<?php
$storesData = [];
if (isset($_POST['search'])) {
    $searchKeyword = $_POST['searchKeyword'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    $query = "SELECT P.ProductID, Pr.PriceID, Pr.StoreID, Pr.Price, Pr.PriceDate, S.StoreName
            FROM Prices Pr
            INNER JOIN Products P ON Pr.ProductID = P.ProductID
            INNER JOIN Stores S ON Pr.StoreID = S.StoreID
            WHERE P.ProductName = ?
            AND Pr.PriceDate BETWEEN ? AND ?";

    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, "sss", $searchKeyword, $startDate, $endDate);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $prices = mysqli_fetch_all($result, MYSQLI_ASSOC);

    
    foreach ($prices as $price) {
        $storeID = $price['StoreID'];
        $storeName = $price['StoreName'];
        $storesData[$storeID]['labels'][] = $price['PriceDate'];
        $storesData[$storeID]['data'][] = $price['Price'];
        $storesData[$storeID]['name'] = $storeName;
    }

    if (count($prices) > 0) {
        echo "<h2>Price Data for Product '$searchKeyword' from $startDate to $endDate</h2>";

        foreach ($storesData as $storeID => $storeData) {
            echo "<div class='store-price-info'>";
            echo "<h3>Store Name: {$storeData['name']}</h3>";
            echo "<canvas id='priceChart$storeID'></canvas>";
            echo "</div>";
        }
    } else {
        echo "No price data found for Product '$searchKeyword' within the specified date range.";
    }
}
?>
<?php
foreach ($storesData as $storeID => $storeData) {
    echo "<script>
        var ctx$storeID = document.getElementById('priceChart$storeID').getContext('2d');
        var priceChart$storeID = new Chart(ctx$storeID, {
            type: 'line',
            data: {
                labels: " . json_encode($storeData['labels']) . ",
                datasets: [{
                    label: 'Price',
                    data: " . json_encode($storeData['data']) . ",
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
}
?>
    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>
</html>
