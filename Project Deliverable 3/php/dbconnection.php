<?php
    $host = "localhost";
    $database = "cosc360";
    $user = "83066985";
    $password = "83066985";

    $connection = mysqli_connect($host, $user, $password, $database);

    $error = mysqli_connect_error();
    if ($error != null) {
        $output = "<p>Unable to connect to database!</p>";
        exit ($output);
    }
?>