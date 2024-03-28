<?php
// Connect to your MySQL database
 require_once "dbconnection.php";

// Fetch user data from the database
$sql = "SELECT * FROM Users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        var_dump($row); // Inspect row data
        $profile_photo = $row["ProfilePhoto"];
        echo '<img src="' . $profile_photo . '" class="img-thumbnail" alt="User Profile Photo">';
    }

} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
