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
  echo "<h1> Welcome to the member's only messageboard, " . $_SESSION['username'] . "<br>Feel free to enter a message or edit an old one! </h1>"; 
}
else { 
  echo "<h1> You must login/register to see this page. Redirecting ...  "; 
  header("Location: http://localhost:8080/part2/index.html");
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


<script>
function logout() {
    alert('Logged Out'); 
    if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

    xmlhttp.open("GET","session_destroyer.php",false);
    xmlhttp.send();

    document.getElementById("hello").innerHTML=xmlhttp.responseText;
      } 
</script>
<p id="hello"></p>
<button onclick="logout()">Log out</button> 

<form name="messageboard" method="post" action="newMessage.php">
  <label for="message"> Enter your message: 
    <input type="text" required name="mess" placeholder="Hello There!"> 
  </label><br>
  <input type="hidden" name="timeadded" value="<?php date_default_timezone_set('UTC'); echo date('l jS \of F Y h:i:s A');?>">
  <input type="submit" value="Send message!"> 

</form> 

<?php
    $sql = "SELECT messages.id, messageId, messageVal, timestampVal, username FROM messages, users WHERE messages.id=users.id"; 
    if($result = mysqli_query($link, $sql)){
		    if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){
            echo "<div class='container'>";
              echo "<p>" . $row['username'] . "</p>";
              echo "<p>" . $row['messageVal'] . "</p>";
              echo "<span class='time-right'>" . $row['timestampVal'] . "</span>";
              if ($_SESSION['username'] == 'admin') 
              { 
                echo "<button oncick = 'removeComment(".$row['messageId'].")'> Edit/Delete Post </button>";
              }
              elseif ($_SESSION['username'] == $row['username']) { 
                echo "<button oncick = 'removeComment(".$row['messageId'].")'> Edit/Delete Post </button>";
              }
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
    echo "<div class='container'>";
    echo "<h1>" . $user . "</h1>";
    echo "<p>" . $message . "</p>";
    echo "<span class='time-right'>" . $time . "</span>";
    echo "</div>";

  } 
  mysqli_close($link);
?>

<?php
  function removeComment($wantedId){
      $link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
      if (mysqli_connect_errno()) die("Unable to connect to MySQL: " . mysqli_connect_error());
      
      $user = $_SESSION['username'];
      $query =  "SELECT messageId FROM messages WHERE username = '$user' AND messageId='$wantedId";
      $result = mysqli_query($link,$query);
      if (mysqli_num_rows($result)){
        $row = mysqli_fetch_array($result);
        $id = $row['messageId'];
        $sql = "DELETE FROM messages WHERE messageId='$id' "; 
      }

  }


?>
</body>
</html>