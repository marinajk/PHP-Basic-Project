<?php

require("db.php");
session_start();

$email=$_SESSION['emailid'];
$pass=$_SESSION['password'];
$msg='';
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
    <title>Admin Home Page</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
<a href="login.php"><input type="submit" name="submit" class="sub login " value="Logout" ></a>
<a href="emp.php"><input type="button" name="emp" class="sub emp" value="Employees" ></a>
<a href="man.php"><input type="button" name="man" class="sub man" value="Managers" ></a>
<a href="adduser.php"><input type="button" name="adduser" value="Add User" class="sub addd"></a>
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
<br>
<h4>List of Admins</h4>
<br>
<br>
<table class="table1">
    <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Mobile Number</th>
    <th>Email ID</th>
    </tr>
   <?php
   
$query="select fn,ln,mobno,id from registration where ut='Admin'";
$result=mysqli_query($conn, $query);


if($result-> num_rows>0)
{
    while($row = $result-> fetch_assoc())
    {
        echo "<tr><td>".$row['fn']."</td><td>".$row['ln']."</td><td>".$row['mobno']."</td><td>".$row['id']."</td></tr>";

    }
echo "</table>";
}
else{
    $msg="No admin";
}?>
<?php if($msg!=''): ?>
<div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
    
</body>
</html>