<?php include 'dbconnection.php'; ?>

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price Data Page</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
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
        button {
            padding: 8px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
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
<form method="post" action="">
    <label for="searchKeyword">Search for item:</label>
    <input type="text" name="searchKeyword" id="searchKeyword" required>
    <label for="startDate">Start Date:</label>
    <input type="date" name="startDate" id="startDate" value="2024-01-01" required>
    <label for="endDate">End Date:</label>
    <input type="date" name="endDate" id="endDate" value="2024-03-20" required>
    <button type="submit" name="search">Search</button>
</form>

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
</body>
</html>
