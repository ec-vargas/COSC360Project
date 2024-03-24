<?php
$ProductID;
if (isset ($_GET['ProductID'])) {
    $ProductID = $_GET['ProductID'];
}
?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Change Price - Admin Panel</title>
    <link rel="stylesheet" href="css/reset.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href=" css/style.css" />
</head>

<body>
    <div class="container-fluid-2">
        <div class="row align-items-center">
            <div class="col">
                <h1><a href="home.html">GroceryPricer.ca</a></h1>
            </div>
            <div class="col text-end">
                <button id="home" class="adminButton" onclick="location.href='adminOptions.html'">
                    <span>Admin Home</span>
                </button>
            </div>
        </div>
        <hr>
    </div>

    <div class="col-6 mx-auto">
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
            if ($error != null) {
                $output = "<p>Unable to connect to database!</p>";
                exit ($output);
            } else {
                //and fetch results
                $sql = "SELECT * FROM products 
            JOIN productstores on products.productID = productStores.productID 
            JOIN stores on productstores.StoreID = stores.StoreID
            JOIN prices on products.productID = prices.productID";
            }

            $previousrow;
            $results = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_assoc($results)) {
                if ($row['ProductID'] === $ProductID && strtotime($row['PriceDate']) > strtotime(date("Y/m/d"))) {
                    echo "<h2>Name: " . $row['ProductName'] . "</h2>";
                    echo "<h2 id='location'>Store Location: " . $row['Location'] . "</h2>";
                    echo "<h2>Current Price: " . $previousrow['Price'] . "</h2>";
                    break;
                }
                $previousrow = $row;
            }
            ?>
            <h2 class="sheaders">Update Price: </h2>
            <input type="number" step=".01" class="inline" placeholder="New Price">
            <Button id="button">Save Changes</Button>
        </section>

        <div id="commentbox">
            <h2 id="comments">Tell us what you think?</h2>
            <textarea id="usercomment" rows="8" cols="40" placeholder="Add a comment!"></textarea>
            <Button id="post">Post</Button>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $(document).ready(function () {

                    $("#post").click(function () {
                        var newcomment = $("#usercomment").val();
                        var ProductId = "<?php echo $ProductID; ?>";
                        $.post("php/createpost.php", { Comment: newcomment, UserId: UserId, ProductId: ProductId }, function () {
                            alert("Comment added.");
                        });
                    });

                    $("#button").click(function () {
                        var newprice = $(".inline").val();
                        var ProductId = "<?php echo $ProductID; ?>";
                        $.post("php/changeprice.php", { ProductId: ProductId, Price: newprice }, function (response) {
                            alert(response);
                        });
                    });

                });
            </script>
        </div>
        <?php
        $sql = "SELECT * FROM comments JOIN users on comments.UserID = users.UserID WHERE ProductId = '$ProductID'";
        $results = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_assoc($results)) {
            echo "<div id='productcomments'>" . $row['Comment'] . "<br> - " . $row['Username'] . "</div>";
        }
        mysqli_free_result($results);
        mysqli_close($connection);
        ?>
        <button id="BacktoSearch" class="post" onclick="location.href='adminPostResult.php'">Back to Results</button>
        <hr>
    </div>

    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>