<?php
include 'Modules/functions.php';
print_header();
include "includes/orderFunctions.inc.php";

echo gettype($_SESSION['userNr']);
//orderinsert($connection, 0);