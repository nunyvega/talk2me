<?php 

//User authentification:

//signup - definitions:      ---------------------------------------

include ("./dbconnect.php");


// Errors:

$loginError = $usernameError = $emailError = $nameError = $lastnameError = $passwordError = '';
$fieldRequiredError = "This field is necesary to complete the registration";

//config variables:

$defaultPicturePath = "./images/defaultProfilePicture.jpg";
$defaultUserDescription = "The default user description message has to be written in this variable";

//Variables:

$username = $email = $name = $lastname = $password = $profileLink = '';

//Flow handle variables:

$CompleteData = '';
$loginStarted = '';
$signupStarted = '';
$signupReady = False;
$loginReady = False;
$uniqueUsername = True;
$completeData = False;
$show = '';

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

		$username = mysqli_real_escape_string($conn, $username);
		$name = mysqli_real_escape_string($conn, $name);
		$lastname = mysqli_real_escape_string($conn, $lastname);
		$email = mysqli_real_escape_string($conn, $email);
		$password = mysqli_real_escape_string($conn, $password);

		//Create user in user database table
		$sql = 'INSERT INTO users (username, name, lastname, email, password)
				VALUES ("'.$username.'", "'.$name.'", "'.$lastname.'", "'.$email.'", "'.$password.'") ';

		mysqli_query($conn, $sql);

		// Get the user id:
		$sql = 'SELECT UserID FROM users WHERE (username = "'.$username.'")';
		$userid = mysqli_query($conn, $sql);
		$userid = mysqli_fetch_assoc($userid);
		$userid = $userid["UserID"];

		//create user folder (useridusername; example: 4431solanop) and create subfolders for profile pictures
		//and video uploads

		mkdir("./users/".$userid.$username."/profilepics", 0777, true);
		mkdir("./users/".$userid.$username."/uploads", 0777, true);

		//User profile link:

		$profileLink = "./index.php?u=".$userid ;

		//create user profile in profiles database table

		$sql = 'INSERT INTO profiles (UserID, username, picturepath,
										 description, profilelink)
			VALUES ("'.$userid.'", "'.$username.'", "'.$defaultPicturePath.'",
					"'.$defaultUserDescription.'","'.$profileLink.'")';

		$result = mysqli_query($conn, $sql);



		mysqli_close($conn);

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

	$result = mysqli_query($conn, "SELECT UserID, name, lastname FROM users 
									WHERE(username = '$username' AND password = '$password')");
	



	if (mysqli_affected_rows($conn) == 1){  //If True : Succesfully logged in

		$loginReady = True;

	//Get user data:

		$row = mysqli_fetch_row($result);
		$userid = $row[0];
		$name = $row[1];
		$lastname = $row[2];

	//real_escape_string the variables for the sql:

		$userid = mysqli_real_escape_string($conn, $userid);
		$name = mysqli_real_escape_string($conn, $name);
		$lastname = mysqli_real_escape_string($conn, $lastname);

	//get profile picture and profile paths:


		$sql = "SELECT picturepath, profilelink, description, country,  language FROM profiles WHERE (username = '$username')";

		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_row($result);
		$picturePath = $row[0];
		$profileLink = $row[1];
		$userDescription = $row[2];
		$country = $row[3];
		$spokenLanguage = $row[4];

		mysqli_real_escape_string($conn, $picturePath);
		mysqli_real_escape_string($conn, $profileLink);
		mysqli_real_escape_string($conn, $userDescription);
		mysqli_real_escape_string($conn, $country);
		mysqli_real_escape_string($conn, $spokenLanguage);

	//Set cookies:

		setcookie('logged', True);
		setcookie('username', $username);
		setcookie('userid', $userid);
		setcookie('name', $name);
		setcookie('lastname', $lastname);
		setcookie('picturePath', $picturePath);
		setcookie('profileLink', $profileLink);
		setcookie('userDescription', $userDescription);
		setcookie('country', $country);
		setcookie('spokenLanguage', $spokenLanguage);


	

	} else{
		$loginError = "The user/password combination is incorrect. Please try again.";
		$loginReady = False;
	}

}






?>