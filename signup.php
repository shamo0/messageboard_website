<?php
include('dbConnectionInfo.php');
$link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
//Get username,name,password from the form post request
$userName = htmlspecialchars($_POST['username']);
$name =  htmlspecialchars($_POST['name']); 
$password =  htmlspecialchars($_POST['password']);
$hashed_password = sha1($password);
//SQL query for getting username
// $userGet = $dbh->prepare("SELECT username from users where  username = ?");
// $userGet->execute($userName);
// mysqli_query($link, "PREPARE chklgn FROM 'SELECT username FROM users WHERE username=?");
// EXECUTE chklgn USING @l, @p;
// $query = mysqli_query($link, $userGet);
$sql=$link->prepare("SELECT username FROM users WHERE username=?");
$sql ->bind_param("s", $username);
$sql ->execute();
$result = $sql->get_result();
//commented out
// $query = mysqli_query($link, "SELECT username FROM users WHERE username='".$userName."'");
// if (mysqli_num_rows($query) == 0) {
if ($result->num_rows == 0) {
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