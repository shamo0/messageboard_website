<?php
include('dbConnectionInfo.php');
// $host="localhost"; // Host name 
// $username=""; // Mysql username 
// $password=""; // Mysql password 
// $db_name=""; // Database name 
// $tbl_name="members"; // Table name 

// Connect to server and select databse.
$link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database) or die("cannot connect"); 
// mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form 
$username=$_POST['username']; 
$password=$_POST['password']; 
// To protect MySQL injection (more detail about MySQL injection)
$username = stripslashes($username);
$password = stripslashes($password);
// $username = mysqli_real_escape_string($username);
// $password = mysqli_real_escape_string($password);
$sql="SELECT * FROM users WHERE username='$username' and passwd='$password'";
$result=mysqli_query($link,$sql);

// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $username and $password, table row must be 1 row
if($count==1){
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    header("Location: http://localhost:8080/project/messageboard.php");
    
}
else {
    // echo "Failure";
    header("Location: http://localhost:8080/project/index.html");
}
?>