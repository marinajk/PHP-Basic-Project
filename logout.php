if(isset($_POST['submit'])){
    if(session_destroy()) {
    header("Location: login.php");
 }
}