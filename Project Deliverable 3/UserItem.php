<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product - User Panel</title>
    <link rel="stylesheet" href="css/reset.css" />
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
                    session_start();
                    if (isset($_SESSION['username'])) {
                        echo "<h1>GroceryPricer.ca</h1>";
                    } else {
                        echo "<h1><a href='home.html'>GroceryPricer.ca</a></h1>";
                    }
                ?>
            </div>
            <div class="col">
                <div class="header2">
                    <button style="margin-right: 2%;"><?php echo $_SESSION['username'];?></button>
                    <a href="php/logout.php" style="font-size: 2em;">LogOut&nbsp;</a>
                    <a href="adminLogin.php" style="font-size: 2em;">&nbsp;Admin Login</a>
                </div>
            </div>
        </div>
        <hr>
    </div>

    <div class="col-6 mx-auto">
 
        <section>
            <?php
            require_once "php/dbconnection.php";

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
        </div>

        <form id="find-items-form" method="POST" action="itemResult.php">
            <input type="hidden" name="contains" value="<?php echo $contains; ?>">
            <button id="BacktoSearch" type="submit">Back to Results</button>
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
                    html += '<p>' + comment['Comment'] + '</p>';
                    html += '<p>Posted by: ' + comment['Username'] + '</p>';
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
