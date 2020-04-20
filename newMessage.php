<html lang="en">

<?php
$db_hostname = 'localhost';
$db_database = 'messageboard';
$db_username = 'root';
$db_password = '';
$link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
if (mysqli_connect_errno()) die("Unable to connect to MySQL: " . mysqli_connect_error());


session_start(); 
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) { 
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

  <link rel="stylesheet" href="styless.css">


</head>

<body>

   <div class = nav_back>
      <topnav>
          <!-- <div class="menulist"> -->
            <ul>
              <li><a  href="messageboard.php">Chat</a></li>
              <li><a class="active" href="newMessage.php">Confirmation Page</a></li>
              
              <li><a href="mailto: m216060@usna.edu?subject= help needed">Contact</a></li>
              <li><a onclick="logout()" >Log out</a></li>
            </ul>
          <!-- </div>      -->
        </topnav>
    </div>

<?php
if (isset($_POST['mess'])) { 
    $message = $_POST['mess']; 
    $time = $_POST['timeadded'];
    $user = $_SESSION['username'];
    $_POST = array();
    $query =  "SELECT id FROM users WHERE username = '$user'";
    $result = mysqli_query($link,$query); 
    if (mysqli_num_rows($result)){
      $row = mysqli_fetch_array($result);
      $id = $row['id'];
      $sql = "INSERT INTO messages (messageVal, timestampVal, id) VALUES ('$message', '$time','$id')"; 
    }
    $link->query($sql); 
    mysqli_free_result($result);
  
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
    echo "<div class = 'link2'><a href='messageboard.php'>Link back to message board </a></div> " ; 

  } 
  mysqli_close($link);
  ?>
</html>