<?php
require("db.php");
session_start();

if(isset($_POST['submit'])){
    
    $email=$_POST['emailid'];
    $pass=$_POST['password'];

}
$msg='';
if(filter_has_var(INPUT_POST,'submit'))
{
    $email=$_POST['emailid'];
    $pass=$_POST['password'];
  

    if(!empty($email) && !empty($pass) )
    {
    if(filter_var($email, FILTER_VALIDATE_EMAIL)=== false)
        {
            $msg="Please use a valid E-mail ID";
        }
        
        else 
        {
        $query="select * from Registration where eid='$email' and pwd='$pass'";
        $result=mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
            if($count==1)
            {
                $msg="Login Successful";
                header("location:home.php");
            }
            else
            {
                $msg="Invalid Email ID or Password";
        
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style1.css">

</head>
<body>
<a href="index.php"><input type="button" class=" sub login" value="Register"></a>
<?php if($msg!=''): ?>
<div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
<div class="midbox">
   
   <h1>Login form</h1>
<div>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" >
<div>

<input type="text" placeholder="Email ID" name="emailid" class="tb">
<br>
<br>
<input type="password" placeholder="Password" name="password" class="tb">
<br>

<br>
<input type="submit" class="sub" name="submit" value="Submit">

</div>
</form>
</div>
</div>
</body>
</html>