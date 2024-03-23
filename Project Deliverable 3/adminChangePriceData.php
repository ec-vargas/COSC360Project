<?php
$ProductID;
if (isset($_GET['ProductID'])) {
    $ProductID = $_GET['ProductID'];
}
?>  
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Change Price - Admin Panel</title>
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/AdminStyleSheets.css" />
    <style>
        section {
            margin: 30px;
            margin-top: 10px;
            padding: 10px;
            height: 250px;
            background-color: rgb(171, 223, 117);
            width: 800px;
            float: left;
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
            margin-top: 10px;
            margin-left: 10px;
        }

        input {
            height: 32px;
            font-size: 20px;
        }

        .inline {
            display: inline;
            text-align: center;
        }

        .sheaders {
            margin-bottom: 0px;
        }

        #button:hover,#post:hover {
            background-color: #1fe600;
        }

        #location {
            padding-bottom: 2em;
        }

        footer {
            margin-top: 40px;
            clear: left;
        }

        img {
            float: right;
            margin-top: 20px;
            margin-right: 20px;
        }
        
        #commentbox {
            height: 270px;
            background-color: rgb(171, 223, 117);
            margin-left:880px;
            margin-top: 10px;
            margin-right: 30px;
        }

        textarea {
            margin: 25px;
            margin-top: 20px;
            margin-bottom: 15px;
            resize: none;
        }

        #comments {
            padding-top: 20px;
        }

        #post {
            border: 0;
            line-height: 1.65;
            padding: 0 15px;
            font-size: 1rem;
            text-align: center;
            text-decoration: none;
            color: #090909;
            border-radius: 10px;
            background-color: rgb(255, 246, 246);
        }

        #productcomments {
            padding: 10px;
            margin: 5px 5px 5px 65px;
            width: 200px;
            background-color: rgb(171, 223, 117);
            /* margin: 30px;
            padding: 20px; */
            display: inline-block;
        }

        #BacktoSearch {
            display: block;
            margin-left: 15px;
            margin-top: 100px;
            margin-bottom: 20px;
            border: 0;
            line-height: 1.65;
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
                            echo "<img src='".$row['Photo']."' width=200px height=200px>";
                            echo "<h2>Name: ".$row['ProductName']."</h2>";
                            echo "<h2 id='location'>Store Location: ".$row['Location']."</h2>";
                            echo "<h2>Current Price: $".$previousrow['Price']."</h2>";
                            break;
                        }
                        $previousrow = $row;
                    }
        ?>
    <h2 class="sheaders">Update Price: </h2>
    <input type="number" step=".01" class="inline" placeholder="New Price">
    <Button id="button" >Save Changes</Button>
    </section>
    
    <div id="commentbox">
        <h2 id="comments">Tell us what you think?</h2>
        <textarea id="usercomment" rows="8" cols="40" placeholder="Add a comment!"></textarea>
        <Button id="post">Post</Button>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {

            $("#post").click(function() {
                var newcomment = $("#usercomment").val();
                var ProductId = "<?php echo $ProductID; ?>";
                $.post("php/createpost.php", { Comment: newcomment , UserId: UserId, ProductId: ProductId}, function() {
                    alert("Comment added.");
                });
            });

            $("#button").click(function() {
                var newprice = $(".inline").val();
                var ProductId = "<?php echo $ProductID; ?>";
                $.post("php/changeprice.php", {ProductId: ProductId, Price: newprice}, function(response) {
                    alert(response);
                });
            });

            });
        </script>
    </div>
        <?php 
        $sql = "SELECT * FROM comments JOIN users on comments.UserID = users.UserID WHERE ProductId = '$ProductID'";
        $results = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_assoc($results)) {
            echo "<div id='productcomments'>".$row['Comment']."<br> - ".$row['Username']."</div>";
        }
        mysqli_free_result($results);
        mysqli_close($connection);
        ?>
    <button id="BacktoSearch" class="post" onclick="location.href='adminPostResult.php'">Back to Results</button>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>