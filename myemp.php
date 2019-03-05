<?php

require("db.php");
session_start();

$msg='';



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Employees</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
<table>
    <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Mobile Number</th>
    <th>Email ID</th>
    </tr>
   <?php
   $uid=$_SESSION['uid'];
$query="select fn,ln,mobno,id from registration where emp='$uid';
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
    $msg="No Employees";
}?>
<?php if($msg!=''): ?>
<div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
    
</body>
</html>