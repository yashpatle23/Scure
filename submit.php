<?php
// Create connection to MySQL database
$conn = mysqli_connect("localhost", "root", "", "scure");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = mysqli_real_escape_string($conn, $_POST["name"]);

    // Get data from database for specified patient
    $sql = "SELECT * FROM patient_data WHERE name='$name'";
    $result = mysqli_query($conn, $sql);

    // Initialize arrays for chart data
    $labels = [];
    $oxygen_data = [];
    $bp_data = [];
    $temperature_data = [];

    // Loop through database data and add to chart arrays
    while ($row = mysqli_fetch_assoc($result)) {
        $labels[] = $row["name"];
        $oxygen_data[] = $row["oxygen"];
        $bp_data[] = $row["bp"];
        $temperature_data[] = $row["temperature"];
    }

    // Get appointment data for specified patient
    $sql = "SELECT * FROM appointment WHERE name='$name'";
    $result = mysqli_query($conn, $sql);

    // Initialize variables for appointment data
    $appointment_name = "";
    $appointment_number = "";
    $appointment_email = "";
    $appointment_reason = "";
    $appointment_date = "";
    $appointment_time = "";

} else {
    // Get data from database for all patients
    $sql = "SELECT * FROM patient_data";
    $result = mysqli_query($conn, $sql);

    // Initialize arrays for chart data
    $labels = [];
    $oxygen_data = [];
    $bp_data = [];
    $temperature_data = [];

    // Loop through database data and add to chart arrays
    while ($row = mysqli_fetch_assoc($result)) {
        $labels[] = $row["name"];
        $oxygen_data[] = $row["oxygen"];
        $bp_data[] = $row["bp"];
        $temperature_data[] = $row["temperature"];
    }
}
// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Patient Data</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
        }

        .half {
            width: 50%;
            padding: 10px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
<header class="header">

<a href="#" class="logo"> <i class="fas fa-heartbeat"></i> <strong>SC</strong>ure </a>

<nav class="navbar">
<a href="index.php">home</a>
    <a href="about.html">about</a>
    <div class="dropdown">
   <a class="services" href="#services">services</a>

    <div class="dropdown-content">
<a href="healthcheck.html">Health CheckUp</a>
<a href="skin_cancer_js.html">SkinCancer Prediction</a>
<a href="health_info.php">Health Status</a>
  </div>
  </div>
    <a href="doctors.html">doctors</a>
    <!-- <a href="#appointment">appointment</a> -->
    <div class="dropdown">
   <a class="services" href="#services">Records</a>
    <div class="dropdown-content">
<a href="info.php">Appointments</a>
<a href="submit.php">Health Records</a>
  </div>
  </div>

    <a href="blogs.html">blogs</a>
</nav>

<div id="menu-btn" class="fas fa-bars"></div>

</header>
    <h1>Patient Data</h1>
    <form method="post">
        <label for="name">Patient Name:</label>
        <input type="text" name="name" required>
        <button type="submit">Search</button>
    </form>
    <div class="container">
        <div class="half">
            <div style="display:flex; flex-direction:column; width:100%">
    <?php
    // Display appointment data if it exists
    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Appointment Information</h2>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p>Name: " . $row["name"] . "</p>";
            echo "<p>Number: " . $row["number"] . "</p>";
            echo "<p>Email: " . $row["email"] . "</p>";
            echo "<p>Reason: " . $row["reason"] . "</p>";
            echo "<p>Date: " . $row["date"] . "</p>";
            echo "<p>Time: " . $row["time"] . "</p>";
            echo "<hr>";
        }
    }
    ?>
     </div>
     </div>
     </div>
    <div class="container">
        <div class="half">
            <div style="display:flex; flex-direction:column; width:100%">
                <h2>Medical Data</h2>
                <canvas id="myChart"></canvas>
            </div>
</body>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [], // Will be filled with database data
            datasets: [{
                label: 'Oxygen Level',
                data: [], // Will be filled with database data
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }, {
                label: 'Blood Pressure',
                data: [], // Will be filled with database data
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Temperature',
                data: [], // Will be filled with database data
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<script>
    // Set chart data from PHP arrays
    myChart.data.labels = <?php echo json_encode($labels); ?>;
    myChart.data.datasets[0].data = <?php echo json_encode($oxygen_data); ?>;
    myChart.data.datasets[1].data = <?php echo json_encode($bp_data); ?>;
    myChart.data.datasets[2].data = <?php echo json_encode($temperature_data); ?>;
    myChart.update();
</script>

</html>