function validateSignup() {
  // var email = document.forms["signup"]["email"].value;
  var password = documtn.forms["signup"]["password"].value;
  var username = document.forms["signup"]["name"].value;
  if (username.length == 0) {   //ensure something is put in
    document.getElementById("errCheck0").innerHTML = "Enter a username!";
    return false;
  }
  else {
    document.getElementById("errCheck0").innerHTML = "";  //change error back to nothing if fixed
    return true;
  }
  if ((password.length > 5) && (/\d/.test(password))) {   //ensures length is at least six and has one digit
    document.getElementById("errCheck1").innerHTML = "";
    return true;
  }
  else {    //error message
    document.getElementById("errCheck1").innerHTML = "Password must be at least 6 characters long and contain at least one number!";
    return false;
  }
  
}