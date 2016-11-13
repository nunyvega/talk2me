//Javascript functions to change the header bar depending on if the user is logged or not.
var processStarted = "";

//Open and close login/register dialog box:

function openLogin(){
  document.getElementById("loginFormContainer").style="display:block";
}
function closeLogin(){
  document.getElementById("loginFormContainer").style="display:none";
}
function openSignup(){
  document.getElementById("signupFormContainer").style="display:block";
}
function closeSignup(){
  document.getElementById("signupFormContainer").style="display:none";
}

//Check that password matches repeat password: 

function checkPswd(){
  var psw = document.getElementById("signupPsw").value;
  var pswR = document.getElementById("signupPswRpt").value;
  document.getElementById("signupSubmit").disabled= true;
  if (psw == pswR){
    document.getElementById("paswError").innerHTML="";
    document.getElementById("signupSubmit").disabled= false;
  } else{
    document.getElementById("paswError").innerHTML="The passwords don't match";
  }


}

//when logged in:
var x = 1
function openProfileMenu(){
  x = x * (-1);
  if (x < 0){
    document.getElementById("dropDownContent").style="display:block";
    document.getElementByClass("dropDownText").style="display:block";
    document.getElementById("arrowDown").style.transform="rotate(180dg)";
  } else {
    document.getElementById("dropDownContent").style="display:none";
    document.getElementByClass("dropDownText").style="display:none";
    document.getElementById("arrowDown").style.transform="rotate(180dg)";
  }

}

