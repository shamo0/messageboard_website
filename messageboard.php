<html lang="en">
<?php
//set up connection and connect
$db_hostname = 'localhost';
$db_database = 'messageboard';
$db_username = 'root';
$db_password = '';
$link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

if (mysqli_connect_errno()) die("Unable to connect to MySQL: " . mysqli_connect_error());

session_start(); 
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { 
  echo "<div class= 'welcome'> <h1> Welcome to the member's only messageboard, " . $_SESSION['username'] . "! </h1></div>"; 
}
else { 
  echo "<h1> You must login/register to see this page. Redirecting ...  "; 
  header("Location: http://localhost:8080/Project/index.html");
}

?>

<head>
  <meta charset="utf-8">
  <title>messageBoard</title>
  <meta name="index" content="The HTML5 Herald">
  <meta name="Geno" content="SitePoint">
  <link rel="stylesheet" href="styless.css">

  <script src='script.js'></script>


</head>
<body>
   <div class = nav_back>
      <topnav>
            <ul>
              <li><a class="active" href="messageboard.php">Chat</a></li>
              
              <li><a href="mailto: m216060@usna.edu?subject= help needed">Contact</a></li>
              <li><a onclick="logout()" >Log out</a></li>
            </ul>

        </topnav>
    </div>

<div class = "welcome2">
  <h3> Feel free to add a new or edit your old messages. </h3>
</div>


<div class="forms_div20">
  <h3> Enter your message: </h3>
<form name="messageboard" method="post" action="newMessage.php">
  
    <label for="message">
      <div class= "inputText">
    <input type="text" required name="mess" placeholder="Hello There!"> 
     </div>
    </label>
 
  <input type="hidden" name="timeadded" value="<?php date_default_timezone_set('UTC'); echo date('l jS \of F Y h:i:s A');?>">
  <input class= "button" type="submit" value="Send message!"> 
</form> 
</div>

<?php
    //SQL query to get the values from the database
    $sql = "SELECT messages.id, messageId, messageVal, timestampVal, username FROM messages, users WHERE messages.id=users.id"; 
    if($result = mysqli_query($link, $sql)){
		    if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){
            echo "<div class='container12' id='id".$row['messageId']."'>";
            echo "<div class= 'forms_div4'>";
            echo "<div class= 'forms_div4-img'>";
            echo "<img class = 'image' src= 'icon.png'>";
            echo "</div>";
            echo "<div class='userDiv'>";
            echo $row['username'];
            echo "</div>";
            echo "<br>";
            echo "<br>";
            echo "<div class='msgDiv'>";
            echo $row['messageVal'] . "<br />";
            echo "</div>";
            echo "<span class='time-right'>" . $row['timestampVal'] . "</span>";




            //Check if admin
            if ($_SESSION['username'] == 'admin') 
              { 
                echo "<br>";
                echo "<br>";
                echo "<br>";
                echo "<a href=\"deleteMessage.php?id=".$row['messageId']. "\" >";
                echo "<button class= 'button1'>  DELETE </button>";
                echo "</a><br>";
                
                echo "<a href=\"editMessage.php?id=".$row['messageId']. "\" >";
                echo "<button class= 'button1'> EDIT </button>";
                echo "</a><br>";
              }
              //Check if regular user
              elseif ($_SESSION['username'] == $row['username']) { 
                echo "<br>";
                echo "<br>";
                echo "<br>";
                echo "<a href=\"deleteMessage.php?id=".$row['messageId']. "\" >";
                echo "<button class= 'button1'> DELETE </button>";
                echo "</a> <br>"; 
                echo "<a href=\"editMessage.php?id=".$row['messageId']. "\" >";
                echo "<button class= 'button1'> EDIT </button>";
                echo "</a>";
                  }
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
          mysqli_free_result($result);
        } else{
		        echo "No records matching your query were found.";
		    }
      } else{
  		    echo "ERROR: Unable to execute $sql. " . mysqli_error($link);
      }

  //This inserts the new message
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
    
    echo "<h1>Message Receieved!</h1>";     
    echo "<div class='container12'>";
    echo "<h1>" . $user . "</h1>";
    echo "<p>" . $message . "</p>";
    echo "<span class='time-right'>" . $time . "</span>";
    echo "</div>";
  } 
  mysqli_close($link);
?>

</body>
</html>