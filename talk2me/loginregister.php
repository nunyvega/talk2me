
<!--a user signup and login form toggled with functions in header.js
//needs to be included along with: header.js and userauth.php-->

    <!-- Login form dialog - hidden by default --> 
<html>
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

    <!-- Signup form dialog - hidden by default -->

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

</html>

