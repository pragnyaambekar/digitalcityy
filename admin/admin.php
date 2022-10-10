
<?php include '../include/cheader.php';
$con = mysqli_connect("localhost","root","","task") or die(mysqli_error($con));
session_start();?>
<?php
$db= $con;
$tableName="employee";
$columns= ['id', 'name','email','phone','dept', 'joining','view'];
$fetchData = fetch_data($db, $tableName, $columns);

function fetch_data($db, $tableName, $columns){
 if(empty($db)){
  $msg= "Database connection error";
 }elseif (empty($columns) || !is_array($columns)) {
  $msg="columns Name must be defined in an indexed array";
 }elseif(empty($tableName)){
   $msg= "Table Name is empty";
}else{

$columnName = implode(", ", $columns);
$query = "SELECT ".$columnName." FROM $tableName"." ";
$result = $db->query($query);

if($result== true){ 
 if ($result->num_rows > 0) {
    $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
    $msg= $row;
 } else {
    $msg= "No Data Found"; 
 }
}else{
  $msg= mysqli_error($db);
}
}
return $msg;
}
?>
<html>
    <head>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
        <center><a href="add.php"><button>Add Employee +</button></a><br><br><br>
        <h4>List of Employees and their details</h4><br>


        <table class="table" border="3">
       <thead><tr><th>Id</th>
         <th>Name</th>
         <th>Email</th>
         <th>Mobile Number</th>
         <th>Dept</th>
         <th>Date of joining</th>
         <th>View</th>
    </thead>
    <tbody>
  <?php
      if(is_array($fetchData)){      
      $sn=1;
      foreach($fetchData as $data){
    ?>
    <tr>
        <td><?php echo $data['id'];?></td>
        <td><?php echo $data['name'];?></td>
        <td><?php echo $data['email'];?></td>
        <td><?php echo $data['phone'];?></td>
        <td><?php echo $data['dept'];?></td>
        <td><?php echo $data['joining'];?></td>
        <td><a href="view_task.php?employee_id=<?php echo $data['id'];?>" style="color:black">View Task</a></td>  
     </tr>
     <?php
      $sn++;}}else{ ?>
      <tr>
        <td colspan="8">
    <?php echo $fetchData; ?>
  </td>
    <tr>
    <?php
    }?>
    </tbody>
     </table>
    </body>
</html>




</center>
