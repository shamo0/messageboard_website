<?php
include('dbConnectionInfo.php');
$link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
//Get username,name,password from the form post request
$userName = $_POST['username'];
$name = $_POST['name']; 
$password =  $_POST['password'];
$hashed_password = sha1($password);
//SQL query for getting username
// $userGet = $dbh->prepare("SELECT username from users where  username = ?");
// mysqli_query($link, "PREPARE chklgn FROM 'SELECT accesslevel FROM access WHERE logon=? AND password=?'");
// $userGet->execute($userName);
// EXECUTE chklgn USING @l, @p;
// $query = mysqli_query($link, $userGet);

$query = mysqli_query($link, "SELECT username FROM users WHERE username='".$userName."'");
if (mysqli_num_rows($query) == 0) {   
    $query = "INSERT INTO users (username,names, roles,passwd) VALUES ('$userName', '$name', 0, '$hashed_password')";
    $data = mysqli_query($link,$query);
    if($data)
    {
        echo "YOUR REGISTRATION IS COMPLETED...";
        header("Location: http://localhost:8080/part2/index.html");
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