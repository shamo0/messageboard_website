  //Validates username whn signing up
  function validateUser() {
    var username = document.forms["signup"]["username"].value;
    if ((username.length > 15) || ((/^[a-zA-Z\s]*$/.test(username))==false) || (username.length == 0)) {   //ensure something is put in
      // document.write("test")
      document.getElementById("errorcheck1").innerHTML = "Enter a valid username!";
      return false;
    }
    else {
      username = encodeURIComponent(username);//Escaping chars
      document.getElementById("errorcheck1").innerHTML = "";
      return true;
      }
    }
  
    //Validates name whn signing up
    function validateName() {
    var name = document.forms["signup"]["name"].value;
     
    if ((name.length == 0) || ((/^[a-zA-Z\s]*$/.test(name))==false) ||(name.length > 15)){   //ensure something is put in
      document.getElementById("errorcheck3").innerHTML = "Enter a valid name!";
      return false;
    }
    else {
      name = encodeURIComponent(name);
      document.getElementById("errorcheck3").innerHTML = "";
      return true;
      }
    }
    //Validates user password when signing up
    function validatePassword() {
    var password = document.forms["signup"]["password"].value;
    if ((password.length > 5) && (/\d/.test(password)==true) && (password.length < 25)) {   //ensures length is at least six and has one digit
      password = encodeURIComponent(password); //escaping the characters
      document.getElementById("errorcheck2").innerHTML = "";
      return true;
    }
    else {
      document.getElementById("errorcheck2").innerHTML = "Invalid Password";
      return false;
      }
    }
    
    function messageEscape() {
        string = document.forms["messageboard"]["mess"].value;
        escaped = encodeURI(string);
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
        xmlhttp.open("GET","http://localhost:8080/part2/session_destroyer.php",false);
        xmlhttp.send();
        window.location.reload();
        alert('Logged Out');
          }
    