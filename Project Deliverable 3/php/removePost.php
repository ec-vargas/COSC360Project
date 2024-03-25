<?php
// Connect to the database
require_once "dbconnection.php";

$CommentID = $_POST['CommentID'];

// Delete the record from the database
$sql = "DELETE FROM comments WHERE CommentID = '$CommentID'";

mysqli_query($connection, $sql);

mysqli_close($connection);

?>
