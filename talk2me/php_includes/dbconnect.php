<?php
//connect to database:

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

if (!mysqli_set_charset($conn, "utf8")) {
    printf("Error loading character set utf8: %s\n", mysqli_error($conn));
    exit();
} 

?>