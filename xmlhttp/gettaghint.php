<?php 
include ("../php_includes/dbconnect.php");

//variable declarations:
$query ='';
$tagHints = array();


// Get crowd tag hints:

$query = $_GET['query'];

$sql = 'SELECT tagname FROM _tags WHERE ( tagname LIKE "'.$query.'%")';
$result = mysqli_query($conn, $sql);
$numResults = mysqli_affected_rows ($conn);

$i = 0;
while ( $row = mysqli_fetch_assoc($result)){

		$tagHints[$i] = $row['tagname'];
		$i++;
	
}
$tagHints = json_encode($tagHints);
echo($tagHints);


 ?>