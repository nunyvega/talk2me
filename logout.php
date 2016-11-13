
<?php
session_start();
session_destroy();
setcookie('logged', '', time() - 200);
header("location: ./index.php");
?>
