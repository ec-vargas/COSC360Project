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
        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="searchInput">Search by Store Name:</label>
            <input type="text" id="searchInput" name="search" placeholder="Enter store name...">
            <button type="submit">Search</button>
        </form>

        <?php
        $host = "localhost";
        $database = "GPT";
        $user = "root";
        $password = "";

        if(isset($_GET['search'])) {
            $search = $_GET['search'];

            if(!empty($search)) {
                $connection = mysqli_connect($host, $user, $password, $database);

                $error = mysqli_connect_error();
                if($error != null) {
                    $output = "<p>Unable to connect to database!</p>";
                    exit($output);
                } else {

                    $sql = "SELECT * FROM Stores WHERE StoreName LIKE ?";

         
                    if ($statement = mysqli_prepare($connection, $sql)) {
                        mysqli_stmt_bind_param($statement, "s", $search);
                    
                        mysqli_stmt_execute($statement);

                        $results = mysqli_stmt_get_result($statement);


                        if (mysqli_num_rows($results) > 0) {
                            while ($row = mysqli_fetch_assoc($results)) {
                                echo "<div class='store-info'>";
                                echo "<h3>Store Name: " . $row["StoreName"] . "</h3>";
                                echo "<img src='" . $row["StorePhoto"] . "' alt='Store Photo'>";
                                echo "<p><strong>Location:</strong> " . $row["Location"] . "</p>";
                                echo "</div>";
                            }
                        } else {
                            echo "No stores found";
                        }

                        mysqli_free_result($results);
                        mysqli_close($connection);
                    } else {
                        echo "Error in preparing SQL statement";
                    }
                }
            } else {
                echo "Please enter a store name to search.";
            }
        }
        ?>
    </div>
</body>
</html>
