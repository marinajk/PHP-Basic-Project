<?php define('HOST','localhost');
define('USERNAME', 'root');
define('PASSWORD','goa2020');
define('DB','NewDB');

$conn = mysqli_connect(HOST,USERNAME,PASSWORD,DB);

if(mysqli_connect_errno())
{
    echo "Failed to connect to MySQL".mysqli_connect();
}
?>