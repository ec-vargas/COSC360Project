<?php
    require_once "dbconnection.php";
    $UserID = $_POST['UserID'];
    $newUsername = $_POST['newUsername'];
    $sql = "UPDATE users SET Username = '$newUsername' WHERE UserID = '".$UserID."';";

    mysqli_query($connection, $sql);

    mysqli_close($connection);
    ?>