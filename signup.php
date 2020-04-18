<?php
include('dbConnectionInfo.php');

$link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
// $db=mysql_select_db(messageboard,$link) or die("Failed to connect to MySQL: " . mysql_error());

$userName = $_POST['username'];
$name = $_POST['name']; 
$password =  $_POST['password'];
$query = mysqli_query($link, "SELECT username FROM users WHERE username='".$userName."'");
if (mysqli_num_rows($query) == 0) {   

    $query = "INSERT INTO users (username,names, passwd) VALUES ('$userName', '$name', '$password')";
    $data = mysqli_query($link,$query);
    if($data)
    {
        echo "YOUR REGISTRATION IS COMPLETED...";
        header("Location: http://localhost/Project/index.html");
    }
    else
    {
        echo "Unknown Error, Try Again!"; 
    }
} 
else { 
    echo "Username Already Exists! Try again."; 
}
?>