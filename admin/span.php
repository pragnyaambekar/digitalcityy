
<?php include '../include/cheader.php';
$con = mysqli_connect("localhost","root","","task") or die(mysqli_error($con));
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Document</title>
  <link rel="stylesheet" href="add.css">
  
</head>
<body>

    
  
    
    <div class="flex">
    <div class="form" style="margin:0px;">
    <form action="span.php" method="post">
        <label for="date">Choose the start date:</label>
        <input type="date" min='1899-01-01' name="start" max = "<?php echo date('Y-m-d');?>"><br>
        <label for="date">Choose the end date:</label>
        <input type="date" min='1899-01-01' name = "end" max = "<?php echo date('Y-m-d');?>"><br>
        <center><a href="span.php"><button name="submit" >Submit</button></a>
        <button name="back" ><a href="view_task.php?employee_id=<?php echo $_SESSION['employee_id'];?>">Back</a></button></center>
    </form>
    </div>
    
    
    
    <div>
<?php 
  if(isset($_POST['submit'])){
    $start = $_POST['start'];
    $end = $_POST['end'];
    
    $employee_id = $_SESSION['employee_id'];
    $name = "select * from employee where id='$employee_id'";
    $name_result = mysqli_query($con,$name);
    $arr = mysqli_fetch_array($name_result);
    echo "<h4>Time spent by ".$arr['name']," From ".$start." to ".$end."</h4>" ;
    //For Break 
    $query = "SELECT * FROM work WHERE employee_id='$employee_id' and date BETWEEN '$start' AND '$end' and type='Break' ";
    $result = mysqli_query($con,$query) or die(mysqli_error($con));
    $row =  mysqli_num_rows($result);
    $br = 0;
    foreach($result as $r){
        $br+=$r['time_taken'];
    }
    //For Meeting 
    $query1 = "SELECT * FROM work WHERE employee_id='$employee_id' and date BETWEEN '$start' AND '$end' and type='Meeting' ";
    $result1 = mysqli_query($con,$query1) or die(mysqli_error($con));
    $row1 =  mysqli_num_rows($result1);
    $me = 0;
    foreach($result1 as $r1){
        $me+=$r1['time_taken'];
    }
    //For Work
    $query2 = "SELECT * FROM work WHERE employee_id='$employee_id' and date BETWEEN '$start' AND '$end' and type='Work' ";
    $result2 = mysqli_query($con,$query2) or die(mysqli_error($con));
    $row2 =  mysqli_num_rows($result2);
    $wo = 0;
    foreach($result2 as $r2){
        $wo+=$r2['time_taken'];
    }
    $type = array('Break','Meeting','Work');
    $time_taken = array($br,$me,$wo);
}

?> 
<center>
<div style="width: 500px;" class="flex">
        <canvas id="myChart"></canvas>
</div>
</div>
<script>
  // === include 'setup' then 'config' above ===
  const labels = <?php echo json_encode($type) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Minutes spent on tasks',
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
  type: 'bar',
  data: data,
};

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
</center>
 
</body>
</html>


