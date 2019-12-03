<?php
session_start();
session_unset();
session_destroy();
header("Refresh: 0; url=../Pages/account_page.php");
exit();
?>
