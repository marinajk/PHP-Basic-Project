<?php
require("db.php");
isset($_POST['level']);
$msg='';
if(isset($_POST['submit'])){

    $option = $_POST['level'];
    switch ($option) {
        case 0:
        $ut="none";
         $msg="Please select a valid user type";     
            break;
        case 1:
            $ut="Admin";
            break;
        case 2:
            $ut="Manager";
            break;
       case 3:
       $ut="Employee";
       break;
    } 
}


if(isset($_POST['submit'])){
    
    $email=$_POST['emailid'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];
}


if(filter_has_var(INPUT_POST,'submit'))
{
   
    $email=$_POST['emailid'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];
    

    if( !empty($email) && !empty($pass) && !empty($cpass))
    {
        if($ut=="none")
        {
            $msg="Please select the user type";
        }
        else if(filter_var($email, FILTER_VALIDATE_EMAIL)=== false)
        {
            $msg="Please use a valid E-mail ID";
        }
        else if($pass != $cpass)
        {
            $msg="Passwords don't match";
        }
        else 
        {
            if($ut=="Admin")
            {
                $query="insert into Registration(fn,ln,mobno,id,pwd,ut,filled) values(NULL,NULL,NULL,'$email','$pass','$ut',NULL)";
            }
            else if($ut=="Manager")
            {
            $query="insert into Registration(fn,ln,mobno,id,pwd,ut,filled) values(NULL,NULL,NULL,'$email','$pass','$ut',NULL)";
            }
            else if($ut=="Employee")
            {    
                $query="insert into Registration(fn,ln,mobno,id,pwd,ut,filled) values(NULL,NULL,NULL,'$email','$pass','$ut',NULL)";
            }   
            if(mysqli_query($conn, $query))
            {
                $msg= $ut." added successfully";
            }
        }
    }
    else
    {
        $msg="Please fill in all the fields";
 
    }
}

?>
    
<html>
<head>
<title>Registration</title>
<link rel="stylesheet" href="adduser.css ">
</head>
<body>
   <a href="ahome.php"><input type="button" class=" sub login" value="Back to Home"></a>

<?php if($msg!=''): ?>
<div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
<div class="midbox">
   
<h1>Add user</h1>
<div>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" >
<div>


 
    <select name="level" class="space">
    <option value="0">-----</option>
    <option value="1">Admin</option>
    <option value="2">Manager</option>
    <option value="3">Employee</option>
    </select>
   
    <br>
    <br> 

<input type="text" placeholder="Email ID" name="emailid" class="tb">
<br>
<br>
<input type="password" placeholder="Password" name="password" class="tb">
<br>
<br>
<input type="password" placeholder="Confirm Password" name="cpassword" class="tb">
<br>

<br>
<input type="submit" class="sub" name="submit" value="Create">

</div>
</form>
</div>
</div>
</body>
</html>