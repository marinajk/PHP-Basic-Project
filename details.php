<?php
require("db.php");
session_start();
echo '<script language="javascript">';
echo 'alert("Login successful")'; 
echo '</script>';
if(isset($_POST['submit'])){
    
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];
    $mobile=$_POST['mobilenumber'];
    $_SESSION['firstname'] = $first;
    $_SESSION['lastname'] = $last;
    $_SESSION['mobilenumber'] = $mobile;

}

$msg='';
if(filter_has_var(INPUT_POST,'submit'))
{
   
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];
    $mobile=$_POST['mobilenumber'];
    
    $email=  $_SESSION['emailid'] ;
 
    if(!empty($first) && !empty($last) && !empty($mobile))
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
    else{
        try{
            $query="update Registration set fn='$first',ln='$last',mobno='$mobile',filled='Filled' where id='$email'";
            
            $result=mysqli_query($conn, $query);
            $query="select * from registration where id='$email'";
            $result=mysqli_query($conn, $query);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

          
                if($result)
                {
                    $_SESSION['usertype']=$row['ut'];

                    
                    $utype=$_SESSION['usertype'];
                    $msg=$utype."Account Details Updated";
                   
                    
                    $_SESSION['firstname'] = $first;
                    $_SESSION['lastname'] = $last;
                    $_SESSION['mobilenumber'] = $mobile;

                    if($utype=="Admin")
                    {
                    header("Location:ahome.php");
                    }
                    else if($utype=="Manager")
                    {
                        header("Location:mhome.php");
                    }
                    else if($utype=="Employee")
                    {
                        header("Location:ehome.php");
                    }
                
                }
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        
        }    
    }
}
    else
    {
        $msg="Please fill in all the fields";
    }
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Update Account Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="login.css">

</head>
<body>
    

<?php if($msg!=''): ?>
<div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
    <div class="midbox">
    
    <h1>Update Account Details</h1>
    <div>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" >
        <div>

        <input type="text" placeholder="First Name" name="firstname" class="tb">
        <br>
        <br>
        <input type="text" placeholder="Last Name" name="lastname" class="tb">
        <br>

        <br>
        <input type="text" placeholder="Mobile Number" name="mobilenumber" class="tb">
        <br>
        <input type="submit" class="sub" name="submit" value="Submit">
        <br>
       
        </div>
        </form>
    </div>
    </div>
</body>
</html>