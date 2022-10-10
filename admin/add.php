<?php include '../include/header.php' ?>
<html>
    <head>
        <link rel="stylesheet" href="add.css">
        <title>Add Employee</title>
        <style>
            body {
    background-color: #D8B9C3;
}
            </style>
    </head>
    <body>
        <center><h1 style="margin:20px">Enter the Employee details</h1></center>
        <div class="form">
        <form action="add.php" method="post">
            <label for="name">Name:</label><br>
            <input type="text" name="name" placeholder="Enter the Name"><br>
            <label for="email">Email-id:</label><br>
            <input type="email" name="email" placeholder="Enter the Email-id"><br>
            <label for="phone">Contact Number:</label><br>
            <input type="number" name="phone" placeholder="Enter the Phone Number"><br>
            <label for="dept">Department:</label><br>
            <input type="text" name="dept" placeholder="Enter the Department"><br>
            <label for="name">Password:</label><br>
            <input type="password" name="pwd" placeholder="Enter the Password"><br>
            <label for="date">Joining Date:</label><br>
            <input type="date" name="date" max = "<?php echo date('Y-m-d+1'); ?>" placeholder="Enter the Joining Date"><br>
            <div class="button">
                <button type="submit" name="submit">Add</button>
                <button><a href="../admin/admin.php ">Back</a></button>
            </div>
        </form>
        </div>
    </body>
</html>
<?php 
$con = mysqli_connect("localhost","root","","task") or die(mysqli_error($con));
if(isset($_POST["submit"])){
$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$dept = $_POST["dept"];
$pwd = md5($_POST["pwd"]);
$joining = $_POST["date"];
$query = "select * from employee where email = '$email'";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result)>0){
    echo "Email-id already exists";
}
else{
    $query1 = "insert into employee (name,email,phone,dept,password,joining) values('$name','$email','$phone','$dept','$pwd','$joining')";
    $result = mysqli_query($con,$query1) or die(mysqli_error($con));
}
}
?>