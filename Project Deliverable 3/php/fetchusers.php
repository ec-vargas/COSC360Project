<?php
// Include the database connection file
require_once "dbconnection.php";

// Fetch users from the database
$sql = "SELECT * FROM users";
$result = mysqli_query($connection, $sql);

// Store the fetched users in an array
$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

// Return the users data in JSON format
echo json_encode($users);
?>
