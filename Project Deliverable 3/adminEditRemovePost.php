<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Edit Post - Admin Panel</title>
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/AdminStyleSheets.css" />
    <style>

        h1,
        h2,
        section,
        input {
            margin-left: 20px;
            margin-right: 20px;
        }

        input {
            width: 800px;
            height: 200px;
            display: block;
        }

        .post {
            margin-top: 10px;
        }


        .post {
            border: 0;
            margin-left: 20px;
            line-height: 1.65;
            padding: 0 20px;
            font-size: 1rem;
            text-align: center;
            text-decoration: none;
            color: #090909;
            border-radius: 10px;
            background-color: rgb(255, 246, 246);
            ;
            /* display each button on a new line */
        }

        .post:hover {
            background-color: #1fe600;
        }

        textarea {
            width: 50%;
            height: 200px;
            margin-left: 20px;
        }

        footer {
            position:absolute;
            bottom:0;
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


    <h2>Edit Post</h2>
    <?php
        $comment;
        if (isset($_GET["Comment"])) {
            $comment = $_GET["Comment"];
        }
        $UserId;
        if (isset($_GET["UserId"])) {
            $UserId = $_GET["UserId"];
        }
        echo "<textarea id='comments'>".$comment."</textarea>";
        echo "<script>var UserId = " . json_encode($UserId) . ";</script>";
        
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

        $("#savechanges").click(function() {
            var newcomment = $("#comments").val();
            $.post("changePost.php", { Comment: newcomment , UserId: UserId}, function() {
                alert("Comment changed.");
            });
        });

        $("#removepost").click(function() {
            $.post("removePost.php", {UserId: UserId}, function() {
                alert("Comment removed.");
            });
        });
    });
    </script>
    <button id="savechanges" class="post">Save Changes</button>
    <button id="removepost" class="post">Remove Post</button>
    <button id="BacktoSearch" class="post" onclick="location.href='adminPostResult.php'">Back to Results</button>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>