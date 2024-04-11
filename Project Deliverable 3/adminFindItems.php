<?php
// Database connection
require_once "php/dbconnection.php";
session_start();

// Function to fetch item count per category
function getItemCountPerCategory($connection) {
    $sql = "SELECT c.CategoryName, COUNT(p.ProductID) AS ItemCount 
            FROM categories c 
            LEFT JOIN products p ON c.CategoryID = p.CategoryID 
            GROUP BY c.CategoryID";
    $result = mysqli_query($connection, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[$row['CategoryName']] = $row['ItemCount'];
    }
    return $data;
}

// Fetching item count per category
$itemData = getItemCountPerCategory($connection);
?>

<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Item Categories - Admin Panel</title>
    <link rel="stylesheet" href="css/reset.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <button style="margin-right: 2%;"><?php echo $_SESSION['AdminUsername'];?></button>
                <button id="home" class="adminButton" onclick="location.href='adminOptions.php'">
                    <span>Admin Home</span>
                </button>
            </div>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="adminOptions.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Item Categories</li>
            </ol>
        </nav>
        <hr>
    </div>
    <div class="col-8 mx-auto">
        <form id="find-items-form" method="POST" action="adminItemResult.php">
            <section>
                <h2>Find Items</h2>
                <div class="search-form-container">
                    <input type="text" id="contains" name="contains" placeholder="Enter keyword to search"
                        autocomplete="off"><br>
                    <input type="text" id="does-not-contain" name="does-not-contain"
                        placeholder="Enter keyword to exclude" autocomplete="off"><br>
                </div>
            </section>

            <section>
                <h2>Filter by Category</h2>
                <div class="search-form-container">
                    <input type="text" id="category" name="category" placeholder="Enter tags" autocomplete="off"><br>
                </div>
            </section>

            <section>
                <h2>Filter by Store</h2>
                <div class="search-form-container">
                    <input type="text" id="store-name" name="store-name" placeholder="Enter store name"
                        autocomplete="off"><br>
                    <button id="search-button" type="submit">Search</button>
                </div>
            </section>
        </form>
    </div>

    <!-- Chart container -->
    <div class="col-8 mx-auto" style="margin-top: 50px;">
        <h2>Items per Category</h2>
        <canvas id="itemChart" width="400" height="200"></canvas>
    </div>

    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Data for items per category
            var itemData = <?php echo json_encode($itemData); ?>;

            // Generate random colors for each category
            var categoryColors = [];
            for (var i = 0; i < Object.keys(itemData).length; i++) {
                var color = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',0.5)';
                categoryColors.push(color);
            }

            // Chart.js configuration
            var ctx = document.getElementById('itemChart').getContext('2d');
            var itemChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(itemData),
                    datasets: [{
                        label: 'Number of Items',
                        data: Object.values(itemData),
                        backgroundColor: categoryColors,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>
