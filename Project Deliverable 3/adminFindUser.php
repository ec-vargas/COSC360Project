<?php
    session_start();
?>

<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>Find User - Admin Panel</title>
    <link rel="stylesheet" href="css/reset.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
    <!-- Add Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Add jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="container-fluid-2">
        <div class="row align-items-center">
            <div class="col">
                <?php
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
                <li class="breadcrumb-item active" aria-current="page">Find User</li>
            </ol>
        </nav>
        <hr>
    </div>
    <h2 id="secondarytitle">Find Users</h2>
    <hr>

    <div class="col-8 mx-auto">
        <form id="find-items-form" method="POST" action="adminUserResult.php">
            <section>
                <h2>Name</h2>
                <div class="search-form-container">
                    <input type="text" id="username" name="username" placeholder="Username:" autocomplete="off"><br>
                </div>
            </section>

            <section>
                <h2>User Information</h2>
                <div class="search-form-container">
                    <input type="text" id="Email" name="Email" placeholder="Email" autocomplete="off"><br>
                </div>
            </section>

            <section>
                <h2>Joined:</h2>
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
    <div class="container">
        <canvas id="userChart"></canvas>
    </div>

    <hr>
    <footer>
        <p><i>Copyright &#169; 2024 Sandhu, Ruan and Vargas </i></p>
    </footer>

 
   
<!-- Chart.js script -->
<script>
    $(document).ready(function () {
        // Function to fetch and display users
        function fetchUsers() {
            $.ajax({
                url: 'php/fetchusers.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    // Generate data for Chart.js
                    var userCounts = {};
                    data.forEach(function(user) {
                        var registrationDate = user.RegistrationDate;
                        if (userCounts[registrationDate]) {
                            userCounts[registrationDate]++;
                        } else {
                            userCounts[registrationDate] = 1;
                        }
                    });

                    var dates = Object.keys(userCounts);
                    var counts = Object.values(userCounts);

                    // Create a bar chart
                    var ctx = document.getElementById('userChart').getContext('2d');
                    var userChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: dates,
                            datasets: [{
                                label: 'Number of Users Registered',
                                data: counts,
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    precision: 0 // Display whole numbers only
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

        // Call the fetchUsers function initially
        fetchUsers();
    });
</script>

</body>

</html>
