

<HTML>
<head>
<link rel="stylesheet" type="text/css" href="./CSS/userprofile.css">
<?php include "uploadpicture.php" ?>
<?php include "userauth.php" ?>

</head>

<body>
<form action="userprofile.php" method="POST" enctype="multipart/form-data">
	<input type="file" name="profilePicUpload" id="profilePicInput">
	<input type="submit" name="profilePicSubmit" value="Upload profile picture">
	<p><?php echo $uploadError; ?></p>


</form>






</body>

</HTML>