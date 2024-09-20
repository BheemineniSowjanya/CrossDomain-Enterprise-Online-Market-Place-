<?php
$dbservername = "localhost";
$dbusername = "u994453189_MarketSphere";
$dbpassword = "Momdad$143";
$dbName = "u994453189_MarketSphere";

$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbName);

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    //you need to exit the script, if there is an error
    exit();
}
?>