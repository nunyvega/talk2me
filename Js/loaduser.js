//  Load user profile:


//get user friends:
var fetchNum = 8;
var fetchedNum = 0;

function getMoreUsers(){
	fetchedNum = fetchedNum +8;
	fetchNum = fetchNum + 8;

}

//xhttp request user friends:
function userFriends(fetchNum){
	var xhttp;
	if  (window.XMLHttpRequest){
		//initialize xmlhttp object for modern browsers
		xhttp = new XMLHttpRequest();
	} else {
		xhttp = new ActiveXObject("Microsoft.XMLHttp");
	}
	xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200){

		}
	}
	xhttp.open("GET", "./php_includes.php?u=" + "<?php echo $vuserid;?>" , true);
	xhttp.send();

}

var userFriendsContainer = document.getElementById("userFriendsContainer");

var vuserFriends = JSON.parse('<?php echo($vuserFriendsJson); ?>');

friendsTotalCount = vuserFriends.length;


alert(friendsAmmount);