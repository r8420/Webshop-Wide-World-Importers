<?php
require "../DatabaseFactory.php";

// start connectie database
$tblName = "people";
$connection = startDBConnection($tblName);

// Haalt POST Request op
$usernamePassword = checkPOSTRequest();

// Voert SQL query uit
$returnStatement = returnStatement($connection, $tblName, $usernamePassword);

// Start validatie op
startvalidation($returnStatement, $usernamePassword);


/**
 * Checkt of er een valid post is gestuud met de login pagina.
 * Indien niet word de gebruiker terug verwezen naar de login pagina
 * De functie geeft een array terug met de username en password
 * @return array ['username', 'password'] ;
 */
function checkPOSTRequest()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];
    } else {
        header("Refresh: 0; url=../Pages/login.php");
        exit();
    }
    return array($email, $password);
}

/**
 * De functie voert een MySQL prepared query uit op de database,
 * via prepared statements is het niet mogelijk om een sql-injectie te doen.
 * @param $connection object voor connectie
 * Dit object is gedefineerdt in DatabaseFactary.php
 * @param $tblName strin met de tablename
 * @param $usernamePassword ['username', 'password'] ;
 * Stuurt een array terug met de resultaten van de query
 * @return array ['stmtnumrows', 'id', 'logonName', 'hashedPassword'] ;
 */
function returnStatement($connection, $tblName, $usernamePassword)
{
    $selectSQL = "SELECT PersonID, LogonName, HashedPassword FROM $tblName WHERE LogonName = ?";
    $stmt = $connection->prepare($selectSQL);
    $stmt->bind_param("s", $usernamePassword[0]);
    $stmt->execute();
    $stmt->bind_result($id, $logonName, $hashedPassword);
    $stmt->store_result();
    $stmt->fetch();
    $stmtnumrows = $stmt->num_rows;
    return array($stmtnumrows, $id, $logonName, $hashedPassword);

}


/**
 * Deze functie valideert de loginnaam en het wachtwoord.
 * het valideren van de loginaam gaat door te kijken of er een resultaat terug is uit de database is en dat het er maar één is.
 * Daarna valideert het de meegeven wachtwoord met het hashedwachtwoord uit de database.
 * @param $stmt ['stmtnumrows', 'id', 'logonName', 'hashedPassword']
 * @param $usernamePassword ['username', 'password']
 */
function startvalidation($stmt, $usernamePassword)
{
    if ($stmt[0] == 0) {
        returnToLogin();
    } else {
        if (password_verify($usernamePassword[1], $stmt[2])) {
            session_start();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['userNr'] = $stmt[0];
            header("Refresh: 0; url=../Pages/account_page.php");
            exit();
        } else {
            returnToLogin();
        }

    }
}

/**
 * stuurt de gebruiker terug naar loginpagina
 */
function returnToLogin()
{
    session_start();
    $_SESSION['errorcode'] = "login_error";
    header("Refresh: 0; url=../Pages/login.php");
    exit();
}


?>

