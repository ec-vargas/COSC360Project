<?php
    require_once "dbconnection.php";
    $newComment = $_POST['Comment'];
    $CommentID = $_POST['CommentID'];

    $sql = "UPDATE comments SET Comment='$newComment' WHERE CommentID = '$CommentID';";

    mysqli_query($connection, $sql);
    
    mysqli_free_result($results);
    mysqli_close($connection);
    ?>