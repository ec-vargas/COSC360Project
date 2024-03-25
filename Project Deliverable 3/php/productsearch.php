<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "php/dbconnection.php";

// Get the search term from the form
$searchTerm = $_GET['search'];

// SQL query to search for products
$sql = "SELECT * FROM Products WHERE ProductName LIKE '%$searchTerm%'";

$result = $connection->query($sql);

// Display the results as HTML
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>Product ID: " . $row["ProductID"] . " - Name: " . $row["ProductName"] . " - Category ID: " . $row["CategoryID"] . "</div>";
    }
} else {
    echo "<div>No results found</div>";
}

$connection->close();