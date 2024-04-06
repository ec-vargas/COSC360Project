<?php

<<<<<<< HEAD
 $host = "localhost";
 $database = "db_83066985";
 $user = "83066985";
 $password = "83066985";
=======
$host = "localhost";
$database = "GPT";
$user = "root";
$password = "66060229";
>>>>>>> 99e4c4a (unfinished changes)

$connection = mysqli_connect($host, $user, $password, $database);

$error = mysqli_connect_error();
if ($error != null) {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
}
?>