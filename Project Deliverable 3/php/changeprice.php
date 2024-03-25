<?php
    require_once "dbconnection.php";
    $productId = $_POST['ProductId'];
    $price = $_POST['Price'];
    $sql = "SELECT MAX(PriceID) as maxitemid, StoreID FROM prices WHERE ProductID = '".$productId."';";
    $results = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($results);
    $priceId = $row['maxitemid'] + 1;
    $storeId = $row['StoreID'];
    $pricechangeDate = date("Y/m/d");

    $sql = "INSERT INTO prices(PriceID, ProductID, StoreID, Price, PriceDate) VALUES ('".$priceId."', '".$productId."', '".$storeId."', '".$price."', '".$pricechangeDate."');";

    mysqli_query($connection, $sql);

    mysqli_free_result($results);
    mysqli_close($connection);
    ?>