<?php session_start();?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title> Edit Post - Admin </title>
    <link rel="stylesheet" href="css/style.css" />

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

        .textarea {
            display: flex;
        }

        .post {
            border: 0;
            margin-left: 20px;
            line-height: 1.65;
            padding: 10px 20px;
            font-size: 1rem;
            text-align: center;
            text-decoration: none;
            color: #090909;
            border-radius: 10px;
            background-color: rgb(255, 246, 246);
            ;
        }

        .post:hover {
            background-color: #1fe600;
        }

        textarea {
            width: 50%;
            height: 200px;
            margin-left: 20px;
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
    <div class="container-fluid-2">
        <div class="row align-items-center">
            <div class="col">
                <?php
                    if (isset($_SESSION['AdminUsername'])) {echo "<h1>GroceryPricer.ca</h1>";}
                    else {echo "<h1><a href='home.html'>GroceryPricer.ca</a></h1>";}
                ?>
            </div>
            <div class="col text-end">
            <button style="margin-right: 2%;"><?php if (isset($_SESSION['AdminUsername'])) {echo $_SESSION['AdminUsername'];}?></button>
                <button id="home" class="adminButton" onclick="location.href='adminOptions.php'">
                    <span>Admin Home</span>
                </button>
            </div>
        </div>
        <hr>
    </div>

    <div class="col-8 mx-auto" style="background-color: rgba(245, 245, 220, 0.5);">
        <h2 style="text-align: center;">Edit Post</h2>
        <?php
        require_once "php/dbconnection.php";
        $comment;
        if (isset ($_GET["Comment"])) {
            $comment = $_GET["Comment"];
        }
        $CommentID;
        if (isset ($_GET["CommentID"])) {
            $CommentID = $_GET["CommentID"];
        }
        echo "<div style='text-align: center;'><textarea id='comments'>" . $comment . "</textarea></div>";
        echo "<script>var CommentID = " . json_encode($CommentID) . ";</script>";

        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function () {

                $("#savechanges").click(function () {
                    var newcomment = $("#comments").val();
                    $.post("php/changePost.php", { Comment: newcomment, CommentID: CommentID }, function (response) {
                        if (response.length == 0) {alert("Post Changed.");}
                        else {alert("Error saving post.");}
                    });
                });

                $("#removepost").click(function () {
                    $.post("php/removePost.php", { CommentID: CommentID }, function (response) {
                        if (response.length == 0) {alert("Post Removed.");}
                        else {alert("Error removing post.");}
                    });
                });
            });
        </script>
        <div style="display: flex; justify-content: center; margin-bottom: 10px;">
            <button id="savechanges" class="post" style="margin-right: 10px;">Save Changes</button>
            <button id="removepost" class="post" style="margin-left: 10px;">Remove Post</button>
        </div>
        <div style="text-align: center;">
            <button id="BacktoSearch" class="post" onclick="location.href='adminPostResult.php'"
                style="margin-top: 5px; display: block; margin-left: auto; margin-right: auto;">Back to Results</button>
        </div>
    </div>

    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>