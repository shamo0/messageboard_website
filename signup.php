<?php
include('dbConnectionInfo.php');
$link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
//Get username,name,password from the form post request
$userName = $_POST['username'];
$name = $_POST['name']; 
$password =  $_POST['password'];
//SQL query for getting username
$query = mysqli_query($link, "SELECT username FROM users WHERE username='".$userName."'");
if (mysqli_num_rows($query) == 0) {   
    $query = "INSERT INTO users (username,names, roles,passwd) VALUES ('$userName', '$name', 0, '$password')";
    $data = mysqli_query($link,$query);
    if($data)
    {
        echo "YOUR REGISTRATION IS COMPLETED...";
        header("Location: http://localhost:8080/Project/index.html");
    }
    else
    {
        echo "Unknown Error, Try Again!"; 
    }
} 
else { 
    echo "<h1>Username Already Exists! Please try again.</h1>";
    echo "<a href='index.html'>Link back to the signup page</a> " ; 
}
?>