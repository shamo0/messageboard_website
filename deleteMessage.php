<html lang="en">
<?php
//Establish sql database connection
$db_hostname = 'localhost';
$db_database = 'messageboard';
$db_username = 'root';
$db_password = '';
$link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
if (mysqli_connect_errno()) die("Unable to connect to MySQL: " . mysqli_connect_error());

//Check if already in session. if not redirect to index.html
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
<?php
//Gets the id of specified message to be deleted
if (isset($_GET['id'])) { 
    $id = $_GET['id']; 
    // Deletes the message from the sql database
    $query =  "DELETE FROM messages WHERE messageId='$id'";
    $result = mysqli_query($link,$query); 
    //Print the appropriate message
    echo "<h1>Message Deleted!</h1><br>";  
    //admin redirect   
    if ($_SESSION['username'] == 'admin') { 
      echo "<a href='http://localhost:8080/part2/admin/messageboardAdmin.php'>Link back to your message board </a> " ;
    }
    else { //user redirect
      echo "<a href='messageboard.php'>Link back to message board </a> " ; 
    } 
  } 
  //Close the connection
  mysqli_close($link);
  ?>
</html>