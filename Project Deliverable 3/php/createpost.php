<?php
    require_once "dbconnection.php";
    $sql = "SELECT MAX(CommentID) as maxcommentid FROM comments";
    $results = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($results);
    $CommentId = $row['maxcommentid'] + 1;

    $newcomment = $_POST['Comment'];
    $userId = $_POST['UserId'];
    $productId = $_POST['ProductId'];
    $commentdate = date("Y/m/d");

    $sql = "INSERT INTO comments (CommentID, ProductID, UserID, Comment, CommentDate) VALUES ('".$CommentId."', '".$productId."', '".$newcomment."', '".$commentdate."');";

    mysqli_query($connection, $sql);

    mysqli_free_result($results);
    mysqli_close($connection);
?>