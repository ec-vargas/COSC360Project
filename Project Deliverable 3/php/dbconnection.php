<?php

 $host = "localhost";
 $database = "db_19574540";
 $user = "19574540";
 $password = "19574540";

$connection = mysqli_connect($host, $user, $password, $database);

$error = mysqli_connect_error();
if ($error != null) {
    $output = "<p>Unable to connect to database!</p>";
    exit ($output);
}
