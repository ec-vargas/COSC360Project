<?php
    require_once "dbconnection.php";
    $productId;
    $price;
    if (isset($_POST['ProductId'])) {
        $productId = $_POST['ProductId'];
    } else {echo "Error";}
    if (isset($_POST['Price'])) {
        $price = $_POST['Price'];
    } else {echo "Error";}
    
    $sql = "SELECT MAX(PriceID) as maxitemid, StoreID FROM prices WHERE ProductID = '".$productId."';";
    $results = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($results);
    $priceId = $row['maxitemid'] + 1;
    $storeId = $row['StoreID'];
    $pricechangeDate = date("Y/m/d h/m/s");

    $sql = "INSERT INTO prices(PriceID, ProductID, StoreID, Price, PriceDate) VALUES ('".$priceId."', '".$productId."', '".$storeId."', '".$price."', '".$pricechangeDate."');";

    mysqli_query($connection, $sql);

    mysqli_free_result($results);
    mysqli_close($connection);

    return true;
    ?>