<?php
//handles follow user button, like video button:

//follow user:

$followed = '';

	//Check if the user is already followed:
	$sql = "SELECT * FROM friends WHERE (followerUsername = '".$username."' AND followedUsername = '".$vusername."')";
	$result = mysqli_query($conn, $sql);
	$check = mysqli_affected_rows($conn);
	if($check >=1 ){                       //$followed variable is meant to be used to toggle the "follow" button
		$followed = true;
	} else {
		$followed = false;
	}		
	


	if (isset($_POST["follow"])){

		$sql = "INSERT INTO friends (followerUserID, followerUsername, followedUserID, followedUsername)
				VALUES ('".$userid."', '".$username."','".$vuserid."','".$vusername."')";
		$result = mysqli_query($conn, $sql);
		$check = mysqli_affected_rows($conn);
		if($check != 1){
			$followError = "There has been an error modifing the data base, please contact the web administrator";
		}
		$followed = true;


	}



?>