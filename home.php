<?php 
require("db.php");
session_start();

$email=$_SESSION['emailid'];
$query="select * from Registration where eid='$email'";

$result=mysqli_query($conn, $query) ;
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);


$_SESSION['firstname']=$row['fn'];
$_SESSION['lastname']=$row['ln'];
$_SESSION['mobilenumber']=$row['mobno'];
$_SESSION['emailid']=$row['eid'];




if(isset($_POST['submit']))
{
    session_unset();
    session_destroy();
   
}
    

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="home.css">
    <script src="main.js"></script>
</head>
<body>
  
<a href="login.php"><input type="submit" name="submit" class="sub login " value="Logout" >


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