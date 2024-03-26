<?php
// Connect to your MySQL database
// Example:
$servername = "localhost";
$username = "root";
$password = "66060229";
$dbname = "GPT";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die ("Connection failed: " . $conn->connect_error);
}

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
