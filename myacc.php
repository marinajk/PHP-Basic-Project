<?php
require("db.php");
session_start();
$email=$_SESSION['emailid'];
$msg='';
if(isset($_POST['update']))
{
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];
    $mobile=$_POST['mobilenumber'];
    $id=$_POST['emailid'];
    $hidden=$_POST['hidden'];

    if(filter_has_var(INPUT_POST,'update'))
    {
    $query="update registration set fn='$first',ln='$last',mobno='$mobile',id='$id', filled='Filled' where uid='$hidden'";

    $result=mysqli_query($conn, $query);

if($result)
{
    $msg="Updated account details";
}
else
$msg="Not updated";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Account</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
<?php if($msg!=''): ?>
<div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
<div class="midbox1">
    Account Details
    <br>
    <br>
<?php

$query="select uid,fn,ln,mobno,id from registration where id='$email'";
$result=mysqli_query($conn, $query);
$count = mysqli_num_rows($result);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
if($count==1)
{

echo "<form action=myacc.php method=post>";


echo "<input type=text class=tb name=firstname value=".$row['fn']."><br>";
echo "<input type=text class=tb name=lastname value=".$row['ln']."><br>";
echo "<input type=text class=tb name=mobilenumber value=".$row['mobno']."><br>";
echo "<input type=text class=tb name=emailid value=".$row['id']."><br>";
echo "<input type=hidden name=hidden value=".$row['uid']."><br>";
echo "<input type=submit class=sub name=update value=Update><br>";

echo "</form>";
}?>
</div>
</body>
</html>