function validateLogin() {
  var email = document.forms["login"]["email"].value;
  var password = documtn.forms["login"]["password"].value;

  if (email == "") {
    alert("Name must be filled out");
    return false;
  }
  else if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
    return (true);
  }
    alert("You have entered an invalid email address!");
    return (false);
  //check for email in users database below
  
  // Password requesiremtns here and check in database
  // we could store the hashes of passwords in database 
  // to be more ligit and compare the hashes as the login test
} 

function validateSignup() {
  var email = document.forms["signup"]["email"].value;
  var password = documtn.forms["signup"]["password"].value;
  var name = document.forms["signup"]["name"].value;

  if (email == "") {
    alert("Name must be filled out");
    return false;
  }
  else if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
    return (true);
  }
    alert("You have entered an invalid email address!");
    return (false);
  //check for email in users database below


  //This only checks regex for:
  //[7 to 15 characters which 
  //contain only characters, numeric digits, underscore and 
  //first character must be a letter]
  var passwReq=  /^[A-Za-z]\w{7,14}$/;
  if(password.match(passwReq)) { 
    alert('Correct, try another...')
    return true;
  }
  else { 
    alert('Wrong...!')
    return false;
  }
  //pasword check needes in database
}