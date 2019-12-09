<?php
session_start();
unset($_SESSION['loggedin']);
unset($_SESSION['userNr']);
header("Refresh: 0; url=../Pages/account_page.php");
exit();
?>
