<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "66060229";
$database = "GPT";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die ("Connection failed: " . $conn->connect_error);
}

// Get the search term from the form
$searchTerm = $_GET['search'];

// SQL query to search for products
$sql = "SELECT * FROM Products WHERE ProductName LIKE '%$searchTerm%'";

$result = $conn->query($sql);

// Display the results as HTML
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>Product ID: " . $row["ProductID"] . " - Name: " . $row["ProductName"] . " - Category ID: " . $row["CategoryID"] . "</div>";
    }
} else {
    echo "<div>No results found</div>";
}

$conn->close();