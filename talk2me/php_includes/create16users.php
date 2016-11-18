<?php
include ("./dbconnect.php");
//first section creates the users in the array.
//second section makes every user in the array follow the other users in the array

	$userlist = array(
		array('username' =>'aluino', 'name' =>'Alvaro', 'lastname' => 'Beduino' ),
		array('username' =>'ebuino', 'name' =>'Eustaquio', 'lastname' => 'Busantino' ),
		array('username' =>'cabuino', 'name' =>'Carlos', 'lastname' => 'Bursino' ),
		array('username' =>'paduino', 'name' =>'Palabro', 'lastname' => 'Dustino' ),
		array('username' =>'mabuino', 'name' =>'Marla', 'lastname' => 'Ostrencis' ),
		array('username' =>'asuino', 'name' =>'Ascarju', 'lastname' => 'Marjarku' ),
		array('username' =>'cotuino', 'name' =>'Inaniel', 'lastname' => 'Ferriel' ),
		array('username' =>'astopino', 'name' =>'MarkoBiff', 'lastname' => 'Sniff Sniff' ),
		array('username' =>'colomino', 'name' =>'Costromen', 'lastname' => 'Markoben' ),
		array('username' =>'osconino', 'name' =>'Zen', 'lastname' => ', men!' ),
		array('username' =>'artovino', 'name' =>'Deskes', 'lastname' => 'Asthafs' ),
		array('username' =>'tosudino', 'name' =>'Arkuibs', 'lastname' => 'Tregar' ),
		array('username' =>'ostrocino', 'name' =>'Berkenteemeth', 'lastname' => 'Elgorder' ),
		array('username' =>'boncomino', 'name' =>'Lujembunsh', 'lastname' => 'Mastorf' ),
		array('username' =>'coscluino', 'name' =>'Markoviris', 'lastname' => 'Astrabul' ),
		array('username' =>'cascluino', 'name' =>'Merjensteres', 'lastname' => 'Esteferestis' )
		);


	/*  This section of the code creates the users in the array above.

	for( $i = 0; $i < count($userlist); $i++ ){

		$username = $userlist[$i]['username'];
		$name = $userlist[$i]['name'];
		$lastname = $userlist[$i]['lastname'];
		//only the email and password are not in the array:
		$email = $username."@gmail.com";
		$password = "s";


		$sql = 'INSERT INTO users (username, name, lastname, email, password)
				VALUES ("'.$username.'", "'.$name.'", "'.$lastname.'", "'.$email.'", "'.$password.'") ';

		$result = mysqli_query($conn, $sql);

		$sql = 'SELECT UseirID FROM users WHERE (username = "'.$username.'")';

		$result1 = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result1);
		$userid = $row['UserID'];

		$defaultPicturePath = "./images/defaultProfilePicture.jpg";
		$defaultUserDescription = "The default user description message has to be written in this variable";
		$profileLink = "./index.php?u=".$userid;

		$sql = 'INSERT INTO profiles (UserID, username, picturepath,
		 description, profilelink, country, language)
		VALUES ("'.$userid.'", "'.$username.'", "'.$defaultPicturePath.'",
			"'.$defaultUserDescription.'","'.$profileLink.'", "Not set", "Not set")';

		$result = mysqli_query($conn, $sql);
		print($userid.$username.$name.$lastname.$email.$profileLink);
		echo ("<br>");

		mkdir("./users/".$userid.$username."/profilepics", 0777, true);
		mkdir("./users/".$userid.$username."/uploads", 0777, true);

	}
	*/


//This section makes every user in the above array follow the other users in the array

/*	for ( $i = 0; $i < count($userlist); $i++){

		$followerUsername = $userlist[$i]['username'];

		$sql = 'SELECT UserID FROM users WHERE ( username = "'.$followerUsername.'")';

		$result = mysqli_query($conn, $sql);
		$row  = mysqli_fetch_assoc($result);
		$followerID = $row['UserID'];

		for ($j = 0; $j < count($userlist); $j++){
			$followedUsername = $userlist[$j]['username'];
			if ($followerUsername == $followedUsername){
				echo ("<br>");
				print($followerUsername." = ".$followedUsername);
			} else {
				$sql = 'SELECT UserID FROM users WHERE (username = "'.$followedUsername.'")';
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$followedID = $row['UserID'];

				$sql = 'INSERT INTO friends ( followerUsername, followerUserID, followedUsername, followedUserID)
						VALUES ("'.$followerUsername.'", "'.$followerID.'", "'.$followedUsername.'", "'.$followedID.'")';

				$result = mysqli_query($conn, $sql);


				print("now ".$followerUsername." follows: ".$followedUsername);
				echo ("<br>");
			}
		}
	}

*/

//2016.11.17: Correct issue with the dirs not have been created:
/*  this section only creates the dirs for the users. it's included in the first section.


for ($i = 0; $i < count($userlist); $i++){
	$username = $userlist[$i]["username"];

	$sql = 'SELECT UserID FROM users WHERE (username = "'.$username.'")';
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$userid = $row['UserID'];
	$dir1created = "../users/".$userid.$username."/profilepics";
	mkdir($dir1created, 0777, true);
	$dir2created = "../users/".$userid.$username."/uploads";
	mkdir($dir2created, 0777, true);

	print ("created dir:");
	echo ("<br>");
	print($dir1created);
	echo ("<br>");
	print("created dir:");
	echo ("<br>");
	print($dir2created);
	echo ("<br>");

	echo ("<br>");
}
*/

//2016.11.17: Correct issue with the profileLink variable not having the user id:

for ($i=0 ; $i < count($userlist); $i++){

	$username = $userlist[$i]['username'];

	$sql = 'SELECT UserID FROM users WHERE ( username = "'.$username.'")';
	$userid = mysqli_query($conn, $sql);
	$userid = mysqli_fetch_assoc($userid);
	$userid = $userid['UserID'];
	print($userid);

	$sql = 'UPDATE profiles SET profilelink ="./index.php?u='.$userid.'" WHERE ( username = "'.$username.'")';
	$res = mysqli_query($conn, $sql);

}

?>








