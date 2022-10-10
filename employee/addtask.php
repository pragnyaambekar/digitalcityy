<?php 
$con = mysqli_connect("localhost","root","","task") or die(mysqli_error($con));
session_start();
if(!isset($_SESSION['name'])){
    header("Location:../index.php");
}
include '../include/cheader.php';
$employee_id = $_SESSION['id'];?>
<html>
    <head>
        <link rel="stylesheet" href="addtask.css">
        <title>Add Task</title>
        
    </head>
    <body>
    <center><h4>Add Task</h4></center>
        <form action="addtask.php" method="post">
            
            <label for="desc">Task Description:</label><br>
            <input type="text" name="desc"><br>
            <label for="type">Task Type:</label>
            <select name="type" id="">
                <option value="">--select--</option>
                <option value="Break">Break</option>
                <option value="Meeting">Meeting</option>
                <option value="Work">Work</option>
            </select><br>
            <label for="time">Start Time:</label><br>
            <input type="time" name="start"><br>
            <label for="work">Time taken:</label><br>
            <input type="number" name="timet"><br>
            <label for="date">Date</label><br>
            <input type="date" id="txtDate" name="date" max="<?php echo date("Y-m-d"); ?>" >
            <center><button type="submit" name="submit">Add Task</button>
            <button type="submit"><a href="employee.php?employee_id=<?php echo $_SESSION['id'];?>">Back</a></button></center>
        </form>
    </body>
</html>
<?php
if(isset($_POST['submit'])){
    $employee_id = $_SESSION['id'];
    $desc = $_POST['desc'];
    $type = $_POST['type'];
    $start = $_POST['start'];
    $timet = $_POST['timet'];
    $date = $_POST['date'];
    $query = "insert into work (description,type,start_time,time_taken,employee_id,date) values('$desc','$type','$start','$timet','$employee_id','$date')";
    $result = mysqli_query($con,$query) or die(mysqli_error($con));

    

}


?>