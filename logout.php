<?php
if(isset($_POST['submit']))
{
    session_unset();
    session_destroy();
    header("Location: ../login.php");
}
?>