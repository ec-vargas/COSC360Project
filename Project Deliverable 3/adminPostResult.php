<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Find User - Admin Panel</title>
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/AdminStyleSheets.css" />
    <style>
        h1,
        h2,
        button {
            margin-left: 20px;
        }

        #button {
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
        }

        #button:hover {
            background-color: #1fe600;
        }

        div {
            padding: 10px;
            margin: auto;
            margin-bottom: 10px;
            background-color: rgb(171, 223, 117);
            width: 50%;
            display: block;
            height: 160px;
        }

        img {
            display: inline;
            float: left;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <button id="home" class="homebutton" onclick="location.href='adminOptions.html'"><span>Admin Home</span></button>
    <h1>GroceryPricer.ca</h1>
    <hr id="tophr">

    <?php
<<<<<<< HEAD
        $contains;
        $doesnotcontain;
        $category;
        $email;
        $username;
        $start;
        $end;
        if (isset($_POST["contains"])) {
            $contains = $_POST["contains"];
        }
        if (empty($_POST["contains"])) {
            echo "<h2>Results for Advanced Search ''</h2>";
        } else {
            echo "<h2>Results for Advanced Search '".$contains."'</h2>";
        }
        
        echo "<Button id ='button' onclick=\"location.href='adminFindPost.html'\">Back to Search</Button>";
        if (isset($_POST["does-not-contain"])) {
            $doesnotcontain = $_POST["does-not-contain"];
        }
        if (isset($_POST["tags"])) {
            $category = $_POST["tags"];
        }
        if (isset($_POST["Email"])) {
            $email = $_POST["Email"];
        }
        if (isset($_POST["username"])) {
            $lastname = $_POST["username"];
        }
        if (isset($_POST["start"])) {
            $start = $_POST["start"];
        }
        if (isset($_POST["end"])) {
            $end = $_POST["end"];
        }
        $host = "localhost";
        $database = "cosc360";
        $user = "83066985";
        $password = "83066985";
=======
    $contains;
    $doesnotcontain;
    $category;
    $email;
    $firstname;
    $lastname;
    $start;
    $end;
    if (isset ($_POST["contains"])) {
        $contains = $_POST["contains"];
    }
    if (empty ($_POST["contains"])) {
        echo "<h2>Results for Advanced Search ''</h2>";
    } else {
        echo "<h2>Results for Advanced Search '" . $contains . "'</h2>";
    }
>>>>>>> 394221b678ef2584a9b9c5dfa3cfb3f8b5ef7527

    echo "<Button id ='button' onclick=\"location.href='adminFindPost.html'\">Back to Search</Button>";
    if (isset ($_POST["does-not-contain"])) {
        $doesnotcontain = $_POST["does-not-contain"];
    }
    if (isset ($_POST["tags"])) {
        $category = $_POST["tags"];
    }
    if (isset ($_POST["Email"])) {
        $email = $_POST["Email"];
    }
    if (isset ($_POST["firstname"])) {
        $firstname = $_POST["firstname"];
    }
    if (isset ($_POST["lastname"])) {
        $lastname = $_POST["lastname"];
    }
    if (isset ($_POST["start"])) {
        $start = $_POST["start"];
    }
    if (isset ($_POST["end"])) {
        $end = $_POST["end"];
    }
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
        $sql = "SELECT * FROM users JOIN comments on users.UserID = comments.UserID;";

        $results = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_assoc($results)) {
            if (!empty ($_POST["contains"])) {
                if (!(strpos(strtoupper($row['Comment']), strtoupper($contains)) !== false)) {
                    continue;
                }
<<<<<<< HEAD
                if (!empty($_POST["doesnotcontain"])) {
                    if (strpos(strtoupper($row['Comment']), strtoupper($doesnotcontain)) !== false) {continue;}
                }
                if (!empty($_POST["username"])) {
                    if (!(strpos(strtoupper($row['Username']), strtoupper($lastname)) !== false)) {continue;}
                }
                if (!empty($_POST["Email"])) {
                    if (!(strpos(strtoupper($row['email']), strtoupper($email)) !== false)) {continue;}
                }
                if (!empty($_POST["tags"])) {
                    if (!(strpos(strtoupper($row['tags']), strtoupper($category)) !== false)) {continue;}
                }
                if (!empty($_POST["start"])) {
                    if (strtotime($row['commentDate']) < strtotime($start)) {continue;}
                }
                if (!empty($_POST["end"])) {
                    if (strtotime($row['commentDate']) > strtotime($end)) {continue;}
                }
                echo "<div>Username: <a href='adminEditRemovePost.php?Comment=".$row['Comment']."&UserId=".$row['UserID']."'>".$row['Username']."</a><br>ProductId: ".$row['ProductID']."<br>";
                echo "Comment: ".$row['Comment']."<br><br>";
                echo "Comment Date: ".$row['CommentDate']."</div>";
=======
>>>>>>> 394221b678ef2584a9b9c5dfa3cfb3f8b5ef7527
            }
            if (!empty ($_POST["doesnotcontain"])) {
                if (strpos(strtoupper($row['Comment']), strtoupper($doesnotcontain)) !== false) {
                    continue;
                }
            }
            if (!empty ($_POST["firstname"])) {
                if (!(strpos(strtoupper($row['FirstName']), strtoupper($firstname)) !== false)) {
                    continue;
                }
            }
            if (!empty ($_POST["lastname"])) {
                if (!(strpos(strtoupper($row['LastName']), strtoupper($lastname)) !== false)) {
                    continue;
                }
            }
            if (!empty ($_POST["Email"])) {
                if (!(strpos(strtoupper($row['email']), strtoupper($email)) !== false)) {
                    continue;
                }
            }
            if (!empty ($_POST["tags"])) {
                if (!(strpos(strtoupper($row['tags']), strtoupper($category)) !== false)) {
                    continue;
                }
            }
            if (!empty ($_POST["start"])) {
                if (strtotime($row['commentDate']) < strtotime($start)) {
                    continue;
                }
            }
            if (!empty ($_POST["end"])) {
                if (strtotime($row['commentDate']) > strtotime($end)) {
                    continue;
                }
            }
            echo "<div>Username: <a href='adminEditRemovePost.php?Comment=" . $row['Comment'] . "&UserId=" . $row['UserID'] . "'>" . $row['Username'] . "</a><br>ProductId: " . $row['ProductID'] . "<br>";
            echo "Comment: " . $row['Comment'] . "<br><br>";
            echo "Comment Date: " . $row['CommentDate'] . "</div>";
        }

        mysqli_free_result($results);
        mysqli_close($connection);
    } ?>

    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>
</body>

</html>