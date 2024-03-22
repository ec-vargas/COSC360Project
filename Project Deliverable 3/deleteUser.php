<?php
// Connect to the database
$host = "localhost";
$database = "cosc360";
$user = "83066985";
$password = "83066985";

$connection = mysqli_connect($host, $user, $password, $database);

$error = mysqli_connect_error();
        
if($error != null)
{
$output = "<p>Unable to connect to database!</p>";
exit($output);
}
else
{

$userId = $_POST['userId'];

// Delete the record from the database
$sql = "DELETE FROM users WHERE UserID = $userId";

mysqli_query($connection, $sql);

mysqli_close($connection);

}
?>
