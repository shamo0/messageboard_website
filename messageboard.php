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
  header("Location: http://localhost/index.php");
  
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
  if (isset($_GET['mess'])) { 
    $message = $_GET['mess']; 
    $time = $_GET['timeadded']; 
    $sql = "INSERT INTO messages (messageVal, timestampVal) VALUES ('$message', '$time')"; 
    if ($link->query($sql) === TRUE) { 
      $last_id = $link->insert_id; 
      } 
    else { 
      echo "Error: " . $sql . "<br>" . $link->error;
      } 
    echo "<h1>Message Receieved!</h1>";     
  } 


?>

<form name="messageboard" method="get" action="messageboard.php">
  <label for="message"> Enter your message: 
    <input type="text" name="mess" placeholder="Hello There!"> 
  </label><br>
  <input type="hidden" name="timeadded" value="<?php echo time(); ?>">
  <input type="submit" value="Send message!"> 
</form> 

<?php
    $sql = "SELECT User, messageVal, timestampVal FROM messages"; 
    if($result = mysqli_query($link, $sql)){
		    if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){
            echo "<div class='container'>";
              echo "<img src='/w3images/bandmember.jpg' alt='Avatar'>";
              echo "<p class='Price'> $".$row['Price']. ".00</p>";
              echo "<p>" . $row['messageVal'] . "</p>";
              echo "<span class='time-right'>" . $row[timestampVal] . "</span>";
          }
          mysqli_free_result($result);
        } else{
		        echo "No records matching your query were found.";
		    }
      } else{
  		    echo "ERROR: Unable to execute $sql. " . mysqli_error($link);
  		}
  		mysqli_close($link);
  		?>

<!--
<div class="container">
  <img src="/w3images/bandmember.jpg" alt="Avatar">
  <p>Hello. How are you today?</p>
  <span class="time-right">11:00</span>
</div>

<div class="container darker">
  <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right">
  <p>Hey! I'm fine. Thanks for asking!</p>
  <span class="time-left">11:01</span>
</div>

<div class="container">
  <img src="/w3images/bandmember.jpg" alt="Avatar">
  <p>Sweet! So, what do you wanna do today?</p>
  <span class="time-right">11:02</span>
</div>

<div class="container darker">
  <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right">
  <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
  <span class="time-left">11:05</span>
</div> 
    --> 

</body>
</html>