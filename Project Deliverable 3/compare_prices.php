<?php
// Database connection parameters
$host = "localhost";
$database = "GPT";
$user = "root";
$password = "";


try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


if (isset($_POST['search'])) {
    $searchKeyword = $_POST['searchKeyword'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

$query = "SELECT P.ProductID, Pr.PriceID, Pr.StoreID, Pr.Price, Pr.PriceDate, S.StoreName
FROM Prices Pr
INNER JOIN Products P ON Pr.ProductID = P.ProductID
INNER JOIN Stores S ON Pr.StoreID = S.StoreID
WHERE P.ProductName = :searchKeyword
AND Pr.PriceDate BETWEEN :startDate AND :endDate";

    try {
       
        $statement = $pdo->prepare($query);
        
  
        $statement->bindParam(':searchKeyword', $searchKeyword);
        $statement->bindParam(':startDate', $startDate);
        $statement->bindParam(':endDate', $endDate);
        
     
        $statement->execute();
        
        
        $prices = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        $storesData = []; 
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
                $storeName = $storeData['name']; 
                echo "<h3> Store Name: $storeName</h3>"; 
                echo "<canvas id='priceChart$storeID'></canvas>"; 
            }
        } else {
            echo "No price data found for Product '$searchKeyword' within the specified date range.";
        }
    } catch (PDOException $e) {
        die("Error retrieving price data: " . $e->getMessage());
    }
}
?>


<form method="post" action="">
    <label for="searchKeyword">Search for item:</label>
    <input type="text" name="searchKeyword" id="searchKeyword" required>
    <label for="startDate">Start Date:</label>
    <input type="date" name="startDate" id="startDate" value="2024-01-01" required>
    <label for="endDate">End Date:</label>
    <input type="date" name="endDate" id="endDate" value="2024-03-20" required>
    <button type="submit" name="search">Search</button>
</form>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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