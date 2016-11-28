
      <div id="header">
        <div id="headerContainer">
          <div id="brandContainer"> <a href='index.php'><h1>Talk2me</h1></a></div>
          <form action="./search.php" id="searchBar"><input type="text" name="searchKeyword" id="searchField" placeholder="search"></form>
          <div id="loginContainer">
          <!-- if the user has logged in: -->
          <?php if (isset($_COOKIE['logged']) or $loginReady == True){ ?>            
            <div class="row" id="headerProfile">
              <div id="dropDownMenu">
                <img src="./images/icons/arrow_down.png" id="arrowDown" onclick="openProfileMenu()">
                <ul id="dropDownContent">
                  <li><img src="./images/icons/edit_profile.png"><a class="dropDownText" href="./editprofile.php">My profile</a></li>
                  <li><img src="./images/icons/upload_video.png"><a class="dropDownText" href="./uploadvideo.php">Upload Video</a></li>
                  <li><img src="./images/icons/log_out.png"><a class="dropDownText" href="./logout.php">log out</a></li>
                </ul>
              </div>
              <p id="headerUsername"><?php echo $username; ?></p>
              <img src="<?php echo $picturePath; ?>">


            </div>

          <?php } else { ?>
          <!-- if the user has not logged in: -->
            <p class="bttn loginBttn" id="login" onclick="openLogin()">Log-in</p>
            <p class="bttn loginBttn" id="signup" onclick="openSignup()">Sign-Up</p>
          <?php } ?>
          </div>
        </div>
      </div>