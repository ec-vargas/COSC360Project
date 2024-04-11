<?php
// fetchcomments.php

// Include the database connection file
require_once "dbconnection.php";

// Check if ProductId is set in the request
if(isset($_GET['ProductId'])) {
    // Sanitize input to prevent SQL injection
    $productId = mysqli_real_escape_string($connection, $_GET['ProductId']);
    
    // Query to fetch comments for the specified ProductId
    $sql = "SELECT comments.Comment, comments.CommentDate, users.Username 
            FROM comments 
            JOIN users ON comments.UserID = users.UserID 
            WHERE comments.ProductId = '$productId'";
    
    $result = mysqli_query($connection, $sql);
    
    // Array to store comments
    $comments = [];
    
    // Fetch comments and store them in the array
    while($row = mysqli_fetch_assoc($result)) {
        $comments[] = $row;
    }
    
    // Return comments data in JSON format
    echo json_encode($comments);
}
?>
