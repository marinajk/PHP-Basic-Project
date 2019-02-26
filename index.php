<?php
require("db.php");
session_start();




if(isset($_POST['submit'])){
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];
    $mobile=$_POST['mobilenumber'];
    $email=$_POST['emailid'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];

    $_SESSION['firstname'] = $first;
    $_SESSION['lastname'] = $last;
    $_SESSION['mobilenumber'] = $mobile;
    $_SESSION['emailid'] = $email;
    $_SESSION['password'] = $pass;
}
$msg='';

if(filter_has_var(INPUT_POST,'submit'))
{
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];
    $mobile=$_POST['mobilenumber'];
    $email=$_POST['emailid'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];

    if(!empty($first) && !empty($last) && !empty($mobile)&& !empty($email) && !empty($pass) && !empty($cpass) )
    {
        
    if(!preg_match("/^[a-zA-Z ]*$/",$first))
    {
        $msg= "First Name is NOT valid";
    }
    
     else if(!preg_match("/^[a-zA-Z ]*$/",$last))
    {
        $msg= "Last Name is NOT valid";
    }
   
    else if(filter_var($mobile,FILTER_VALIDATE_INT) === false && !preg_match("/^\d{10}$/",$mobile) && strlen($mobile)>10 || strlen($mobile)<10 )
    {
        $msg= "Mobile Number is NOT valid";
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
     $query="insert into Registration(fn,ln,mobno,eid,pwd) values('$first','$last','$mobile','$email','$pass')";

        if(mysqli_query($conn, $query))
        {
            $msg="Registered Successfully";
            header("location:home.php");
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
<link rel="stylesheet" href="index.css ">
</head>
<body>
   <a href="login.php"><input type="button" class=" sub login" value="Login"></a>

<?php if($msg!=''): ?>
<div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
<div class="midbox">
   
<h1>Registration form</h1>
<div>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" >
<div>
<input type="text" placeholder="First Name" name="firstname" class="tb">
<br>
<br>
<input type="text" placeholder="Last Name" name="lastname" class="tb">
<br>
<br>
<input type="text" placeholder="Mobile Number" name="mobilenumber" class="tb" >
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
<input type="submit" class="sub" name="submit" value="Submit">

</div>
</form>
</div>
</div>
</body>
</html>