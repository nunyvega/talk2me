
      <?php 



function testInput($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
    }

      //get cookies:
      if (isset($_COOKIE["logged"])){

        $logged = $_COOKIE["logged"];
        $userid = $_COOKIE["userid"];
        $username = $_COOKIE["username"];
        $name = $_COOKIE["name"];
        $lastname = $_COOKIE["lastname"];
        $picturePath = $_COOKIE["picturePath"];
        $profileLink = $_COOKIE["profileLink"];
        $userDescription = $_COOKIE["userDescription"];
        $country = $_COOKIE["country"];
        $spokenLanguage = $_COOKIE["spokenLanguage"];

        
      }

      if (isset($_GET['u'])){
        $vuserid = testInput($_GET['u']);

      }


      ?>