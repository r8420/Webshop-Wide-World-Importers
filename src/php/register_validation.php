<?php
include 'DatabaseFactory.php';

// start database connectie
$connection = startDBConnection();

// Haalt POST Request op
$userRegistration = checkPOSTRequest();

// voert emailvalidatie uit en een select query uit op de database
$valid_login = emailValidation($connection, $userRegistration);

// Voert wachtwoordvalidatie op het wachtwoord aan de hand van de eisen
$valid_password = passwordValidation($userRegistration);

// insert account on people table
insertionOnPeopleTable($connection, $valid_login, $valid_password, $userRegistration);


/**
 * Checkt of er een valid post is gestuurd met de Register pagina.
 * Indien niet word de gebruiker terug verwezen naar de Register pagina
 * De functie geeft een array terug met de email, email_validatie, naam, telefoon, wachtwoord en wachtwoord_validatie
 * @return array ['email', 'email_validation', 'name', 'tel', 'password', 'password_validation'] ;
 */
function checkPOSTRequest() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $email_validation = $_POST['email_validation'];
        $name = $_POST['name'];
        $tel = $_POST['telephone'];
        $password = $_POST['password'];
        $password_validation = $_POST['password_validation'];
    } else {
        header('Refresh: 0; url=../registreren.php');
        exit();
    }
    return array($email, $email_validation, $name, $tel, $password, $password_validation);
}

/**
 * controleert of de email  met elkaar overeenkomen, en of de email valide is
 * voert met dat gegeven een query uit op de database
 * @param $connection object voor connectie
 * @param $userRegistration
 * @return array met de numrows en loginnaam
 */
function emailValidation($connection, $userRegistration) {
    if ($userRegistration[0] === $userRegistration[1]) {
        $selectquery = 'CALL email_validation(?)';
        $stmtselect = $connection->prepare($selectquery);
        $stmtselect->bind_param('s', $userRegistration[0]);
        $stmtselect->execute();
        $stmtselect->bind_result($logonName);
        $stmtselect->store_result();
        $stmtselect->fetch();
        $numRows = $stmtselect->num_rows;

        if(!filter_var($userRegistration[0], FILTER_VALIDATE_EMAIL)) {
            returnToRegister(4);
        }
    } else {
        returnToRegister(3);
    }
    return array($numRows, $logonName);
}

/**
 * Controleert of de wachtwoorden met elkaar overeen komen, en of het wachtwoord de minimum waarden volgt
 * @param $userValidation
 * @return bool
 */
function passwordValidation($userValidation) {
    if($userValidation[4] !== $userValidation [5]) {
        returnToRegister(2);
    }
    if(!filter_var($userValidation[4], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/(?=.*\d.*\d.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/")))) {
        returnToRegister(5);
    }
    return True;

}


/**
 * In deze functie word het account in de database gestopt indien de twee ingegeven wachtwoorden overeenkomen
 * Het wachtwoord wordt vervolgens encrypt voordat er een sql prepared query word uitgevoerd op de database
 * @param $connection object voor connectie
 * @param $emailValidation
 * @param $passwordValidation
 * @param $userRegistration
 */
function insertionOnPeopleTable($connection, $emailValidation, $passwordValidation, $userRegistration) {

    if ($emailValidation[0] === 0) {
        if ($passwordValidation) {

            /**
             * Encrypt het wachtwoord met PASSWORD_DEFAULT
             */
            $hashedPassword = password_hash($userRegistration[4], PASSWORD_DEFAULT);


            $insertsql = 'CALL insert_account(?,?,?,?)';
            $stmtinsert = $connection->prepare($insertsql);
            $stmtinsert->bind_param('ssss', $userRegistration[2], $userRegistration[0], $hashedPassword, $userRegistration[3]);
            $stmtinsert->execute();
            $stmtinsert->close();
            $connection->close();

            header('Refresh: 0; url=../registreer_succes.php');
            exit();
        }

        returnToRegister(2);
    } else {
        returnToRegister(1);
    }
}

/**
 * bij elke fout in het registreer proces word er een code meegestuurd,
 * deze code word meegegeven in de url als error code
 * @param $errorNumber
 */
function returnToRegister($errorNumber) {
    session_start();
    $errorCode = '';
    if ($errorNumber === 1) {
        $errorCode = 'register_exist_email_error';
    } elseif ($errorNumber === 2) {
        $errorCode = 'register_different_password_error';
    } elseif ($errorNumber === 3) {
        $errorCode = 'register_different_email_error';
    } elseif ($errorNumber === 4) {
        $errorCode = 'register_invalid_email_error';
    } elseif ($errorNumber === 5) {
        $errorCode = 'register_invalid_password_error';
    }

    header('Refresh: 0; url=../registreren.php?errorcode=' . $errorCode);
    exit();
}



