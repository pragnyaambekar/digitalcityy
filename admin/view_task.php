<?php 
$con = mysqli_connect("localhost","root","","task") or die(mysqli_error($con));
session_start();

include '../include/cheader.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Document</title>
  <style>
    button,h3{
    margin-top:30px;
    }
    a:hover{
      text-decoration:none;
    }
  </style>
</head>
<body>
  <center>
<div class="pie">
<div class="today">
<?php 
$employee_id = $_GET['employee_id'];
$_SESSION['employee_id'] = $employee_id;
$datee = date('Y-m-d');
$query = "select * from work where date='$datee' and employee_id='$employee_id'";

$result=mysqli_query($con,$query) or die(mysqli_error($con));

if(!mysqli_num_rows($result)){
    echo"<center><p>There are no tasks<p><center>";
}
else{
     
  //For Break 
  $query = "SELECT * FROM work WHERE employee_id='$employee_id' and date='$datee' and type='Break' ";
  $result = mysqli_query($con,$query) or die(mysqli_error($con));
  $row =  mysqli_num_rows($result);
  $br1 = 0;
  foreach($result as $r){
      $br1+=$r['time_taken'];
  }
  //For Meeting 
  $query1 = "SELECT * FROM work WHERE employee_id='$employee_id' and date = '$datee' and type='Meeting' ";
  $result1 = mysqli_query($con,$query1) or die(mysqli_error($con));
  $row1 =  mysqli_num_rows($result1);
  $me = 0;
  foreach($result1 as $r1){
      $me+=$r1['time_taken'];
  }
  //For Work
  $query2 = "SELECT * FROM work WHERE employee_id='$employee_id' and date='$datee' and type='Work' ";
  $result2 = mysqli_query($con,$query2) or die(mysqli_error($con));
  $row2 =  mysqli_num_rows($result2);
  $wo = 0;
  foreach($result2 as $r2){
      $wo+=$r2['time_taken'];
  }
  $type = array('Break','Meeting','Work');
  $time_taken = array($br1,$me,$wo);
}

?>



<div style="width: 400px;">
<button class="btn btn-success"><a style="color:black;" href="yesterdaya.php?employee_id=<?php echo $_SESSION['employee_id'];?>">Yesterday's Tasks</a></button>
<button class="btn btn-success"><a href="span.php" style="color:black;"  >Check the tasks for other days</a> </button>
    <?php echo "<h3>Task for today (". date('Y-m-d').")</h3>"?>
  <canvas id="myChart"></canvas>
</div>
 
<script>
  // === include 'setup' then 'config' above ===
  const labels = <?php echo json_encode($type) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Time spent on tasks',
      data: <?php echo json_encode($time_taken) ?>,
      backgroundColor: [
        'red',
        'orange',
        'green'
        
      ],
      backgroundColor: [
        '#570530',
        '#ECB365',
        '#A13333'
        
      ],
      borderWidth: 1
    }]
  };

  const config = {
  type: 'pie',
  data: data,
};

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
</div>

</center>
</body>

