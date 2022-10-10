<?php
$con = mysqli_connect("localhost","root","","task") or die(mysqli_error($con));
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark " style="background-color:#1C0C5B" >
        <a class="navbar-brand " href="index.php">
            
        DigitalCity
        </a>
        <!--Toggler
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="nav justify-content-end">
                <li class="nav-item">
                  <a class="nav-link active" href="#">Active</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled">Disabled</a>
                </li>
              </ul>
        </div>-->

    </nav>
    <div class="first">
        <div class="admin">
            <h1>Admin</h1>
            <form action="index.php" method="post">
                <label for="name">Username:</label><br>
                <input type="text"required name="aname" id="name" placeholder="Enter the username"><br>
                <label for="password">Password:</label><br>
                <input type="password" name="apwd" required id="pwd" placeholder="Enter the password"><br>
                <center><button type="submit"  name = "asubmit">Login</button></center>
            </form>
        </div>
        <div class="employee">
            <h1>Employee</h1>
            <form action="index.php" method="post">
                <label for="name">Email-id:</label><br>
                <input type="email" name="email" id="email" required placeholder="Enter the email"><br>
                <label for="password">Password:</label><br>
                <input type="password" name="epwd" id="epwd" required placeholder="Enter the password"><br>
                <center><button type="submit" name = "esubmit">Login</button></center>
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>
<?php
if(isset($_POST['asubmit'])){
    $aname = $_POST['aname'];
    $apwd = $_POST['apwd'];
    if($aname=="pragnya" && $apwd=="pragnya"){
        header("Location:admin/admin.php");
    }
    else{
        echo "<center><h3 style='background-color:white; width:50%;margin-top:20px;border-radius:5px;padding:20px'>Please check your username and password.</h3></center>" ;
    }
}
else if(isset($_POST['esubmit'])){
    $email = $_POST['email'];
    $epwd = md5($_POST['epwd']);
    $query = "select * from employee where email='$email' and password='$epwd'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $name_query = "select id,name,phone from employee where email='$email'";
    $name_result = mysqli_query($con,$name_query);
    $name_fetch = mysqli_fetch_array($name_result) or die(mysqli_error($con));
    
   
    if(mysqli_num_rows($result)){
        
        $_SESSION['id'] = $name_fetch['id'];
        $_SESSION['name'] = $name_fetch['name'];
        header("Location:employee/employee.php");
    }
    else{
        echo "<center><h3 style='background-color:white; width:50%;margin-top:20px;border-radius:5px;padding:20px'>Please check your username and password.</h3></center>" ;
    }
}


?>