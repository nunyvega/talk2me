<<<<<<< HEAD
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



=======
>>>>>>> dap
function linkcases(caseNumber){
  switch (caseNumber){
    case 1:
      document.getElementById("videoPlayer").src="https://www.youtube.com/embed/YLGx5Pbcbuk"; //Ostera dormido
      break;
    case 2:
      document.getElementById("videoPlayer").src="https://www.youtube.com/embed/yO0gHLGfd8Q"; //Caminos del norte
      break;
    case 3:
      document.getElementById("videoPlayer").src="https://www.youtube.com/embed/KIVeSDSu_M4"; //Hernan Ruiz Diaz
      break;
    case 4:
      document.getElementById("videoPlayer").src="https://www.youtube.com/embed/JD2Zw7PayoU"; //Pato Sanchez
      break;
    case 5:
      document.getElementById("videoPlayer").src="https://www.youtube.com/embed/L5bU9tb417I"; //Manu Pellagata
      break;
    case 6:
      document.getElementById("videoPlayer").src="https://www.youtube.com/embed/WeVvR_ESOs8"; //Tom Craig
      break;
    case 7:
      document.getElementById("videoPlayer").src="https://www.youtube.com/embed/G9LsEH8kbT4"; //Kiwi
      break;
    case 8:
      document.getElementById("videoPlayer").src="https://www.youtube.com/embed/cJj9uBv0qbI"; //Tess Parks
      break;
    case 9:
      document.getElementById("videoPlayer").src="https://www.youtube.com/embed/YQhgEbPo2mY"; // Allah Lahs
      break;
  }
}
<<<<<<< HEAD

function isEnter(event){

  var keyPressed = event.keyCode();
  alert("hola");

  if (keyPressed == 13) {
    alert("inside the if");
    questions(document.getElementById('questionField').value)  //cambié pregunta por questionField para que quede todo en el mismo idioma.
    return false;                                              //lo puse en inglés por si alguien se dispone a ayudarnos en github
  }
}


function questions(question){
  var question = document.getElementById('questionField').value
=======
function questions(question){
  var question = document.getElementById('pregunta').value
>>>>>>> dap
  switch (question){
    case "why":
      document.getElementById("videoPlayer").src="https://www.youtube.com/embed/YLGx5Pbcbuk"; //Ostera dormido
      break;
    case "how":
      document.getElementById("videoPlayer").src="https://www.youtube.com/embed/yO0gHLGfd8Q"; //Caminos del norte
      break;
    case "who":
      document.getElementById("videoPlayer").src="https://www.youtube.com/embed/KIVeSDSu_M4"; //Hernan Ruiz Diaz
      break;
    case "where":
      document.getElementById("videoPlayer").src="https://www.youtube.com/embed/JD2Zw7PayoU"; //Pato Sanchez
      break;
    case "name":
      document.getElementById("videoPlayer").src="https://www.youtube.com/embed/L5bU9tb417I"; //Manu Pellagata
      break;
    case "when":
      document.getElementById("videoPlayer").src="https://www.youtube.com/embed/WeVvR_ESOs8"; //Tom Craig
      break;
    case 'what for':
      document.getElementById("videoPlayer").src="https://www.youtube.com/embed/G9LsEH8kbT4"; //Kiwi
      break;
    case 'what':
      document.getElementById("videoPlayer").src="https://www.youtube.com/embed/cJj9uBv0qbI"; //Tess Parks
      break;
    default:
      document.getElementById("videoPlayer").src="https://www.youtube.com/embed/YQhgEbPo2mY"; // Allah Lahs
      break;
  }
}
