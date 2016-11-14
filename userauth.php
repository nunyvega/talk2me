<?php 

//User authentification:

//signup - definitions:      ---------------------------------------

//MySql
$dbhost = "127.0.0.1";
$dbname = "t2m";
$dbuser = "root";
$dbpass = "password";
$dbtable = "users";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
	die("connection failed:" . mysqli_connect_error());
}

$sql = '';


// Errors:

$loginError = $usernameError = $emailError = $nameError = $lastnameError = $passwordError = '';
$fieldRequiredError = "This field is necesary to complete the registration";


//Variables:

$username = $email = $name = $lastname = $password = '';

//Flow handle variables:

$CompleteData = '';
$loginStarted = '';
$signupStarted = '';
$signupReady = False;
$loginReady = False;
$uniqueUsername = True;
$completeData = False;

//functions:

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


// Form handling: Signup -------------------------------------------------------------

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["formChoice"] == "signup"){  //check if the form to handle is a 
																				//register or login form. true = reg
	$signupStarted = True;
	if (empty($_POST["username"])){
		$usernameError = $fieldRequiredError;
		$completeData = False;
	} else {
		$username = test_input($_POST["username"]);
		if (!preg_match("^[a-zA-Z0-9_]{1,}$^", $username)){
			$usernameError = "This field can only contain letters, numbers, underscores and hyphens";
			$completeData = False;
		}
		mysqli_query($conn, 'SELECT * FROM users WHERE( username = "'.$username.'")');
		$show = mysqli_affected_rows($conn);
		if (mysqli_affected_rows($conn) >= 1){
			$usernameError = "The Username selected has already been taken, sorry!";
			$uniqueUsername = False;
		}

	}
	if (empty($_POST["email"])){
		$emailError = $fieldRequiredError;
		$completeData = False;
	} else {
		$email = test_input($_POST["email"]);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$emailError = "oops, the mail adress you provided doesn't seem to be a valid adress";
			$completeData = False;
		}
	}
	
	if (empty($_POST["name"])){
		$nameError = $fieldRequiredError;
		$completeData = False;
	} else{
		$name  = test_input($_POST["name"]);
		if (!preg_match("/^[a-zA-Z ]*$/", $name)){
			$nameError = "This field can only contain Letters and blank spaces";
			$completeData = False;
		}
	}

	if (empty($_POST["lastname"])){
		$lastnameError = $fieldRequiredError;
		$completeData = False;
	} else{
		$lastname  = test_input($_POST["lastname"]);
		if (!preg_match("/^[a-zA-Z ]*$/", $name)){
			$lastnameError = "This field can only contain Letters and blank spaces";
			$completeData = False;
		}
	}	
	
	if (empty($_POST["password"])){
		$passwordError = $fieldRequiredError;
		$completeData = False;
	} else {
		$password = $_POST["password"];
		$passwordRepeat = $_POST["passwordRepeat"];
		if ($password != $passwordRepeat){
			$passwordError = "The passwords don't match";
			$completeData = False;
		}
	}

	if ($usernameError == '' && $nameError == '' && $lastnameError == '' 
		&& $emailError == '' && $passwordError == ''){
		$completeData = True;
	}
	if ($completeData == True && $uniqueUsername == True){
		$signupReady = True;

		$sql = 'INSERT INTO users (username, name, lastname, email, password)
				VALUES ("'.$username.'", "'.$name.'", "'.$lastname.'", "'.$email.'", "'.$password.'") ';

		mysqli_query($conn, $sql);
	}

}

// Form handling: Login -------------------------------------------------------------


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formChoice'] == "login"){	//check if the form to handle is a 
																				//register or login form. true = reg
	$loginStarted = True;	

	if (empty($_POST['username'])){
		$usernameError = $fieldRequiredError;
		$loginReady = False;
	} else{
		$username = $_POST['username'];
	}

	if (empty($_POST['password'])){
		$passwordError = $fieldRequiredError;
		$loginReady = False;
	} else {
		$password = $_POST['password'];

	}

	$userId = mysqli_query($conn, "SELECT UserID FROM users WHERE(username = '$username' AND password = '$password')");

	if (mysqli_affected_rows($conn) == 1){  //If True : Succesfully logged in

		$loginReady = True;
		setcookie('logged', True);
		setcookie('username', $username);
		setcookie('userid', '$userid');
	

	} else{
		$loginError = "The user/password combination is incorrect. Please try again.";
		$loginReady = False;
	}

}






?>