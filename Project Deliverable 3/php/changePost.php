<?php
    require_once "dbconnection.php";
    $newUsername = $_POST['newUsername'];
    $userId = $_POST['UserId'];

    $sql = "UPDATE comments SET Comment='$newUsername' WHERE UserID = '$userId';";

    mysqli_query($connection, $sql);

    mysqli_free_result($results);
    mysqli_close($connection);
    ?>