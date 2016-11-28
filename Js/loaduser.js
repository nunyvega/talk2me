//  Load user profile:


//get user friends:

//variable declarations:

var fetchNum = 8;
var fetchedNum = 0;


function getMoreUsers(){

	fetchNum += 8;
	userFriends();

}

//xhttp request user friends:
function userFriends(){
	console.log('function userFriends called');
	var xhttp;
	if  (window.XMLHttpRequest){
		//initialize xmlhttp object for modern browsers
		xhttp = new XMLHttpRequest();
		console.log('xhttp created');
	} else {
		xhttp = new ActiveXObject("Microsoft.XMLHttp");
	}
	xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200){
			//when the response is ready:
			console.log('response ready');
			var friends = JSON.parse(xhttp.responseText);
			var friendsCount = friends.length;
			console.log('friendsCount ='+friendsCount);
			console.log('friends=' + friends);
			var friendsProfile;
			if ( fetchNum >= friends.length){
				fetchNum = friends.length;
				document.getElementById("seeMoreFriends").style="display:none";
			}
			console.log('fetchNum ='+fetchNum);
			console.log('fetchedNum ='+fetchedNum);
			console.log(friends.length);

			for ( fetchedNum ; fetchedNum < fetchNum ; fetchedNum++){
				var friendProfile = '<li><div class="row friendProfile"><div id="friendProfilePicture"><a href="'
								+ friends[fetchedNum]['fprofileLink']
								+ '""><img src="'
								+ friends[fetchedNum]['fpicturePath']
								+ '"></div></a><div id="friendProfileInfo"><ul><li>Name:<span="friendName">'
								+ friends[fetchedNum]['fname']
								+ friends[fetchedNum]['flastname']
								+ '</span></li><li>talks about:</span id= "friendTalks"><ul><li> user topics </li>'
								+ '</ul></span></li></ul></div></div></div></li>'
								;
				var profiles = document.createElement("div");
				profiles.setAttribute("id", fetchedNum);
				document.getElementById("userFriendsContainer").appendChild(profiles) ;
				document.getElementById(fetchedNum).innerHTML = friendProfile;


			}
			console.log(friendsProfile);


		}
	}
	xhttp.open("GET", "./php_includes/loaduser.php?u=" + vuserid , true);
	xhttp.send();

}

