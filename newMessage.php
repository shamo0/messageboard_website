<html lang="en">

<?php
//Set up the sql connection
$db_hostname = 'localhost';
$db_database = 'messageboard';
$db_username = 'root';
$db_password = '';
$link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
if (mysqli_connect_errno()) die("Unable to connect to MySQL: " . mysqli_connect_error());


session_start(); 
//Check for session. if not active session then redirect to login page.
if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin']) != true) { 
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
  <!-- nav bar -->
   <div class = nav_back>
      <topnav>
            <ul>
              <li><a  href="messageboard.php">Chat</a></li>
              <li><a class="active" href="newMessage.php">Confirmation Page</a></li>
              <li><a href="mailto: m216060@usna.edu?subject= help needed">Contact</a></li>
              <li><a onclick="logout()" >Log out</a></li>
            </ul>
        </topnav>
    </div>

<?php
//Check if there was a new message passed in post request from form.
if (isset($_POST['mess'])) { 
  //check the token value from hidden field.
  if ($_SESSION['token']!=$_POST['token']) {
    echo "INVALID TOKEN ERROR\n"; 
    echo "FROM SESSION: " . $_SESSION['token'] . "\n";
    echo "FROM POST: " . $_POST['token'];
  } 
  else { 
    //if both check ^^ out then insert the new message into the database.
    $message = $_POST['mess']; 
    $time = $_POST['timeadded'];
    $user = $_SESSION['username'];
    $_POST = array();
    $query =  "SELECT id FROM users WHERE username = '$user'";
    $result = mysqli_query($link,$query); 
    if (mysqli_num_rows($result)){
      $row = mysqli_fetch_array($result);
      $id = $row['id'];
      //prepare the sql query and insert the message
      $sql=$link->prepare("INSERT INTO messages (messageVal, timestampVal, id) VALUES (?,?,?)");
      $sql ->bind_param("sss",$message, $time, $id);
    }
    $sql ->execute();
    //Display the appropirate message
    echo "<div class= 'welcome2'><h1>Message Receieved!</h1></div>";     
    echo "<div class='container12' id='id".$message."'>";
            echo "<div class= 'forms_div4'>";
            echo "<div class= 'forms_div4-img'>";
            echo "<img class = 'image' src= 'icon.png'>";
            echo "</div>";
            echo "<div class='userDiv'>";
            echo $user;
            echo "</div>";
            echo "<br>";
            echo "<br>";
            echo "<div class='msgDiv'>";
            echo $message . "<br />";
            echo "</div>";
            echo "<span class='time-right'>" . $time. "</span>";
    //if admin redirect to the admin page
    if ($_SESSION['username'] == 'admin') { 
      echo "<div class = 'link2'><a href='http://localhost:8080/part2/admin/messageboardAdmin.php'>Link back to your message board </a></div> " ;
    }
    else { //if regular user go to regular messageboard.
      echo "<div class = 'link2'><a href='messageboard.php'>Link back to message board </a></div> " ;
    } 

  }
}  
  //closing the connection
  mysqli_close($link);
?>
</body>
</html>