<?php
require("db.php");
session_start();

$email=$_SESSION['emailid'];
$pass=$_SESSION['password'];

$query="select * from Registration where id='$email' and pwd='$pass'";
$result=mysqli_query($conn, $query);

$count = mysqli_num_rows($result);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    if($count==1)
    {
        $_SESSION['usertype']=$row['ut'];
        $_SESSION['firstname']=$row['fn'];
        $_SESSION['lastname']=$row['ln'];
        $_SESSION['mobilenumber']=$row['mobno'];
        $_SESSION['filled']=$row['filled'];

    }
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manager Home Page</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
<a href="login.php"><input type="submit" name="submit" class="sub login " value="Logout" >
<a href="myemp.php"><input type="submit" name="submit" class="sub myemp " value="My Employees" ></a>

</a>
<div class="midbox">
   <h1>
    Hi <?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']?>
   <br>
   <br>
   Mobile Number: <?php echo $_SESSION['mobilenumber']?>
    <br>
    Email ID: <?php echo $_SESSION['emailid']?> 
    <br></h1>
    </div>
</div>
</body>
</html>