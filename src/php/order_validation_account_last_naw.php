<?php
include "DatabaseFactory.php";
include "../includes/accountFunctions.inc.php";
include "../includes/orderFunctions.inc.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// get the connection from the database
$connection = startDBConnection();

// Get the old naw records from the database customer table
$userID = $_SESSION['userNr'];
$oldNAWrecords = getUserAddress($userID, $connection);

//check if the post is send correctly and the right records are filled in
$orderNAWrecords = checkPOSTRequest($oldNAWrecords);


updateCustomerRecords($connection, $orderNAWrecords, 2);


/**
 * check if the post is send correctly and the right records are filled in
 * If the POST is not filled in correctly, the user gets redirected to the orderpage
 * the function returns a array filled wit NAW-records
 * @param $oldNAWrecords
 * @return array ['streetNumber', 'postcode', 'city', 'provinceState', 'country'] ;
 */
function checkPOSTRequest($oldNAWrecords)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $choice = $_POST['addressChoice'];
        if ($choice === 'newAddress') {
            if (empty($_POST['InputStraatEnHuisnummer']) || empty($_POST['InputPostcode']) ||
                empty($_POST['InputPlaats']) || empty($_POST['InputProvinceState']) || empty($_POST['InputCountry'])) {
                header('Refresh: 0; url=../bestel.php');
                exit();
            }
            $streetNumber = $_POST['InputStraatEnHuisnummer'];
            $postcode = $_POST['InputPostcode'];
            $city = $_POST['InputPlaats'];
        } elseif ($choice === "oldAddress") {
            $streetNumber = $oldNAWrecords[0];
            $postcode = $oldNAWrecords[1];
            $city = $oldNAWrecords[2];
        }

    } else {
        header('Refresh: 0; url=../bestel.php');
        exit();
    }
    return array($streetNumber, $postcode, $city, $choice);
}







?>