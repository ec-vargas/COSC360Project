<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Find User - Admin Panel</title>
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/AdminStyleSheets.css" />
    <style>
        section {
            margin: 20px;
            padding: 5px;
            height: 250px;
            background-color: rgb(171, 223, 117);
        }

        h1,
        h2,
        button,
        input {
            margin-left: 20px;
        }

        #button {
            border: 0;
            line-height: 1.65;
            padding: 0 15px;
            font-size: 1rem;
            text-align: center;
            text-decoration: none;
            color: #090909;
            border-radius: 10px;
            background-color: rgb(255, 246, 246);
            display: block;
            margin-top: 10px;
            margin-left: 340px;
        }

        input {
            height: 32px;
            font-size: 15px;
        }

        .inline {
            display: inline;
            text-align: center;
        }

        .sheaders {
            margin-bottom: 0px;
        }

        #button:hover {
            background-color: #1fe600;
        }

        #location {
            padding-bottom: 3em;
        }

        footer {
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <button id="home" class="homebutton" onclick="location.href='adminOptions.html'"><span>Admin Home</span></button>
    <h1><a href="home.html">GroceryPricer.ca</a></h1>
    <hr id="tophr">
    <h2 class="sheaders">Item Details</h2>
    <section>
        <?php

            $ProductID = $_GET['ProductID'];
            

            $host = "localhost";
            $database = "cosc360";
            $user = "83066985";
            $password = "83066985";

            $connection = mysqli_connect($host, $user, $password, $database);

            $error = mysqli_connect_error();
            if($error != null)
            {
            $output = "<p>Unable to connect to database!</p>";
            exit($output);
            }
            else
            {
            //and fetch results
            $sql = "SELECT * FROM products 
            JOIN productstores on products.productID = productStores.productID 
            JOIN stores on productstores.StoreID = stores.StoreID
            JOIN prices on products.productID = prices.productID";
            }
            
            $previousrow;
            $results = mysqli_query($connection, $sql);
                while ($row = mysqli_fetch_assoc($results))
                    {
                        if ($row['ProductID'] === $ProductID && strtotime($row['PriceDate']) > strtotime(date("Y/m/d"))) {
                            echo "<h2>Name: ".$row['ProductName']."</h2>";
                            echo "<h2 id='location'>Store Location: ".$row['Location']."</h2>";
                            echo "<h2>Current Price: ".$previousrow['Price']."</h2>";
                            break;
                        }
                        $previousrow = $row;
                    }
        ?>
    </section>
    <h2 class="sheaders">Update Price: </h2>
    <input type="text" class="inline" placeholder="Old Price">
    <h2 class="inline"> to </h2>
    <input type="text" class="inline" placeholder="New Price">
    <Button id="button" onclick="location.href='adminFIndItems.html'">Save Changes</Button>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>