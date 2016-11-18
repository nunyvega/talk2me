<?php
//this php include loads the full profile of a user.
//it is intended to fill a user profile when visited

// Globals:

$vuserid = $vusername = $vname = $vlastname = $vdescription = $vcountry = $vprofileLink 
			= $vspokenLanguage = $vpicturePath = $vprofileLink= '';

$vuserFriends = array (); //contains an array with the user friends data in arrays 
$friendCount  = 0;		//the count of the vuser friends

$vuserTopics = array();
$topicsCount = 0;

$vuserPosts = array();
$postsCount = 0;


//if the userid is set via GET: start script:

if(isset($_GET['u']) ){
	//get the user id
	$vuserid = $_GET['u'];
	
	//get the user information from users database table:

	$sql = 'SELECT * FROM users where ( userid = "'.$vuserid.'" )';
	$result = mysqli_query($conn, $sql);
	$check = mysqli_affected_rows($conn);
	if ($check != 1){
		$loadError = "There has been an error. Please notify the web administrator at mail@mail.com";
	}
	$row = mysqli_fetch_assoc($result);

	$vusername = $row['username'];
	$vname = $row['name'];
	$vlastname = $row['lastname'];

	//get the user profile information from profiles database table

	$sql = 'SELECT * FROM profiles where ( username = "'.$vusername.'")';
	$result = mysqli_query($conn, $sql);
	$check = mysqli_affected_rows($conn);
	if($check != 1){
		$loadError = "There has been an error. Please notify the web administrator at mail@mail.com";
	}

	$row = mysqli_fetch_assoc($result);
	$vpicturePath = $row['picturepath'];
	$vdescription = $row['description'];
	$vcountry = $row['country'];
	$vlanguage = $row['language'];
	$vprofileLink = $row['profilelink'];

	//get the user friends: (create $vuserFriends array)

	//select friends from db, query it and count the result:

	$sql = 'SELECT followedUsername, followedUserID FROM friends WHERE (followerUserID ="'.$vuserid.'")';
	$result = mysqli_query($conn, $sql);
	$friendCount = mysqli_affected_rows($conn);

	for($i = 0; $i < $friendCount; $i++ ){ //Make a loop to create one array key for every friend:

		
		while($row = mysqli_fetch_assoc($result)){
			//loop throught the result, geting each friend user data from the db:
			$fusername = $row['followedUsername'];
			$fuserid = $row['followedUserID'];

			$sql = 'SELECT * FROM users WHERE ( username = "'.$fusername.'")';
			$query = mysqli_query($conn, $sql);
			$friend = mysqli_fetch_assoc($query);

			$fname = $friend['name'];
			$flastname = $friend['lastname'];

			$sql = 'SELECT * FROM profiles WHERE ( username = "'.$fusername.'")';
			$query = mysqli_query($conn, $sql);
			$friend = mysqli_fetch_assoc($query);

			$fpicturePath = $friend['picturepath'];
			$fdescription = $friend['description'];
			$fprofileLink = $friend['profilelink'];

			//store the friend user data in an array:
			$friend = array( 'fuserid' => $fuserid ,
							 'fusername' => $fusername,
							 'fname' => $fname,
							 'flastname' => $flastname,
							 'fpicturePath' => $fpicturePath,
							 'fdescription' => $fdescription,
							 'fprofileLink' => $fprofileLink
							);
			//push the entire friend array as one key to the $vuserFriends array:
			array_push($vuserFriends, $friend);

		}
	}

	//get the user topics:


	//get the user posts:


}
