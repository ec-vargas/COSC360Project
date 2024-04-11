<?php session_start();?>
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

        }

        .store-info p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container-fluid-2">
        <div class="d-flex justify-content-between align-items-center">
            <?php
                if (isset($_SESSION['username'])) {echo "<h1>GroceryPricer.ca</h1>";}
                else {echo "<h1><a href='home.html'>GroceryPricer.ca</a></h1>";}
            ?>
            <div class="header2">
                <?php if (isset ($_SESSION['profile_photo'])): ?>
                    <img src="<?php echo $_SESSION['profile_photo']; ?>" alt="User Profile Photo" class="img-thumbnail">
                <?php endif; ?>
                <button style="margin-right: 2%;" onclick="location.href='UserAccount.php'"><?php echo $_SESSION['username'];?></button>
                <a href="php/logout.php" style="font-size: 2em;">LogOut&nbsp;</a>
                <a href="adminLogin.php" style="font-size: 2em;">&nbsp;Admin Login</a>
            </div>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Store Search</li>
            </ol>
        </nav>
        <hr>
    </div>
    <div class="col-10 mx-auto">
        <h2>Search for Stores:</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="searchStore">Search by Store Name:</label>
            <input type="text" id="searchStore" name="searchStore" placeholder="Enter store name...">
            <button type="submit">Search</button>
        </form>
        <?php include 'php/dbconnection.php'; ?>
        <?php

        if (isset ($_POST['searchStore'])) {
            $searchStore = $_POST['searchStore'];

            $sql = "SELECT * FROM stores WHERE StoreName LIKE '%$searchStore%'";

            $results = mysqli_query($connection, $sql);

            if (mysqli_num_rows($results) > 0) {
                while ($row = mysqli_fetch_assoc($results)) {
                    echo "<div class='store-info'>";
                    echo "<h3>Store Name: " . $row["StoreName"] . "</h3>";
                    echo "<img src='" . $row["StorePhoto"] . "' alt='Store Photo'>";
                    echo "<p><strong>Location:</strong> " . $row["Location"] . "</p>";
                    echo "<form method='post' action='php/price_data_page.php'>";
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
    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>