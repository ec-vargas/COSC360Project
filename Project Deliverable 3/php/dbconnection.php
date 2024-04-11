<?php

$host = "localhost";
$database = "GPT";
$user = "root";
$password = "66060229";

$connection = mysqli_connect($host, $user, $password, $database);

$error = mysqli_connect_error();
if ($error != null) {
    $output = "<p>Unable to connect to database!</p>";
    exit($output);
}
?>