<?php
// setting up the connection with database
include('dbConnectionInfo.php');
$link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
//Get username,name,password from the form post request
$userName = htmlspecialchars($_POST['username']);
$name =  htmlspecialchars($_POST['name']); 
$password =  htmlspecialchars($_POST['password']);
$hashed_password = sha1($password);
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