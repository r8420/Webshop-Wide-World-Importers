<?php
include "DatabaseFactory.php";
include "../includes/orderFunctions.inc.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
        $streetNumber = $_POST['InputStraatEnHuisnummer'];
        $postcode = $_POST['InputPostcode'];
        $city = $_POST['InputPlaats'];
    } else {
        header('Refresh: 0; url=../bestel.php');
        exit();
    }
    return array($streetNumber, $postcode, $city);
}


?>