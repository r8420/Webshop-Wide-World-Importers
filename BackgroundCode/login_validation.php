<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
require "../DatabaseFactory.php";
$username = "";
$password = "";
$connectionObject = new DatabaseFactory();
$connection = $connectionObject->getConnection();
$tblName = "people";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
} else {
    header("Refresh: 0; url=../Pages/login.php");
    exit();
}
$selectSQL = "SELECT PersonID, LogonName, HashedPassword FROM $tblName WHERE LogonName = ?";
$stmt = $connection->prepare($selectSQL);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($PersonID, $LogonName, $HashedPassword);
$stmt->store_result();
$stmt->fetch();
if ($stmt->num_rows === 0) {
    returnToLogin();
} else {
    if (password_verify($password, $HashedPassword)) {
        session_start();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['userNr'] = $PersonID;
        header("Refresh: 0; url=../pages/account_page.php");
        exit();
    } else {
        returnToLogin();
    }

}
function returnToLogin()
{
    session_start();
    $_SESSION['errorcode'] = "login_error";
    header("Refresh: 0; url=../pages/login.php");
    exit();
}


?>

