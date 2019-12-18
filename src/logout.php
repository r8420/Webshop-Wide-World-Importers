<?php
session_start();
unset($_SESSION['loggedin'], $_SESSION['userNr'], $_SESSION['adressnaw']);
header('Refresh: 0; url=index.php');
exit();
