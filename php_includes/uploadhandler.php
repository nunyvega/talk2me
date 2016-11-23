<?php
//Solano:
//Upload content to the server.
//While I'm building the userprofile page, I'll put a input of a youtube link to be able to create the posts in the db.
//will work on the video uploading later on.

include './php_includes/getcookies.php';
//globals:
$linkError = '';

//flow control:
$uploadSuccesfull = '';


//config:


//functions:

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

//  script starts:

if (isset($_POST['uploadVideo'])){

	$uploadSuccesfull = true;

	//sanitize data:

	if(empty($_POST['uploadLink'])){
		$linkError = "You need to insert a link";
		$uploadSuccesfull = False;
	} else {
		$uploadLink = test_input($_POST['uploadLink']);
		if(!preg_match('%^((https?://)|(www\.))([a-z0-9-].?)+(:[0-9]+)?(/.*)?$%i', $uploadLink)){
			$linkError = "The url you embeded doesn't appear to be a proper url, please try again";
			$uploadSuccesfull = False;
		}
	}
	if(empty($_POST['uploadTitle'])){
		$titleError = "You need to insert a tittle";
		$uploadSuccesfull = False;
	} else {
		$uploadTitle = test_input($_POST['uploadTitle']);
	}
	if(empty($_POST['uploadDescription'])){
		$descriptionError = "Please enter a short description of the subject you speak about in the video";
		$uploadSuccesfull = false;
	} else {
		$uploadDescription = test_input($_POST['uploadDescription']);
	}

	$date = getdate();
	$uploadDate = $date['year']."/".$date['month']."/".$date['mday']." at: ".$date['hours'].":".$date['minutes'];
	$uploadPlace = "need to work on the geolocation";
	$isAnswer = "false";

	$uploadLink = mysqli_real_escape_string($conn, $uploadLink);
	$uploadTitle = mysqli_real_escape_string($conn, $uploadTitle);
	$uploadDescription = mysqli_real_escape_string($conn, $uploadDescription);
	$uploadDate = mysqli_real_escape_string($conn, $uploadDate);
	$uploadPlace = mysqli_real_escape_string($conn, $uploadPlace);
	$isAnswer = mysqli_real_escape_string($conn, $isAnswer);



	$sql = 'INSERT INTO posts (userid, link, title, description, postdate, place, isanswer)
					VALUES ( "'.$userid.'" , "'.$uploadLink.'" , "'.$uploadTitle.'" , "'.$uploadDescription.'" ,
					 "'.$uploadDate.'" , "'.$uploadPlace.'" , "'.$isAnswer.'")';

	$result = mysqli_query($conn, $sql);

	$postid = mysqli_insert_id($conn); //get the id the AUTO INCREMENT field in the las query, or return "0"
	var_dump($postid);

	if($postid == 0){
		$uploadError = "There has been an error while storing your video. Please try again in a few minutes";
		$uploadSuccesfull = False;
		echo $uploadError;
	}

	if(empty($_POST['ownerTags'])){
		$tagError = "Please insert at least one tag";
	} else {
		$ownerTagsStr = test_input($_POST['ownerTags']);
		$ownerTags = explode(';', $ownerTagsStr);
		for( $i = 0 ; $i < count($ownerTags) ; $i++){
			$ownerTag = $ownerTags[$i];
			$sql = 'SELECT tagid FROM _tags WHERE ( tagname = "'.$ownerTag.'")';
			$result = mysqli_query($conn, $sql);
			$check = mysqli_affected_rows($conn);
			if ($check >= 1){
				while($row = mysqli_fetch_assoc($result)){
					$tagid = $row['tagid'];			//aca me va a tirar un error, lo apuesto.
					$sql = ' INSERT INTO _ownerTags ( tagid , postid )
							VALUES ( "'.$tagid.'" , "'.$postid.'")';
					mysqli_query( $conn , $sql);
				}
			} else {
				$sql = 'INSERT INTO _tags ( tagname ) VALUES ("'.$ownerTag.'")';
				mysqli_query($conn, $sql);
				$tagid = mysqli_insert_id($conn);
				$sql = 'INSERT INTO _ownerTags ( tagid, postid ) VALUES ("'.$tagid.'", "'.$postid.'")';
				mysqli_query($conn, $sql);

			}



		}
	}
}

?>