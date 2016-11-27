<?php
//Upload content to the server.
//While I'm building the userprofile page, I'll put a input of a youtube link to be able to create the posts in the db.
//will work on the video uploading later on.

// php includes:
include ("./php_includes/dbconnect.php");
include ("./php_includes/uploadhandler.php");
include ("./php_includes/getcookies.php");
?>
<HTML>
<head>

<script type="text/javascript" src="./js/taghints.js"></script>
<style style="display:none;">
	*{
		display:block;
		margin: 15px;
		width: 440px;
		text-align: center;
	}
	textarea{
		height: 120px;
	}
	#tagHintContainer{
		display:block;
		height: 45px;

	}
	#tagHintContainer p{
		background-color: rgb(110,110,110);
		border-radius: 12px;
		cursor: pointer;
		color: white;
		padding: 8px 12px;
		margin: 8px 12px;
	}
</style>	

</head>
<body>

<?php if($uploadSuccesfull == true){ ?>
	<p>The upload was succesfull!</p>
<?php } else {
	# code...
} { ?>
	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

		<input type="text" name="uploadLink" placeholder="Insert youtube embed link">
		<input type="text" name="uploadTitle" placeholder="Insert video title">
		<textarea name="uploadDescription">Insert the video description</textarea>
		<input type="text" name="ownerTags" placeholder="type your tags, semicolon separeted (;)" onkeyup="crowdTagHint(this.value)">
		<div id="tagHintContainer">
		</div>
		<input type="text" name="uploadPlace" placeholder="recorded in:">

		<div>

			<p>Is your video an answer to some question?</p><br>
			<input type="radio" name="isAnswer" value="1" disabled="true">Yes (not working yet) 
																<!--Here we will have to add some js to, if set to yes, pop a
																new input field and let the user select to which question-->
			<input type="radio" name="isAnswer" value="0" checked="true">No
		</div>

			<input type="submit" name="uploadVideo" value="Upload video">

	</form>
<?php } ?>


</body>
</HTML>