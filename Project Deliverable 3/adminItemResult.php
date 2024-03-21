<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Find User - Admin Panel</title>
    <link rel="stylesheet" href="css/reset.css" />
    <style>
        /* Center the sections */
        section {
            text-align: center;
            margin: 20px auto; /* Adjust margin for centering */
            max-width: 600px; /* Limit the maximum width */
        }

        /* Style for the search button */
        #search-button {
            margin-top: 20px; /* Adjust margin as needed */
            display: block; /* Make button display as block to occupy full width */
            margin-left: auto; /* Move button to right */
            margin-right: auto; /* Move button to left */
            background-color: #3CB371; /* Green color */
            color: white; /* Text color */
            border: none; /* Remove border */
            padding: 10px 20px; /* Adjust padding */
            border-radius: 5px; /* Rounded corners */
            font-size: 16px; /* Font size */
            cursor: pointer; /* Cursor style */
        }

        /* Style for the text input boxes */
        .search-form-container input[type="text"] {
            width: 80%; /* Adjust width as needed */
            padding: 10px; /* Adjust padding as needed */
            margin-bottom: 10px; /* Adjust margin as needed */
            border: 1px solid #3CB371; /* Green border */
            border-radius: 5px; /* Rounded corners */
        }

        /* Left align the headings starting from h2 */
        h2 {
            text-align: left;
            margin-bottom: 10px; /* Adjust margin as needed */
            color: #3CB371; /* Green color */
        }
        
        #home {
            position: absolute; /* Position relative to the body */
            top: 10px; /* Distance from top */
            right: 10px; /* Distance from right */
            padding: 10px 20px; /* Adjust padding */
            background-color: #3CB371; /* Green color */
            border: none; /* Remove border */
            border-radius: 5px; /* Rounded corners */
            font-size: 16px; /* Font size */
            cursor: pointer; /* Cursor style */
            color: white; /* Text color */
        }

        /* Style for the "Admin Home" button text */
        #home span {
            vertical-align: middle; /* Align text vertically */
        }
        
        hr {
            border-color: #3CB371; /* Green color */
        }
        
        footer {
            color: #3CB371; /* Green color */
            background-color: rgb(171, 223, 117); /* Green color */
            padding: 1em;
            position: relative;
            width: 100%;
            bottom: 0;
            margin-bottom: 0px;
        }
        
        body {
            background-color: rgb(96, 105, 92);
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        
        h1,h2,button {
            margin-left: 20px;
        }
        a {
            background-color: rgb(96, 105, 92);
            margin-top: 1em;
            margin-left: 8em;
            padding: 0.7em;
            color: white;
            text-decoration: none;
            float: left;
            clear: left;
        }
        button {
            border: 0;
            line-height: 1.65;
            padding: 0 20px;
            font-size: 1rem;
            text-align: center;
            text-decoration: none;
            color: #090909;
            border-radius: 10px;
            background-color: rgb(255, 246, 246);
            display: block;
            /* display each button on a new line */
        }
        
        button:hover {
            background-color: #1fe600;
        }

        div {
            padding: 10px;
            margin: 5px 5px 5px 65px;
            background-color: rgb(171, 223, 117);
            width: 200px;
            display: inline-block;
        }
        #button {
            margin-bottom: 10px;
        }
        h1 {
            margin-left: 20px;
            margin-top: 10px;
        }

        h1, h2 {
            font-size: 25px;
        }
    </style>
</head>

<body>
    <button id="home" class="homebutton" onclick="location.href='adminOptions.html'"><span>Admin Home</span></button>
    <h1>GroceryPricer.ca</h1>
    <hr>

    <h2>Results for Advanced Search</h2>
    <Button id ="button" onclick="location.href='adminFindItems.html'">Back to Search</Button>

    <?php
        $contains;
        $doesnotcontain;
        $category;
        $store;
        if (isset($_POST["contains"])) {
            $contains = $_POST["contains"];
        }
        if (isset($_POST["does-not-contain"])) {
            $doesnotcontain = $_POST["does-not-contain"];
        }
        if (isset($_POST["category"])) {
            $category = $_POST["category"];
        }
        if (isset($_POST["store-name"])) {
            $store = $_POST["store-name"];
        }
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
            $sql;
            if (!empty($_POST["does-not-contain"])) {
                $sql = "SELECT * 
                        FROM products JOIN categories on products.categoryID = categories.categoryID 
                        JOIN productstores on products.productID = productStores.productID 
                        JOIN stores on productstores.StoreID = stores.StoreID
                        WHERE ProductName LIKE CONCAT('%', ?, '%') AND ProductName NOT LIKE CONCAT('%', ?, '%');";
                
                if ($statement = mysqli_prepare($connection, $sql)) {
                mysqli_stmt_bind_param($statement, "ss", $contains, $doesnotcontain);
                mysqli_stmt_execute($statement);
                
                $results = mysqli_stmt_get_result($statement);
                while ($row = mysqli_fetch_assoc($results))
                    {
                        if (!empty($_POST["category"])) {
                            if (!(strpos(strtoupper($row['CategoryName']), strtoupper($category)) !== false)) {continue;}
                        }
                        if (!empty($_POST["store-name"])) {
                            if (!(strpos(strtoupper($row['StoreName']), strtoupper($store)) !== false)) {continue;}
                        }
                        echo "<div><img src='".$row['Photo']."' width = 200px height = 200px><br>".$row['ProductName']."</div>";
                    }
            }
            } else {
                $sql = "SELECT * FROM products 
                JOIN categories on products.categoryID = categories.categoryID 
                JOIN productstores on products.productID = productStores.productID 
                JOIN stores on productstores.StoreID = stores.StoreID 
                WHERE ProductName LIKE CONCAT('%', ?, '%')";

                if ($statement = mysqli_prepare($connection, $sql)) {
                    mysqli_stmt_bind_param($statement, "s", $contains);
                    mysqli_stmt_execute($statement);
                    
                    $results = mysqli_stmt_get_result($statement);
                    while ($row = mysqli_fetch_assoc($results))
                    {
                        if (!empty($_POST["category"])) {
                            if (!(strpos(strtoupper($row['CategoryName']), strtoupper($category)) !== false)) {continue;}
                        }
                        if (!empty($_POST["store-name"])) {
                            if (!(strpos(strtoupper($row['StoreName']), strtoupper($store)) !== false)) {continue;}
                        }
                        echo "<div><img src='".$row['Photo']."' width = 200px height = 200px><br>".$row['ProductName']."</div>";
                    }
            }
        }
            mysqli_free_result($results);
            mysqli_close($connection);
        }?>

    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>
