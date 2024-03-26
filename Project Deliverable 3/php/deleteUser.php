<?php
// Connect to the database
require_once "dbconnection.php";

$UserID = $_POST['UserID'];

// Delete the record from the database
$sql = "DELETE FROM users WHERE UserID = '$UserID'";

mysqli_query($connection, $sql);

mysqli_close($connection);

?>
