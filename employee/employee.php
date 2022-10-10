<?php 
$con = mysqli_connect("localhost","root","","task") or die(mysqli_error($con));
session_start();
if(!isset($_SESSION['name'])){
    header("Location:../index.php");
}
include '../include/cheader.php';
?>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Document</title>
  <style>
    button{
    border-radius: 10px;
    border:none;
    padding:20px;
    font-size:15px;
    margin: 20px;
    background-color:#4D4C7D;
    color:white;
  }
  a:hover{
    text-decoration: none;
  }
  </style>
  
</head>
<body>
  <center>
<div class="today">
<?php 
$employee_id = $_SESSION['id'];
$_SESSION['employee_id'] = $employee_id;
$datee = date('Y-m-d');
$querys = "select * from work where date='$datee' and employee_id='$employee_id'";

$results=mysqli_query($con,$querys) or die(mysqli_error($con));
echo "<h1>Hello ".$_SESSION['name']."!</h1>";
if(!mysqli_num_rows($results)){
    echo"<h4>Looks like you've not added any tasks for today<h4>";
}
else{
    echo "<h4>Task for today(". date('Y-m-d').")</h4>";
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


<a href="addtask.php"><button >Add Task</button></a>
<button ><a style="color:white" href="yesterday.php?employee_id=<?php echo $_SESSION['employee_id'];?>">Yesterdays Tasks</a></button>

<div style="width: 400px;">
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
</html>


 
