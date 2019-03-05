<?php
require("db.php");
session_start();
$msg='';

if(isset($_POST['submit']))
{
    $man=$_POST['man'];
    $emp=$_POST['emp'];
   
            if(isset($_POST['man']))
            {
                $query="select * from Registration where fn='$man'";
            $result=mysqli_query($conn, $query);
            $count = mysqli_num_rows($result);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $mid=$row['uid'];
            }
                
            if(isset($_POST['emp']))
            {
                $query="select * from Registration where fn='$emp'";
            $result=mysqli_query($conn, $query);
            $count = mysqli_num_rows($result);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $eid=$row['uid'];
            }
            
    if(filter_has_var(INPUT_POST,'submit'))
    {
    $query="update registration set mid='$mid' where uid='$eid'";

    $result=mysqli_query($conn, $query);

            if($result)
            {
                $msg="Assigned ".$emp." to ".$man ;
            }
            else
            $msg="Not assigned";
    }
}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Assign</title>
    <link rel="stylesheet" href="adduser.css">
</head>
<body>
<?php if($msg!=''): ?>
<div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
<div class="midbox">
   
<h1>Assign Employees to Managers
</h1>
<div>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" >
<div>
<h3 class="me">Manager</h3>
    <select name="man" class="space">
    <option value="0">-----</option>
        <?php
        $query="select uid,fn from registration where ut='Manager'";
        $result=mysqli_query($conn, $query);
        while($row=mysqli_fetch_array($result))
        {
            echo "<option value=".$row['fn'].">".$row['fn']." </option>";
            
        }

        ?>
        </select>
    <br>
    <br>

<h3 class="me">Employee</h3>
    <select name="emp" class="space">
    <option value="0">-----</option>
        <?php
        $query="select uid,fn from registration where ut='Employee'";
        $result=mysqli_query($conn, $query);
        while($row=mysqli_fetch_array($result))
        {
            echo "<option value=".$row['fn'].">".$row['fn']." </option>";
        
        }
        ?>
        </select>

<br>
<br>
    <input type="submit" name="submit" value="Assign" class="sub">
    </div>
</form>
</div>
</div>

</body>
</html>