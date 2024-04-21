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
    $age = mysqli_real_escape_string($conn, $_POST["age"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $oxygen = mysqli_real_escape_string($conn, $_POST["oxygen"]);
    $bp = mysqli_real_escape_string($conn, $_POST["bp"]);
    $temperature = mysqli_real_escape_string($conn, $_POST["temperature"]);
    $other_info = mysqli_real_escape_string($conn, $_POST["other_info"]);

    // Insert form data into database
    $sql = "INSERT INTO patient_data (name, age, gender, oxygen, bp, temperature, other_info) VALUES ('$name', '$age', '$gender', '$oxygen', '$bp', '$temperature', '$other_info')";

    if (mysqli_query($conn, $sql)) {
        echo "Data added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
		body {
			font-family: Arial, sans-serif;
		}
		h1 {
			text-align: center;
		}
		form {
			max-width: 500px;
			margin: 0 auto;
			text-align: center;
		}
		label {
			display: block;
			margin-bottom: 10px;
		}
		input[type="text"], textarea, select {
			width: 100%;
			padding: 5px;
			margin-bottom: 10px;
			border-radius: 5px;
			border: 1px solid #ccc;
		}
		button[type="submit"] {
			background-color: #4CAF50;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
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
	<form action="index.php" method="post">
		<label for="name">Name:</label>
		<input type="text" name="name" id="name" required>

		<label for="age">Age:</label>
		<input type="text" name="age" id="age" required>

		<label for="gender">Gender:</label>
		<select name="gender" id="gender" required>
			<option value="">Select Gender</option>
			<option value="male">Male</option>
			<option value="female">Female</option>
			<option value="other">Other</option>
		</select>

		<label for="oxygen">Oxygen Level:</label>
		<input type="text" name="oxygen" id="oxygen" required>

		<label for="bp">Blood Pressure:</label>
		<input type="text" name="bp" id="bp" required>

		<label for="temperature">Temperature:</label>
		<input type="text" name="temperature" id="temperature" required>

		<label for="other_info">Other Information:</label>
		<textarea name="other_info" id="other_info"></textarea>

		<button type="submit">Submit</button>
	</form>

	<canvas id="myChart"></canvas>
        
    </body>
    </html>