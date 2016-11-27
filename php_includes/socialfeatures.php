<?php
//handles follow user button, collect video button, add crowd tag button, give attr button, ask new question button.
//follow user:

$followed = '';
$newCtSucces = '';
$crowdTagError = '';


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

	if (isset($_POST["newCrowdTagSubmit"])){
		if (empty($_POST["newCrowdTag"])){
			$crowdTagError = "Please insert a tag to add";
			$newCtSucces = false;
		}

		$crowdTags = explode( ";" , $_POST["newCrowdTag"]);

		for ( $i = 0 ; $i < count($crowdTags) ; $i++ ){

			$crowdTag = trim($crowdTags[$i]);
			$sql = 'SELECT tagid FROM _tags WHERE ( tagname = "'.$crowdTag.'" )';
			$check = mysqli_query($conn , $sql);
			$check = mysqli_affected_rows($conn);

			//get tagid (create tag if necessary)
			if ($check < 1 ){ 
				//insert tag as a new tag
				$sql = 'INSERT INTO _tags ( tagname ) VALUES ( "'.$crowdTag.'")';
				$result = mysqli_query($conn , $sql);
				$check = mysqli_affected_rows($conn);

				if ( $check < 1){
					$crowdTagError .= " <br>There was an arror and the tag ".$crowdTag." was not added";
				
				
				}
				$tagid = mysqli_insert_id($conn);
			} elseif ($check >= 1){

			$sql = 'SELECT tagid FROM _tags WHERE ( tagname = "'.$crowdTag.'")';

			$select = mysqli_query($conn , $sql);
			$select = mysqli_fetch_assoc($select);
			$tagid = $select['tagid'];

			}

			//get postid:

			$postid = 1;


			//get taggerid:

			$taggerid = $_COOKIE['userid']; // have to work in making the user unable to select the 
											//"add crowdtag button" if not logged

			//store in db:


			$sql = 'INSERT INTO _crowdtags (tagid , postid , taggerid)
					VALUES( "'.$tagid.'" , "'.$postid.'", "'.$taggerid.'")'; // falta definir postid
			$result = mysqli_query($conn , $sql);

		}




	}



?>