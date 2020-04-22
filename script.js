  //Validates username whn signing up
function validateUser() {
  var username = document.forms["signup"]["username"].value;
  username = escape(username);//Escaping chars
  if (username.length == 0) {   //ensure something is put in
    // document.write("test")
    document.getElementById("errorcheck1").innerHTML = "Enter a username!";
    return false;
  }
  else {
    document.getElementById("errorcheck1").innerHTML = "";
    return true;
  }
  }

  //Validates name whn signing up
  function validateName() {
  var username = document.forms["signup"]["name"].value;
  username = escape(username); //Escaping special chars
  if (username.length == 0) {   //ensure something is put in
    document.getElementById("errorcheck3").innerHTML = "Enter a Name!";
    return false;
  }
  else {
    document.getElementById("errorcheck3").innerHTML = "";
    return true;
  }
  }
  //Validates user password when signing up
  function validatePassword() {
  var password = document.forms["signup"]["password"].value;
  password = escape(password); //escaping the characters
  if ((password.length > 5) && (/\d/.test(password) && (password.length < 20))) {   //ensures length is at least six and has one digit
    document.getElementById("errorcheck2").innerHTML = "";
    return true;
  }
  else {
    document.getElementById("errorcheck2").innerHTML = "Weak Password!";
    return false;
    }
  }
  
  function messageEscape() {
      string = document.forms["messageboard"]["mess"].value;
      escaped = escape(string);
      return;
  }

  //Checks if all the other functions validated before letting user signup
  function validateSignup() {
  if (validateUser() && validatePassword() && validateName()) {
    document.getElementById['signUp'].submit();   //if all functions return true, submit the form
    alert("Account successfully created!"); 
    return true;
  }
  else {
    alert("Form needs to be filled out correctly!");    //alerts user of problem, doesn't submit
    return false;
  }
  }
  //Logout function
  function logout() {
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
      window.location.reload();
      alert('Logged Out');
        }
  