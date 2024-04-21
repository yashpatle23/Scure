<?php
$conn = mysqli_connect('localhost','root','','scure') or die('connection failed');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Appointments</title>
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
  <style type="text/css">
    table {
      border: 1px solid #ddd;
      border-collapse: collapse;
      margin: 0 auto;
      text-align: center;
    }
    th, td {
      padding: 8px 12px;
    }
    th {
      background-color: #33d9b2;
      color: #fff;
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


<?php
$conn = mysqli_connect('localhost', 'root', '', 'scure') or die('connection failed');

if(isset($_GET['id'])){
  $id = mysqli_real_escape_string($conn, $_GET['id']);
  $delete_query = mysqli_query($conn, "DELETE FROM `appointment` WHERE `email` = '$id'") or die(mysqli_error($conn));

  if($delete_query){
    header('location: info.php');
  }else{
    $message[] = 'Failed to delete appointment';
  }
}

$query = mysqli_query($conn, "SELECT * FROM `appointment`");
$appointments = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (mysqli_num_rows($query) > 0) {
  echo '<table>';
  echo '<tr><th>Name</th><th>Number</th><th>Email</th><th>Reason</th><th>Date</th><th>Time</th><th>Action</th></tr>';
  foreach ($appointments as $appointment) {
    echo '<tr>';
    echo '<td>' . $appointment['name'] . '</td>';
    echo '<td>' . $appointment['number'] . '</td>';
    echo '<td>' . $appointment['email'] . '</td>';
    echo '<td>' . $appointment['reason'] . '</td>';
    echo '<td>' . $appointment['date'] . '</td>';
    echo '<td>' . $appointment['time'] . '</td>';
    echo '<td><a href="info.php?id=' . $appointment['email'] . '">Delete</a></td>';
    echo '</tr>';
  }
  echo '</table>';
} else {
  echo 'No appointments found.';
}

mysqli_close($conn);
?>
</body>
</html>
