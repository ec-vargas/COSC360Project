<?php
// $host = "localhost";
// $database = "GPT";
// $user = "root";
// $password = "66060229";

$host = "localhost";
$database = "db_19574540";
$user = "19574540";
$password = "19574540";

// $host = "localhost";
// $database = "cosc360";
// $user = "83066985";
// $password = "83066985";
$connection = mysqli_connect($host, $user, $password, $database);

$error = mysqli_connect_error();
if ($error != null) {
    $output = "<p>Unable to connect to database!</p>";
    exit ($output);
}
