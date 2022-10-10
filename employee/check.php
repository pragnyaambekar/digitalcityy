<?php
 /* $con = mysqli_connect("localhost","root","","task");
  session_start();
  if($con){
    echo "connected";
  }
  
  $employee_id = $_GET['employee_id'];*/

?>
<!--
<html>
  <head>
    
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['students', 'contribution'],-->
         <?php

         /*$sql = "SELECT * FROM work";
         $fire = mysqli_query($con,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['type']."',".$result['time_taken']."],";
          }*/
         ?>
        <!--]);

        var options = {
          title: 'Students and their contribution'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </body>
</html>-->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Document</title>
</head>
<body>

<?php 
  $con = new mysqli('localhost','root','','task');
  session_start();
  $employee_id = $_SESSION['id'];
$datee = date('Y-m-d');
$query = "select * from work where date='$datee' and employee_id='$employee_id'";

$result=mysqli_query($con,$query) or die(mysqli_error($con));
echo mysqli_num_rows($result);
  foreach($result as $data)
  {
    $type[] = $data['type'];
    $time_taken[] = $data['time_taken'];
  }

?>


<div style="width: 500px;">
  <canvas id="myChart"></canvas>
</div>
 
<script>
  // === include 'setup' then 'config' above ===
  const labels = <?php echo json_encode($type) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'My First Dataset',
      data: <?php echo json_encode($time_taken) ?>,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)'
        
      ],
      borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)'
      ],
      borderWidth: 1
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>

</body>
</html>