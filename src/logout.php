<?php
session_start();
unset($_SESSION['loggedin'], $_SESSION['userNr']);
header('Refresh: 0; url=account.php');
exit();
