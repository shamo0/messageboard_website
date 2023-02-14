<?php
// setting up the connection with database
include('dbConnectionInfo.php');
$link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
//Get username,name,password from the form post request

$userName = htmlspecialchars($_POST['username']);
//Check for valid input in php (javascript duplicate)
$uppercase = preg_match('@[A-Z]@', $userName);
$lowercase = preg_match('@[a-z]@', $userName);
$number    = preg_match('@[0-9]@', $userName);

if(!$uppercase || !$lowercase || !$number || strlen($userName) < 1 || strlen($userName) >15) {
echo "<script>alert('Username does not meet the requiremnts. Try again!'); </script>";
echo "<script>setTimeout(\"location.href = 'http://localhost:8080/part2/index.html';\",1000);</script>";
}
$name =  htmlspecialchars($_POST['name']); 
//Check for valid input in php (javascript duplicate)
$uppercase = preg_match('@[A-Z]@', $name);
$lowercase = preg_match('@[a-z]@', $name);
$number    = preg_match('@[0-9]@', $name);

if(!$uppercase || !$lowercase || !$number || strlen($name) < 1 || strlen($userName) >15) {
    echo "<script>alert('Name does not meet the requiremnts. Try again!'); </script>";
    echo "<script>setTimeout(\"location.href = 'http://localhost:8080/part2/index.html';\",1000);</script>";
}
$password =  htmlspecialchars($_POST['password']);
//Check for valid input in php (javascript duplicate)
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);

if(!$uppercase || !$lowercase || !$number || strlen($password) < 6 || strlen($userName) >25) {
    echo "<script>alert('Password does not meet the requirements. Try again!'); </script>";
    echo "<script>setTimeout(\"location.href = 'http://localhost:8080/part2/index.html';\",1000);</script>";
}
$hashed_password = sha256($password);
//sql prepare the query and then execute.
$sql=$link->prepare("SELECT username FROM users WHERE username=?");
$sql ->bind_param("s", $username);
$sql ->execute();
$result = $sql->get_result();

if ($result->num_rows == 0) {
    //Inserting into the database 
    $query = "INSERT INTO users (username,names, roles,passwd) VALUES ('$userName', '$name', 0, '$hashed_password')";
    $data = mysqli_query($link,$query);
    //Registration completed. redirect back to index.html
    if($data)
    {
        echo "YOUR REGISTRATION IS COMPLETED...";
        header("Location: http://localhost:8080/part2/index.html");
    }
    else
    {
        echo "Unknown Error, Try Again!"; 
    }
} //If username already aready exists display appropriate message.
else { 
    echo "<h1>Username Already Exists! Please try again.</h1>";
    echo "<a href='index.html'>Link back to the signup page</a> " ; 
}
?>