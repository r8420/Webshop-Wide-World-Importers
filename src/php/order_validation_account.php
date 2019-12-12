<?php
include "DatabaseFactory.php";
include "../includes/orderFunctions.inc.php";

$connection = startDBConnection();

$orderNAWrecords = checkPOSTRequest();




/**
 * Checkt of er een valid post is gestuurd met de login pagina.
 * Indien niet word de gebruiker terug verwezen naar de login pagina
 * De functie geeft een array terug met de username en password
 * @return array ['username', 'password'] ;
 */
function checkPOSTRequest()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    } else {
        header('Refresh: 0; url=../login.php');
        exit();
    }
    return array($email, $password);
}


?>