<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Search Page</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .container {
            padding: 20px;
        }

        .store-info {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .store-info h3 {
            margin-bottom: 10px;
        }

        .store-info img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .store-info p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Search for Stores:</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="searchStore">Search by Store Name:</label>
            <input type="text" id="searchStore" name="searchStore" placeholder="Enter store name...">
            <button type="submit">Search</button>
        </form>

        <?php
        $host = "localhost";
        $database = "GPT";
        $user = "root";
        $password = "";

        $connection = mysqli_connect($host, $user, $password, $database);

        $error = mysqli_connect_error();
        if($error != null) {
            $output = "<p>Unable to connect to database!</p>";
            exit($output);
        }

        if(isset($_POST['searchStore'])) {
            $searchStore = $_POST['searchStore'];

            $sql = "SELECT * FROM Stores WHERE StoreName LIKE '%$searchStore%'";

            $results = mysqli_query($connection, $sql);

            if (mysqli_num_rows($results) > 0) {
                while ($row = mysqli_fetch_assoc($results)) {
                    echo "<div class='store-info'>";
                    echo "<h3>Store Name: " . $row["StoreName"] . "</h3>";
                    echo "<img src='" . $row["StorePhoto"] . "' alt='Store Photo'>";
                    echo "<p><strong>Location:</strong> " . $row["Location"] . "</p>";
                    echo "<form method='post' action='price_data_page.php'>";
                    echo "<input type='hidden' name='storeName' value='" . $row["StoreName"] . "'>";
                    echo "<button type='submit'>View Prices</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "No stores found matching the search.";
            }
        }

        mysqli_close($connection);
        ?>
    </div>
</body>
</html>
