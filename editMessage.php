<html lang="en">

<?php
//Establish connection with the database
$db_hostname = 'localhost';
$db_database = 'messageboard';
$db_username = 'root';
$db_password = '';
$link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
if (mysqli_connect_errno()) die("Unable to connect to MySQL: " . mysqli_connect_error());
//Start the session.
session_start(); 
//check if thee user is logged in. if not redirect to login page(index.html)
if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin']) != true)  { 
  echo "<h1> You must login/register to see this page. Redirecting ...  "; 
  sleep(.5);
  header("Location: http://localhost:8080/part2/index.html");
}
?>
<head>
  <meta charset="utf-8" http-equiv="Content-Security-Policy" content="default-src 'self'; child-src 'none';">
  <title>messageBoard</title>
  <meta name="index" content="The HTML5 Herald">
  <meta name="editMessage" content="SitePoint">
  <link rel="stylesheet" href="styless.css">
</head>
<body>

</head>
<body>
   <div class = nav_back>
      <topnav>
            <ul>
              <!-- Nav bar -->
              <li><a href="messageboard.php">Return to Chat</a></li>
              <li><a class="active" href="messageboard.php">Edits</a></li>
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
    <!-- hidden field for passing the session token -->
  <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>"/> 
  <input type="hidden" name="timeadded" value="<?php date_default_timezone_set('UTC'); echo date('l jS \of F Y h:i:s A');?>">
  <input class= "button" type="submit" value="Send message!"> 
</form> 

<?php
//Check if the if the id is set in the get request and the message is set in the post request
//Also for CSRF check if the session token is the same as the token from the form.
if ((isset($_GET['id']) && isset($_POST['mess'])) && ($_SESSION['token']==$_POST['token'])) {
    $id = $_GET['id'];
    $newMess = htmlspecialchars($_POST['mess']);
    if (strlen($newMess) > 60) {
      //check if the message is too long.
      echo "<script>alert('You have entered a message too big. Try again!'); </script>";
      echo "<script>setTimeout(\"location.href = 'http://localhost:8080/part2/messageboard.php';\",10);</script>";
    }
    else {
      //Prepare statement for sql query
      $sql = $link->prepare("UPDATE messages SET messageVal=? WHERE messageId=?");
      $sql -> bind_param("ss",$newMess, $id);
      $sql->execute();
  
      //Output the appropriate message
      echo "<h2>Message Updated!</h2><br>";
      echo "<br> <br> <br> ";
      //Admin redirect
      if ($_SESSION['username'] == 'admin') { 
        echo "<div class = 'link2'><a href='http://localhost:8080/part2/admin/messageboardAdmin.php'>Link back to your message board </a></div> " ;
      }
      else {  //user redirect
        echo "<div class = 'link2'><a href='messageboard.php'>Link back to message board </a></div> " ;
      } 
    }
  }
  //Close the connection
  mysqli_close($link);
  ?>
</html>