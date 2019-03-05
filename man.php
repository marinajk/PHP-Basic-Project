<?php
require("db.php");
session_start();


$msg='';

if(isset($_POST['delete']))
{
    $hidden=$_POST['hidden'];
    if(filter_has_var(INPUT_POST,'delete'))
    {
$query="delete from registration where uid='$hidden'";

$result=mysqli_query($conn, $query);

if($result)
{
header("refresh:1;url=man.php");
$msg="Deleted";
}
else
 $msg="Not deleted";
    }
}


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
    $msg="Updated ".$first;
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
    <title>Managers</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

<h3>List of Managers</h3>
<br>
<br>

<table>
    <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Mobile Number</th>
    <th>Email ID</th>
    </tr>
   <?php
   
$query="select uid,fn,ln,mobno,id from registration where ut='Manager'";
$result=mysqli_query($conn, $query);
if($result-> num_rows>0)
{
while($row=mysqli_fetch_array($result))
{
    echo "<form action=man.php method=post>";

    echo "<tr>";
    echo "<td>"."<input type=text name=firstname value=".$row['fn']."> </td>";
    echo "<td>"."<input type=text name=lastname value=".$row['ln']."> </td>";
    echo "<td>"."<input type=text name=mobilenumber value=".$row['mobno']."> </td>";
    echo "<td>"."<input type=text name=emailid value=".$row['id']."> </td>";
    echo "<td>"."<input type=hidden name=hidden value=".$row['uid']."> </td>";
    echo "<td>"."<input type=submit class=sub name=update value=Update></td>";
    echo "<td>"."<input type=submit class=sub name=delete value=Delete></td>";
    echo "</form>";
}

echo "</table>";

}
else{
    $msg="No Managers";
}
    ?>
    <?php if($msg!=''): ?>
<div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
</body>
</html>