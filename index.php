<!DOCTYPE HTML>
<html>
    <head>
      <title> Talk2Me</title>

<!-- CSS includes -->

      <link href="./css/style.css" type="text/css" rel="stylesheet"/>
      <link href="./css/header.css" type="text/css" rel="stylesheet"/>
      <link href="./css/loginregister.css" type="text/css" rel="stylesheet"/>


<!-- CDN includes    -->

      <link href="https://fonts.googleapis.com/css?family=Baloo+Thambi" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Montserrat: 400, 700" rel="stylesheet">

<!-- Javascript includes -->

      <script type='text/javascript' src='./js/main.js'></script>
      <script src="./js/header.js"></script>

<!-- PHP includes -->

  <?php include './php_includes/userauth.php'; ?>
  <?php include './php_includes/getcookies.php'; ?>
  <?php include './php_includes/loaduser.php'; ?>
  <?php include './php_includes/socialfeatures.php';?>
  <?php include("loginregister.php"); ?>


    </head>
    <!-- open login or regsiter if there's a login or registration in progress.--> 
<body <?php if($loginStarted == True){ echo 'onload="openLogin()"';}?> 
      <?php if($signupStarted == True){ echo 'onload="openSignup()"';}?> 
      >

    <!-- webpage -->

    <div id="MainContainer">
    <!-- HEADER  -->

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

      <!-- Body  -->
      
      <div id="content">
        <section id="main">
          <div class="row" id="mainContainer">
            <div id="videoContainer">
              <div id="vInfoContainer">
                <p>here we'll insert the video title, description, etc?</p>
              </div>
              <iframe id="videoPlayer" src="https://www.youtube.com/embed/T3lCpuunSMo" frameborder="0"></iframe>
              <div id="vSocialContainer">               
                <ul id="socialButtons">
                  <li class="bttn" id="socialBttn">Collect</li>
                  <li class="bttn" id="socialBttn">Share</li>
                  <!-- deleted "like" button, since the attributes will be in the tags and questions -->
                </ul>
                <div id="crowdTagsContainer">
                  <div id="crowdTagBox">
                    <p>Crowd Tag 3 <span class="tagAction bttn">give attr bttn</span></p>
                    <p>Crowd Tag 2<span class="tagAction bttn">give attr bttn</span></p>
                    <p>Crowd Tag 3<span class="tagAction bttn">give attr bttn</span></p>
                  </div>
                  <form id="newCrowdTag" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input id="newCrowdTagInput" type="text" name="newCrowdTag" placeholder="Enter a tag to add to the post">
                    <input type="submit" value="add tag">
                  </form>
                </div>

<!--
Comment this section to change it for _crowdtags section.
                <table id="videoInfo">
                  <tr>
                    <td>Date recorded:<span id="recordedDate">2016/11/07</span></td>
                    <td>Recorded in:<span id="recordedPlace">Melbourne</span></td>
                  </tr>
                  <tr>
                    <td>Recorded with:<span id="recordedDevice">Macbook Pro webcam</span></td>
                    <td>Recorded for:<span id="recordedFor">Question user</span></td>
                  </tr>
                </table>
-->
               </div>

            </div>
            <div id="relatedContainer">
              <div class="relCon_section" id="relCon_profile">
                <div class="row relCon_title" id=talkingTo>Talking to: 
                  <span id="userName"><?php echo ($vname." ".$vlastname." (".$vusername.")"); ?></span>
                  <form method="POST" id="followBttn" action="<?php echo $_SERVER['PHP_SELF'].'?u='.$vuserid;?>">
                    <input id=followBttn name="follow" type="submit"
                    <?php if($followed == true){ echo('disabled="true"');} ?>
                      <?php if($followed == true){ echo 'value="Following"';}
                                            else{ echo 'value="follow"'   ;}
                      ?>></form>
                  </div>  
                <div class="row">
                  <div id="profilePicture"><img src="<?php echo $vpicturePath; ?>"></div>
                  <div id="profileDescription">
                    <h4><?php echo $vdescription; ?></h4>
                  </div>
                </div>
                      
              </div>

              <div class="relCon_section" id="relCon_prompt">
                <h3 class="relCon_title" id="talkAbout">Let's talk about:</h3>
                <p>Enter a word to search as a trigger for a conversation with me!</p>

                <p>I will tell you about the term, according by what I understand by it :)</p>
                <div id="prompt_container">


                  <input id="questionField" type="text" name="question" onkeypress="isEnter()"> <!--el onsubmit no funciona, apretando enter no dispara la opcion, solo dandole clic al boton que esta afuera del form (agregue un botn adentro del form con las mismas propiedades y no funciona)
                  Solano 08/011: ya le vamos a sacar la ficha de como hacerlo. Lo que estoy intentando es utilizar la funcion
                  onkeypress y adentro de esa función usar key.code() para saber si la tecla que se apretó fue enter. 
                  cualquier cosa pedime y te paso el link de donde saque la idea -->
                  <button onclick="questions()">Submit</button>

                </div>
              </div>

              <div class="relCon_section" id="relCon_alsoLike">
                <h3 class="relCon_title" id="alsoLike">I also like to talk about:</h3>
                <ul id="userSubjects">  <!--en esta clase tendríamos que programar el javascript que cargue los subjects según el usuario que se está viendo. La información tendría que llegar de un query que se haga al cargar la página para que cada subject ya tenga un "case" asignado -->
                  <li class="bttn" onclick="linkcases(1)">subject 1</li>
                  <li class="bttn" onclick="linkcases(2)">subject 2</li>
                  <li class="bttn" onclick="linkcases(3)">subject 3</li>
                  <li class="bttn" onclick="linkcases(4)">subject 4</li>
                  <li class="bttn" onclick="linkcases(5)">subject 5</li>
                  <li class="bttn" onclick="linkcases(6)">subject 6</li>
                  <li class="bttn" onclick="linkcases(7)">subject 7</li>
                  <li class="bttn" onclick="linkcases(8)">subject 8</li>
                </ul>
              </div>
          </div>
        </div>
      </section>
      <hr class="sectionDivision">
      <section id="userFriends">
        <h2>Alvaro likes to talk to:</h2>
        <ul id="userFriendsContainer">
        <?php for($i = 0; $i < count($vuserFriends); $i++){
            echo '<li>';
              echo '<div class="row friendProfile">';
               echo '<div id="friendProfilePicture">';
                echo '<a href="'.$vuserFriends[$i]['fprofileLink'].'">';
                  echo '<img src="'.$vuserFriends[$i]['fpicturePath'].'"></div></a>';
                    echo '<div id="friendProfileInfo">';
                      echo '<ul>';
                        echo '<li>Name:<span id="friendName">'.$vuserFriends[$i]['fname'].' '.$vuserFriends[$i]['flastname'].'</span></li>';
                        echo '<li>Talks about:<span id="friendTalks">';
                          echo '<ul>';
                            echo '<li>Neural Networks</li>';
                            echo '<li>Artificial Intelligence</li>';
                            echo '<li>One Person Market Revolution</li>';
                          echo '</ul></span>';
                        echo '</li>';
                      echo '</ul>';
                    echo '</div>';
                  echo '</div>';
                echo '</li>';
          }
          ?>
        </ul>
        <center><p>See more</p></center>

      </section>
    </div>


      <div id="footer">
        <p>copyright</p>

      </div>
    </div>

</html>
