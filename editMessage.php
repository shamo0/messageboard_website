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
if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin']) != true)  { 
  echo "<h1> You must login/register to see this page. Redirecting ...  "; 
  sleep(.5);
  header("Location: http://localhost:8080/part2/index.html");
}
?>
<head>
  <meta charset="utf-8">
  <title>messageBoard</title>
  <meta name="index" content="The HTML5 Herald">
  <meta name="Geno" content="SitePoint">
  <link rel="stylesheet" href="styless.css">
</head>
<body>

</head>
<body>
   <div class = nav_back>
      <topnav>
            <ul>
              <li><a href="messageboard.php">Return to Chat</a></li>
              <li><a class="active" href="messageboard.php">Edits</a></li>
              <li><a href="mailto: m216060@usna.edu?subject= help needed">Contact</a></li>
              <li><a onclick="logout()" >Log out</a></li>
            </ul>
        </topnav>
    </div>

<!-- Form for inputing a new message -->
  <div class="forms_div20">
    <h3> Enter your NEW message: </h3>
  <form name="messageboard" method="post" onsubmit="messageEscape()">
      <label for="message">
        <div class= "inputText">
      <input type="text" required name="mess" placeholder="Hello There!" maxlength="60"> 
      </div>
    </label>
  <input type="hidden" name="timeadded" value="<?php date_default_timezone_set('UTC'); echo date('l jS \of F Y h:i:s A');?>">
  <input class= "button" type="submit" value="Send message!"> 
</form> 

<?php

if (isset($_GET['id']) && isset($_POST['mess'])) { 
    $id = $_GET['id']; 
    $newMess = $_POST['mess'];
    $query =  "UPDATE messages SET messageVal='$newMess' WHERE messageId='$id'";
    $result = mysqli_query($link,$query); 
    //Output the appropriate message
    echo "<h2>Message Updated!</h2><br>";   
    echo "<br> <br> <br> ";  
  } 
  //Close the connection
  mysqli_close($link);
  ?>
</html>