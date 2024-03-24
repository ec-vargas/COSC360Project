<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Search Page</title>
    <link rel="stylesheet" href="css/reset.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />

    <style>
        .container {
            padding: 20px;
        }

        .store-info {
            margin-bottom: 20px;
            padding: 20px;

            background-color: #6E9075;
        }

        .store-info h3 {
            margin-bottom: 10px;
        }

        .store-info img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .store-info p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container-fluid-2">
        <div class="d-flex justify-content-between align-items-center">
            <h1><a href="home.html">GroceryPricer.ca</a></h1>
            <div class="header2">
                <a href="login.html" class="btn btn-link" style="font-size: 2em;">Login</a>
                <a href="adminLogin.html" class="btn btn-link" style="font-size: 2em;">Admin Login</a>
            </div>
        </div>
        <hr>
    </div>
    <div class="col-10 mx-auto">
        <h2>Search for Stores:</h2>
        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="searchInput">Search by Store Name:</label>
            <input type="text" id="searchInput" name="search" placeholder="Enter store name...">
            <button type="submit" style="margin-bottom: 10px;">Search</button>

        </form>

        <?php
        $host = "localhost";
        $database = "GPT";
        $user = "root";
        $password = "66060229";

        if (isset ($_GET['search'])) {
            $search = $_GET['search'];

            if (!empty ($search)) {
                $connection = mysqli_connect($host, $user, $password, $database);

                $error = mysqli_connect_error();
                if ($error != null) {
                    $output = "<p>Unable to connect to database!</p>";
                    exit ($output);
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
                                echo "<br";
                                echo "<p><strong>Location:</strong> " . $row["Location"] . "</p>";
                                echo "</div>";

                                echo "<Button id ='button' onclick=\"location.href='searchStores.php'\">Back to Search</Button>";
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
    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>