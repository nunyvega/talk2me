//Javascript for tags ajax request in uploadvideo.php




function crowdTagHint(searchStr) {
	if (searchStr == '') {
		document.getElementById("tagHintContainer").innerHTML = "Start typing a tag to see the available tags";
		return;
	} else {
		var xhttp 
		if (window.XMLHttpRequest){ //initialize xmlhttp object for IE7+, chrome, Opera and Safari
			xhttp = new XMLHttpRequest();
		} else {
			xhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xhttp.onreadystatechange = function (){
			if (this.readyState == 4 && this.status == 200){
				response = xhttp.responseText;
				tags = JSON.parse(response);
				var i = 0;
				var tagCount = tags.length;
				var tagHints;
				for ( i ; i < tagCount ; i++){
					tagHints += "<p>" + tags[i] + "</p>";
				}
				document.getElementById("tagHintContainer").innerHTML = tagHints;
			}
		}
	xhttp.open("GET" , "./xmlhttp/getTagHint.php?query=" + searchStr, true);
	xhttp.send();

	}

}
