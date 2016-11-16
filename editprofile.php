

<HTML>
<head>
<link rel="stylesheet" type="text/css" href="./CSS/userprofile.css">
<?php include "uploadpicture.php"; ?>
<?php include "getcookies.php"; ?>
<?php include "changeuserinfo.php"; ?>

</head>

<body>
<div class="row">
	<img src="<?php echo $picturePath; ?>">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000" /> 
		<input type="file" name="profilePicUpload" id="profilePicInput">
		<p><?php echo $uploadError; ?></p>
		<input type="submit" name="profilePicSubmit" value="Upload profile picture">
	</form>
</div>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	<textarea name="userDescription" ><?php echo $userDescription; ?></textarea>
	<input type="submit" name="changeDescription" value="Save changes">
</form>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	<p>Country:</p>
	<select name="country">
		<option value="" <?php if($country == ''){ echo "selected";}?>>Select a country</option>
		<option value="Argentina" <?php if($country == "Argentina"){ echo "selected";} ?>>Argentina</option>
		<option value="Australia" <?php if($country == "Australia"){ echo "selected";} ?>>Australia</option>
		<option value="China" <?php if($country == "China"){ echo "selected";} ?>>China</option>
	</select>
	<input type="submit" name="country" value="Save">
</form>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	<p>Spoken language</p>
	<select name="spokenLanguage">
		<option value='' <?php if($spokenLanguage == ''){ echo "selected";} ?>>Select one</option>
		<option value="Spanish" <?php if($spokenLanguage == "Spanish"){ echo "selected";} ?>>Spanish</option>
		<option value="English" <?php if($spokenLanguage == "English"){ echo "selected";} ?>>English</option>
		<option value="Chinese" <?php if($spokenLanguage == "Chinese"){ echo "selected";} ?>>Chinese</option>
	</select>
	<input type="submit" name="country" value="Save">
</form>




</body>

</HTML>