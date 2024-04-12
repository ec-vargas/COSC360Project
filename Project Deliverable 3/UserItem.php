<?php
require_once "php/dbconnection.php";
session_start();
$ProductID;
if (isset ($_GET['ProductID'])) {
    $ProductID = $_GET['ProductID'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product - User Panel</title>
    <link rel="stylesheet" href="css/reset.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        /* CSS for comment styling */
        .comment {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .comment p {
            margin: 5px 0;
        }
        .comment p.date {
            font-size: 0.8em;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container-fluid-2">
        <div class="row align-items-center">
            <div class="col">
                <?php
                    if (isset($_SESSION['username'])) {echo "<h1>GroceryPricer.ca</h1>";}
                    else {echo "<h1><a href='home.html'>GroceryPricer.ca</a></h1>";}
                ?>
            </div>
            <div class="col">
                <div class="header2">
                <img src="data:image/jpeg;base64,<?php echo $_SESSION['profile_photo']?>" alt="User Profile Photo" class="img-thumbnail">
                    <button style="margin-right: 2%;" onclick="location.href='UserAccount.php'"><?php echo $_SESSION['username'];?></button>
                    <a href="php/logout.php" style="font-size: 2em;">LogOut&nbsp;</a>
                    <a href="adminLogin.php" style="font-size: 2em;">&nbsp;Admin Login</a>
                </div>
            </div>
        </div>
        <hr>
    </div>

    <div class="col-6 mx-auto">
        <h2 class="sheaders">Item Details</h2>
        <section>
            <?php
            $ProductID = $_GET['ProductID'];
            $contains = $_GET['Contains'];

            $sql = "SELECT * FROM products 
            JOIN productstores on products.productID = productStores.productID 
            JOIN stores on productstores.StoreID = stores.StoreID
            JOIN prices on products.productID = prices.productID";

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
        </section>

        <div id="commentbox">
            <h2 id="comments">Tell us what you think?</h2>
            <textarea id="usercomment" rows="8" cols="40" placeholder="Add a comment!"></textarea>
            <button id="post">Post</button>
            <div id="commentsContainer">
                <!-- Comments will be displayed here -->
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        </div>
        <!-- <?php
        $sql = "SELECT * FROM comments JOIN users on comments.UserID = users.UserID WHERE ProductId = '$ProductID'";
        $results = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_assoc($results)) {
            echo "<div id='productcomments'>" . $row['Comment'] . "<br> - " . $row['Username'] . "</div>";
        }
        mysqli_free_result($results);
        mysqli_close($connection);
        ?> -->
        <form id="find-items-form" method="POST" action="itemResult.php">
            <input type="hidden" name="contains" value="<?php echo $contains; ?>">
            <button id="BacktoSearch" type="submit onclick="location.href='itemResult.php'">Back to Results</button>
        </form>
        <hr>
    </div>

    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>


    <!-- JavaScript section -->
    <script>
    $(document).ready(function () {
        $("#post").click(function () {
            var newcomment = $("#usercomment").val();
            var ProductId = "<?php echo $ProductID; ?>";
            var Username = "<?php echo $_SESSION['username']; ?>";
            $.post("php/createpost.php", { Comment: newcomment, Username: Username, ProductId: ProductId }, function (response) {
                if (response.length == 0) {
                    alert("Post Created.");
                    fetchComments();
                    $("#usercomment").val(''); // Clear the textarea
                } else {
                    alert("Error creating post.");
                }
            });
        });

        function fetchComments() {
            var ProductId = "<?php echo $ProductID; ?>";
            $.getJSON("php/fetchcomments.php", { ProductId: ProductId }, function (comments) {
                var html = '';
                $.each(comments, function (index, comment) {
                    // Format the date
                    var commentDate = new Date(comment['CommentDate']);
                    var formattedDate = commentDate.toLocaleDateString('en-US', { 
                        year: 'numeric', 
                        month: 'short', 
                        day: 'numeric', 
                        hour: 'numeric', 
                        minute: 'numeric', 
                        second: 'numeric' 
                    });
                    // Construct HTML for comment
                    html += '<div class="comment">';
                    html += '<p>' + comment['Comment'] + '   </p>';
                    html += '<p>Posted by: ' + comment['Username'] + '</p><br>';
                    html += '<p class="date">Date: ' + formattedDate + '</p>';
                    html += '</div>';
                });
                $("#commentsContainer").html(html);
            });
        }

        fetchComments();
    });
</script>

</body>

</html>