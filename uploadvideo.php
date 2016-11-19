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
</style>	

</head>
<body>

	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

		<input type="text" name="uploadLink" placeholder="Insert youtube embed link">
		<input type="text" name="uploadTitle" placeholder="Insert video title">
		<textarea name="uploadDescription">Insert the video description</textarea>
		<input type="text" name="ownerTags" placeholder="type your tags, semicolon separeted (;)">
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



</body>
</HTML>