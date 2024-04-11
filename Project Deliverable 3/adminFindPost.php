<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Find Post - Admin Panel</title>
    <link rel="stylesheet" href="css/reset.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <div class="container-fluid-2">
        <div class="row align-items-center">
            <div class="col">
                <?php
                    session_start();
                    if (isset($_SESSION['AdminUsername'])) {
                        echo "<h1>GroceryPricer.ca</h1>";
                    } else {
                        echo "<h1><a href='home.html'>GroceryPricer.ca</a></h1>";
                    }
                ?>
            </div>
            <div class="col text-end">
                <button style="margin-right: 2%;">
                    <?php if (isset($_SESSION['AdminUsername'])) {
                        echo $_SESSION['AdminUsername'];
                    }?>
                </button>
                <button id="home" class="adminButton" onclick="location.href='adminOptions.php'">
                    <span>Admin Home</span>
                </button>
            </div>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="adminOptions.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Find Post</li>
            </ol>
        </nav>
        <hr>
    </div>
    <h2 id="secondarytitle">Find Posts</h2>
    <hr>

    <div class="col-8 mx-auto">
        <form id="date-range-form" method="POST" action="adminPostResult.php">
            <section>
                <h2>Words</h2>
                <div class="search-form-container">
                    <input type="text" id="contains" name="contains" placeholder="Contains:" autocomplete="off"><br>
                    <input type="text" id="does-not-contain" name="does-not-contain" placeholder="Does Not Contain:"
                        autocomplete="off"><br>
                </div>
            </section>

            <section>
                <h2>People</h2>
                <div class="search-form-container">
                    <input type="text" id="Email" name="Email" placeholder="Email Address" autocomplete="off"><br>
                    <input type="text" id="username" name="username" placeholder="Username:" autocomplete="off"><br>
                </div>
            </section>

            <section>
                <h2>Date Range:</h2>
                <div class="search-form-container">
                    <label for="category">Start</label><br>
                    <input type="date" id="start" name="start" placeholder="Start:" autocomplete="off"><br>
                    <label for="category">End</label><br>
                    <input type="date" id="end" name="end" placeholder="End:" autocomplete="off"><br>
                    <br>
                    <button id="search-button" type="submit">Search</button>
                </div>
            </section>
        </form>
    </div>
    <!-- Display comments count per day here -->
    <div id="comments-container" class="container">
        <canvas id="commentsChart"></canvas>
    </div>
    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function () {
            // Function to fetch and display comments count per day
            function fetchComments() {
                $.ajax({
                    url: 'php/fetchallcomments.php', // Update the URL
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // Prepare data for Chart.js
                        var labels = Object.keys(data);
                        var counts = Object.values(data);

                        // Generate line chart
                        var ctx = document.getElementById('commentsChart').getContext('2d');
                        var commentsChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Comments per Day',
                                    data: counts,
                                    fill: false,
                                    borderColor: 'rgb(75, 192, 192)',
                                    tension: 0.1
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
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            // Call the fetchComments function initially
            fetchComments();
        });
    </script>
</body>

</html>
