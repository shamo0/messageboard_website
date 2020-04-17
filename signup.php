<?php
include('dbConnectionInfo.php');

$link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
// $db=mysql_select_db(messageboard,$link) or die("Failed to connect to MySQL: " . mysql_error());

$userName = $_POST['username'];
$password =  $_POST['password'];

$query = "INSERT INTO users (username,passwd) VALUES ('$userName','$password')";
$data = mysqli_query($link,$query);
if($data)
{
echo "YOUR REGISTRATION IS COMPLETED...";
//header("localhost/Project/index.html"); 
}
else
{
echo "Unknown Error!"; 
}
?>