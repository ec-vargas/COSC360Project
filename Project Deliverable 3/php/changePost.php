<?php
    require_once "dbconnection.php";
    $newComment;
    $CommentID;

    if(isset($_POST['Comment'])) {
        $newComment = $_POST['Comment'];
    }
    if(isset($_POST['CommentID'])) {
        $CommentID = $_POST['CommentID'];
    }

    $sql = "UPDATE comments SET Comment='$newComment' WHERE CommentID = '$CommentID';";

    mysqli_query($connection, $sql);
    
    mysqli_close($connection);
    ?>