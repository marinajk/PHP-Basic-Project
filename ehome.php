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
        $_SESSION['uid']=$row['uid'];
        $_SESSION['usertype']=$row['ut'];
        $_SESSION['firstname']=$row['fn'];
        $_SESSION['lastname']=$row['ln'];
        $_SESSION['mobilenumber']=$row['mobno'];
        $_SESSION['filled']=$row['filled'];
        $_SESSION['mid']=$row['mid'];

    }

$mid=$_SESSION['mid'];
    $query="select uid,fn,ln,mobno,id from registration where uid='$mid'";
   $result=mysqli_query($conn, $query);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   
   if($count==1)
   {
       $_SESSION['mid']=$row['uid'];
     
       $_SESSION['mfirstname']=$row['fn'];
       $_SESSION['mlastname']=$row['ln'];
       $_SESSION['mmobilenumber']=$row['mobno'];
        $_SESSION['memailid']=$row['id'];

   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Home Page</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
<a href="login.php"><input type="submit" name="submit" class="sub login " value="Logout" >
<a href="myacc.php"><input type="button" name="myaccount" value="My Account" class="sub myacc"></a>

</a>
<div class="midbox">
   <h1>
    Hi <?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']?>
   <br>
   <br>
   Mobile Number: <?php echo $_SESSION['mobilenumber']?>
    <br>
    Email ID: <?php echo $_SESSION['emailid']?> 

    <br>
    <br>
    My Manager's Details
    <br>
    Name:<?php echo $_SESSION['mfirstname'].' '.$_SESSION['mlastname']?>
    <br>
    Mobile Number: <?php echo $_SESSION['mmobilenumber']?>
    <br>
    Email ID: <?php echo $_SESSION['memailid']?> 
    <br>
</h1>
    </div>
</div>
</body>
</html>