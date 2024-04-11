<?php
// fetchcomments.php

// Include the database connection file
require_once "dbconnection.php";

// Query to fetch all comments
$sql = "SELECT CommentDate FROM comments";

$result = mysqli_query($connection, $sql);

// Array to store comments count per day
$commentsByDay = [];

// Fetch comments and count the number of comments per day
while($row = mysqli_fetch_assoc($result)) {
    $commentDate = date('Y-m-d', strtotime($row['CommentDate'])); // Extract date part
    if (isset($commentsByDay[$commentDate])) {
        $commentsByDay[$commentDate]++;
    } else {
        $commentsByDay[$commentDate] = 1;
    }
}

// Return comments count per day in JSON format
echo json_encode($commentsByDay);
?>
