<?php
    require_once "dbconnection.php";
    $UserID;
    $newUsername;

    if(isset($_POST['UserID'])) {
        $UserID = $_POST['UserID'];
    }
    if(isset($_POST['newUsername'])) {
        $newUsername = $_POST['newUsername'];
    }
    
    $sql = "UPDATE users SET Username = '$newUsername' WHERE UserID = '".$UserID."';";

    mysqli_query($connection, $sql);

    mysqli_close($connection);
    ?>