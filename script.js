function validateUser() { 
  var username = document.forms["signup"]["username"].value;
  if (username.length == 0) {   //ensure something is put in
    document.write("test")
    // document.getElementById("errCheck0").innerHTML = "Enter a username!";
    return false;
  }
  else { 
    return true; 
  }
}

function validatePassword() { 
  var password = document.forms["signup"]["password"].value;
  if ((password.length > 5) && (/\d/.test(password))) {   //ensures length is at least six and has one digit
    // document.getElementById("errCheck1").innerHTML = "";
    document.write("test");
    return true;
  } 
  else { 
    return false; 
  }
}

function validateSignup() {
  if (validateUser() && validatePswd()) {
    document.getElementById['signUp'].submit();   //if all functions return true, submit the form
    return true;
  }
  else {
    alert("Form needs to be filled out correctly!");    //alerts user of problem, doesn't submit
    return false;
  }
}