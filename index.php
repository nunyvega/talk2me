<!DOCTYPE HTML>
<html>
    <head>
      <title> Talk2Me</title>
      <link href="./css/style.css" type="text/css" rel="stylesheet"/>
      <link href="./css/header.css" type="text/css" rel="stylesheet"/>

      <link href="https://fonts.googleapis.com/css?family=Baloo+Thambi" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Montserrat: 400, 700" rel="stylesheet">
        <!-- cambie todas las tipos a helvetica por ahora, mepa que le vamos a dar una estetica un toque mas seria, 
        asi q no tamos usando esas tipos-->
      <script type='text/javascript' src='script.js'></script>
      <script src="./header.js"></script>
      <?php include 'userauth.php' ?>
      <?php session_start(); ?>

    </head>
    <!-- open login or regsiter if there's a login or registration in progress.--> 
<body <?php if($loginStarted == True){ echo 'onload="openLogin()"';}?> 
      <?php if($signupStarted == True){ echo 'onload="openSignup()"';}?> 
      >

    <!-- Login form dialog --> 

    <div id="loginFormContainer">
      <div id="loginFormContent">
      <?php if($loginReady == True) { ?>
        <div id="loginFormHeader">
          <h2>Login Succesfull title:</h2><span id="close" onclick="closeLogin()">X</span>
        </div>

        <div id="loginFormBody">
            <p>Your login was succesfull!</p>
            <a onclick="closeLogin()">close</a>
        </div>

      <?php } else { ?>
        <div id="loginFormHeader">
          <h2>Login Title</h2><span id="close" onclick="closeLogin()">X</span>
        </div>

        <div id="loginFormBody">
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
            <input class="loginInput" type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
            <input class="loginInput" type="password" name="password" placeholder="Password">
            <p id="loginError"><?php echo $loginError; ?></p>
            <input type="hidden" name="formChoice" value="login">
            <center><input id="loginSubmit" type="submit" value="Log in"></center>
          </form>
        </div>
      <?php } ?>

        <div id="loginFormFooter">
          <p>Click here for more info?</p>
        </div>
      </div>
    </div>

    <!-- Signup form dialog -->

    <div id="signupFormContainer">
      <div id="signupFormContent">
      <?php if($signupReady == True){ ?>
        <div id="signupFormHeader">
          <h2>Signup succesfull Title:</h2><span id="close" onclick="closeSignup()">X</span>
        </div>

        <div id="signupFormBody">
        <p> Your signup was succesfull. Thanks for joining ! </p>
        <a onclick="closeSignup()">Close</a>
        </div>


      <?php } else { ?>
        <div id="signupFormHeader">
          <h2>Signup Title:</h2><span id="close" onclick="closeSignup()">X</span>
        </div>

        <div id="signupFormBody">
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <input class="signupInput" type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
            <p class="signuperror"><?php echo $usernameError; ?></p>
            <input class="signupInput" type="text" name="email" placeholder="E-mail" value="<?php echo $email; ?>">
            <p class="signuperror"><?php echo $emailError; ?></p>
            <input class="signupInput" type="text" name="name" placeholder="Name" value="<?php echo $name; ?>">
            <p class="signuperror"><?php echo $nameError; ?></p>
            <input class="signupInput" type="text" name="lastname" placeholder="Last name" value="<?php echo $lastname; ?>">
            <p class="signuperror"><?php echo $lastnameError; ?></p>
            <input class="signupInput" id="signupPsw" type="password" name="password" placeholder="Password">
            <input class="signupInput" id="signupPswRpt" type="password" name="passwordRepeat" placeholder="Repeat Password" onkeydown="setInterval(checkPswd, 300)" onblur="clearInterval()">
            <p class="signupError" id="paswError"><?php echo $passwordError; ?></p>
            <input type="hidden" name="formChoice" value="signup">
            <center><input id="signupSubmit" type="submit" value="Sign Up" disabled="true"></center>
          </form>
        </div>
      <?php } ?>

        <div id="signupFormFooter">
          <a href="#">Click here for more info?</a>
        </div>
      </div>
    </div>

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
                  <li><img src="./images/icons/edit_profile.png"><a class="dropDownText" href="./userprofile.php">My profile</a></li>
                  <li><img src="./images/icons/upload_video.png"><a class="dropDownText" href="./uploadvideo.php">Upload Video</a></li>
                  <li><img src="./images/icons/log_out.png"><a class="dropDownText" href="./logout.php">log out</a></li>
                </ul>
              </div>
              <p id="headerUsername"><?php echo "Solano Palacio" ?></p>
              <img src="solanoprofile.jpg">


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
               <iframe id="videoPlayer" src="https://www.youtube.com/embed/T3lCpuunSMo" frameborder="0"></iframe>
               <div id="vInfoContainer">
                <ul id="socialButtons">
                  <li class="bttn" id="socialBttn">Like</li>
                  <li class="bttn" id="socialBttn">Share</li>
                  <li class="bttn" id="socialBttn">Embed</li>
                </ul>
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

               </div>

            </div>
            <div id="relatedContainer">
              <div class="relCon_section" id="relCon_profile">
                <div class="row relCon_title" id=talkingTo>Talking to: <span id="userName">Alvaro Vega</span></div>
                <div class="row">
                  <div id="profilePicture"><img src="./nunyprofile.jpg"></div>
                  <div id="profileDescription">
                    <h4>Hi! I'm Alvaro. Some people calls me allan, though. I like a lot to talk. This is something of what I have to say</h4>
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
        <ul>
          <li>
            <div class="row friendProfile">
              <div id="friendProfilePicture"><img src="./solanoprofile.jpg"></div>
              <div id="friendProfileInfo">
                <ul>
                  <li>Name:<span id="friendName">Solano Palacio</span></li>
                  <li>Talks about:<span id="friendTalks">
                                        <ul>
                                          <li>Neural Networks</li>
                                          <li>Artificial Intelligence</li>
                                          <li>One Person Market Revolution</li>
                                        </ul></span>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="row friendProfile">
              <div id="friendProfilePicture"><img src="./solanoprofile.jpg"></div>
              <div id="friendProfileInfo">
                <ul>
                  <li>Name:<span id="friendName">Solano Palacio</span></li>
                  <li>Talks about:<span id="friendTalks">
                                        <ul>
                                          <li>Neural Networks</li>
                                          <li>Artificial Intelligence</li>
                                          <li>One Person Market Revolution</li>
                                        </ul></span>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="row friendProfile">
              <div id="friendProfilePicture"><img src="./solanoprofile.jpg"></div>
              <div id="friendProfileInfo">
                <ul>
                  <li>Name:<span id="friendName">Solano Palacio</span></li>
                  <li>Talks about:<span id="friendTalks">
                                        <ul>
                                          <li>Neural Networks</li>
                                          <li>Artificial Intelligence</li>
                                          <li>One Person Market Revolution</li>
                                        </ul></span>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="row friendProfile">
              <div id="friendProfilePicture"><img src="./solanoprofile.jpg"></div>
              <div id="friendProfileInfo">
                <ul>
                  <li>Name:<span id="friendName">Solano Palacio</span></li>
                  <li>Talks about:<span id="friendTalks">
                                        <ul>
                                          <li>Neural Networks</li>
                                          <li>Artificial Intelligence</li>
                                          <li>One Person Market Revolution</li>
                                        </ul></span>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="row friendProfile">
              <div id="friendProfilePicture"><img src="./solanoprofile.jpg"></div>
              <div id="friendProfileInfo">
                <ul>
                  <li>Name:<span id="friendName">Solano Palacio</span></li>
                  <li>Talks about:<span id="friendTalks">
                                        <ul>
                                          <li>Neural Networks</li>
                                          <li>Artificial Intelligence</li>
                                          <li>One Person Market Revolution</li>
                                        </ul></span>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="row friendProfile">
              <div id="friendProfilePicture"><img src="./solanoprofile.jpg"></div>
              <div id="friendProfileInfo">
                <ul>
                  <li>Name:<span id="friendName">Solano Palacio</span></li>
                  <li>Talks about:<span id="friendTalks">
                                        <ul>
                                          <li>Neural Networks</li>
                                          <li>Artificial Intelligence</li>
                                          <li>One Person Market Revolution</li>
                                        </ul></span>
                  </li>
                </ul>
              </div>
            </div>
          </li>

        </ul>
        <center><p>See more</p></center>

      </section>
    </div>


      <div id="footer">
        <p>copyright</p>

      </div>
    </div>

</html>
