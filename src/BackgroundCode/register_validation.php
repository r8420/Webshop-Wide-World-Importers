<?php
include "../DatabaseFactory.php";

// start database connectie
$connection = startDBConnection();

// Haalt POST Request op
$userRegistration = checkPOSTRequest();

// voert emailvalidatie uit en een select query uit op de database
$valid_login = emailValidation($connection, $userRegistration);

// insert account on people table
insertionOnPeopleTable($connection, $valid_login, $userRegistration);


/**
 * Checkt of er een valid post is gestuud met de Register pagina.
 * Indien niet word de gebruiker terug verwezen naar de Register pagina
 * De functie geeft een array terug met de email, email_valedatie, naam, telefoon, wachtwoord en wachtwoord_validatie
 * @return array ['email', 'email_validation', 'name', 'tel', 'password', 'password_validation'] ;
 */
function checkPOSTRequest()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $email_validation = $_POST['email_validation'];
        $name = $_POST['name'];
        $tel = $_POST['telephone'];
        $password = $_POST['password'];
        $password_validation = $_POST['password_validation'];
    } else {
        header("Refresh: 0; url=../registreren.php");
        exit();
    }
    return array($email, $email_validation, $name, $tel, $password, $password_validation);
}

/**
 * controleert of de email  met elkaar overeenkomen
 * voert met dat gegeven een query uit op de database
 * @param $connection object voor connectie
 * @param $dbName
 * @param $userRegistration
 * @return array met de numrows en loginnaam
 */
function emailValidation($connection,  $userRegistration)
{
    if ($userRegistration[0] == $userRegistration[1]) {
        $selectquery = "CALL email_validation(?)";
        $stmtselect = $connection->prepare($selectquery);
        $stmtselect->bind_param("s", $userRegistration[0]);
        $stmtselect->execute();
        $stmtselect->bind_result($logonName);
        $stmtselect->store_result();
        $stmtselect->fetch();
        $numRows = $stmtselect->num_rows;
    } else {
        returnToRegister(3);
    }
    return array($numRows, $logonName);
}

/**
 * In deze functie word het account in de database gestopt indien de twee ingegeven wachtwoorden overeenkomen
 * Het wachtwoord wordt vervolgens geëncrypt voordat er een sql prepared query word uitgevoerd op de database
 * @param $connection object voor connectie
 * @param $emailValidation
 * @param $userRegistration
 */
function insertionOnPeopleTable($connection, $emailValidation, $userRegistration)
{

    if ($emailValidation[0] == 0) {
        if ($userRegistration[4] == $userRegistration[5]) {

            /**
             * Encrypt het wachtwoord met PASSWORD_DEFAULT
             */
            $hashedPassword = password_hash($userRegistration[4], PASSWORD_DEFAULT);


            $insertsql = "CALL insert_account(?,?,?,?)";
            $stmtinsert = $connection->prepare($insertsql);
            $stmtinsert->bind_param("ssss", $userRegistration[2], $userRegistration[0], $hashedPassword, $userRegistration[3]);
            $stmtinsert->execute();
            $stmtinsert->close();
            $connection->close();

            header("Refresh: 0; url=../registreer_succes.php");
            exit();
        } else {
            returnToRegister(2);
        }
    } else {
        returnToRegister(1);
    }
}

/**
 * bij elke fout in het registreer proces word er een code meegestuurd,
 * deze code word meegegeven in de url als error code
 * @param $errorNumber
 */
function returnToRegister($errorNumber)
{
    session_start(); $errorCode = "";
    if ($errorNumber == 1) {
        $errorCode = "register_exist_email_error";
    } elseif ($errorNumber == 2) {
        $errorCode = "register_different_password_error";
    } elseif ($errorNumber == 3) {
        $errorCode = "register_different_email_error";
    }

    header("Refresh: 0; url=../registreren.php?errorcode=".$errorCode);
    exit();
}

?>

