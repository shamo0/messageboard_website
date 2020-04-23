<?php
include('dbConnectionInfo.php');

// Connect to server and select databse.
$link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database) or die("cannot connect"); 

// username and password sent from the form 


// To protect MySQL injection (more detail about MySQL injection)


$sql=$link->prepare("SELECT * FROM users WHERE username=? and passwd=?");
$sql->bind_param("ss", $username, $hashed_password);

$username= htmlspecialchars($_POST['username']); 
$password= htmlspecialchars($_POST['password']); 
$hashed_password = sha1($password);

$sql->execute();

// $result=mysqli_query($link,$sql->execute());
// echo $result;
//PREPARE chklgn FROM 'SELECT accesslevel FROM access WHERE logon=? AND password=?';
//SET @l ="admin";
//SET @p = "workharder";
//EXECUTE chklgn USING @l, @p;
// $sql = "PREPARE chklgn FROM \"SELECT * FROM users WHERE username='?' and passwd='?'\"; SET @l ='$username'; SET @p='$hashed_password';EXECUTE chklgn USING @l,@p;";
// $result=mysqli_query($link,$sql);
// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $username and $password, table row must be 1 row
if($count==1){
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    if (empty($_SESSION['token'])) {
        $length = 32;
        $_SESSION['token'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length); 
    } 
    header("Location: http://localhost:8080/part2/messageboard.php");
    
}
else {
    echo "<script>alert('You have entered an invalid username or password. Try again!'); </script>";
    //echo "<script>setTimeout(\"location.href = 'http://localhost:8080/part2/index.html';\",10000);</script>";
}
?>
