<?php 

//this file uploads the user profile pictures to $target_dir with the name $targetUrl
include("./imageresize.php");
include ("./dbconnect.php");


//Get cookies:
$logged = $_COOKIE["logged"];
$userid = $_COOKIE["userid"];
$username = $_COOKIE["username"];


//Variables:

//config:
$minWidth = 450;
$minHeight = 450;
$maxWidth = 1350;
$maxHeight = 1350;
$maxFileSize = 1000000;


$uploadError = "";
$fileErrorMsg = "";
$prueba = "";
$inloop = "";
//flow control: 

$uploadSuccesfull = True;

//other:



//script starts:

//uncoment this statement to see the information of the file, to check if it's been uploaded succesfully:
if (isset($_FILES["profilePicUpload"]["name"]) && $_FILES["profilePicUpload"]["tmp_name"] != ""){ 
//if(isset($_POST["profilePicSubmit"])) {

	
//Get $_File[]:

	$fileName = $_FILES["profilePicUpload"]["name"];
    $fileTempLocation = $_FILES["profilePicUpload"]["tmp_name"];
	$fileType = $_FILES["profilePicUpload"]["type"];
	$fileSize = $_FILES["profilePicUpload"]["size"];
	$fileErrorMsg = $_FILES["profilePicUpload"]["error"];

//get image size:

	$imageSize = getimagesize($fileTempLocation);

	$w = $imageSize['0'] ;
	$h = $imageSize['1'];
	if ($w < $minWidth || $h < $minHeight){
		$uploadSuccesfull = False;
		$uploadError = "Sorry, the image you selected is too small, please select one of at least (450 x 450)px";;
	} 


//create target file path:

	$targetUrl = "./users/".$userid.$username."/profilepics/";
	$fileNameExt = end(explode(".",$fileName));

	//check that the file extension is correct
	if ($fileNameExt != "jpg" && $fileNameExt != "jpeg" && $fileNameExt !="gif" && $fileNameExt !="png"){
		$uploadError = "Sorry, the file type you submitted is not admitted. Please try with a jpg, jpeg, gif or png image :).";
		$uploadSuccesfull = False;
	} 

	$date = getdate();
	$fileDate = $date["year"].$date["mon"].$date["mday"].$date["hours"].$date["minutes"];
	$fileName = $username.$fileDate.".".$fileNameExt;
	$filePath = $targetUrl.$fileName;




// Check the uploaded filesize:


	if ($fileSize > $maxFileSize){
		$uploadError .= "Sorry, The image you uploaded is too big. Please select one of less than 1 Mb.";
		$uploadSuccesfull = False;
	}


//Corroborate that the file is a image:

	if(getimagesize($fileTempLocation) == false){
		$uploadError .= "Sorry, the file you selected appears not to be an image";
		$uploadSuccesfull = False;
	}

	if( $fileErrorMsg == 1){
		$uploadError .="Sorry, an unknown error has occured.";
		$uploadSuccesfull = False;
	}

//move file to destination path and rename it:

	$moveResult = move_uploaded_file($fileTempLocation, $filePath);

	if ($moveResult != true){
		$uploadError = "Sorry, Upload failed due to a server error. Please try again later";
		$uploadSuccesfull = False;
	}


	
//resize image:
	img_resize($filePath, $filePath, $maxWidth, $maxHeight, $fileNameExt);

//update filepath to current profile picture in users profile database:
	$sql = "UPDATE profiles SET picturepath='$filePath' WHERE username='$username' LIMIT 1";
	$query = mysqli_query($conn, $sql);

//update picturepath cookie:
	setcookie('picturePath', $filePath);

header("location: ./editprofile.php");

//Close mysqli connection:

	mysqli_close($conn);


}

?>



