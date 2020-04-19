<html lang="en">

<?php
$db_hostname = 'localhost';
$db_database = 'messageboard';
$db_username = 'root';
$db_password = '';
$link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
if (mysqli_connect_errno()) die("Unable to connect to MySQL: " . mysqli_connect_error());


session_start(); 
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
<?php
if (isset($_GET['id'])) { 
    $id = $_GET['id']; 
    // $_POST = array();
    $query =  "DELETE FROM messages WHERE messageId='$id'";
    
    $result = mysqli_query($link,$query); 
    
    // mysqli_free_result($result);
  
    echo "<h1>Message Deleted!</h1><br>";     
    echo "<a href='messageboard.php'>Link back to message board </a> " ; 

  } 
  mysqli_close($link);
  ?>
</html>