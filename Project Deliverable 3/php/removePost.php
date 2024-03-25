<?php
// Connect to the database
require_once "dbconnection.php";

$userId = $_POST['UserId'];

// Delete the record from the database
$sql = "DELETE FROM comments WHERE UserID = $userId";

mysqli_query($connection, $sql);

mysqli_close($connection);

?>
