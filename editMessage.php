<html lang="en">

<?php
//Establish connection with the database
$db_hostname = 'localhost';
$db_database = 'messageboard';
$db_username = 'root';
$db_password = '';
$link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
if (mysqli_connect_errno()) die("Unable to connect to MySQL: " . mysqli_connect_error());

session_start(); 
//Check if logged in. If not logged in redirect to login page (index.html)
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { 
  echo "<h1> Welcome to the member's only messageboard, " . $_SESSION['username'] . "<br>Feel free to enter a message or edit an old one! </h1>"; 
}
else { 
  echo "<h1> You must login/register to see this page. Redirecting ...  "; 
  sleep(.5);
  header("Location: http://localhost:8080/Project/index.html");
}
?>
<head>
  <meta charset="utf-8">
  <title>messageBoard</title>
  <meta name="index" content="The HTML5 Herald">
  <meta name="Geno" content="SitePoint">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<!-- Form for inputing a new message -->
<form name="messageboard" method="post">
  <label for="message"> Enter your NEW message: 
  <input type="text" required name="newMess" placeholder="Hello There!"> 
  </label><br>
  <input type="hidden" name="timeadded" value="<?php date_default_timezone_set('UTC'); echo date('l jS \of F Y h:i:s A');?>">
  <input type="submit" value="Send message!"> 
<?php

if (isset($_GET['id']) && isset($_POST['newMess'])) { 
    $id = $_GET['id']; 
    $newMess = $_POST['newMess'];
    $query =  "UPDATE messages SET messageVal='$newMess' WHERE messageId='$id'";
    $result = mysqli_query($link,$query); 
    //Output the appropriate message
    echo "<h1>Message Updated!</h1><br>";     
    echo "<a href='messageboard.php'>Link back to message board </a> " ; 
  } 
  //Close the connection
  mysqli_close($link);
  ?>
</html>