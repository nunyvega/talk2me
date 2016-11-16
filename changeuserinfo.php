<?php
include("./dbconnect.php");
include("./getcookies.php");


if(isset($_POST['userDescription'])){
	$userDescription = $_POST['userDescription'];

	$userDescription = mysqli_real_escape_string($conn, $userDescription);

	$sql = "UPDATE profiles SET description='$userDescription' WHERE username='$username' LIMIT 1";

	mysqli_query($conn, $sql);

	setcookie('userDescription', $userDescription);

	header("location: ./editprofile.php");
}

if(isset($_POST['country'])){
	$country = $_POST['country'];
	$country = mysqli_real_escape_string($conn, $country);

	$sql = "UPDATE profiles SET country = '$country' WHERE username='$username' LIMIT 1";
	mysqli_query($conn, $sql);

	setcookie('country', $country);
	header("location: ./editprofile.php");
}

?>
