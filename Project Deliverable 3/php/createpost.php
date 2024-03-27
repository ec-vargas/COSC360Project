<?php
    session_start();
    require_once "dbconnection.php";
    $sql = "SELECT MAX(CommentID) as maxcommentid FROM comments";
    $results = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($results);
    $CommentId = $row['maxcommentid'] + 1;
    $Username;
    $newcomment;
    $productId;
    if(isset($_POST['Comment'])) {
        $newcomment = $_POST['Comment'];
    }
    if(isset($_POST['ProductId'])) {
        $productId = $_POST['ProductId'];
    }
    if(isset($_POST['Username'])) {
        $Username = $_POST['Username'];
    }
    $sql = "SELECT * FROM users WHERE Username = '".$Username."';";
    $results = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($results);
    $UserID = $row["UserID"];
    $commentdate = date("Y/m/d h/m/s");

    $sql = "INSERT INTO comments (CommentID, ProductID, UserID, Comment, CommentDate) VALUES ('".$CommentId."', '".$productId."', '".$UserID."', '".$newcomment."', '".$commentdate."');";

    mysqli_query($connection, $sql);

    mysqli_free_result($results);
    mysqli_close($connection);
?>