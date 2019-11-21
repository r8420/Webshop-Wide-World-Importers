<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
include "../DatabaseFactory.php";
$connectionObject = new DatabaseFactory();
$connection = $connectionObject->getConnection();
$dbName = "people";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $email_validation = $_POST['email_validation'];
    $name = $_POST['name'];
    $tel = $_POST['telephone'];
    $password = $_POST['password'];
    $password_validation = $_POST['password_validation'];
} else {
    header("Refresh: 0; url=../Pages/registreren.php");
    exit();
}
if ($email == $email_validation) {
    $selectquery = "SELECT LogonName FROM $dbName WHERE LogonName = ?";
    $stmtselect = $connection->prepare($selectquery);

    $stmtselect->bind_param("s", $email);
    $stmtselect->execute();
    $stmtselect->bind_result($LogonName);
    $stmtselect->store_result();
    $stmtselect->fetch();
    if ($stmtselect->num_rows === 0) {
        if ($password == $password_validation) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insertsql = "INSERT INTO people (PersonID, FullName, LogonName, HashedPassword, PhoneNumber, EmailAddress) SELECT (max(PersonID)+1),?,?,?,?,? FROM people";
            $stmtinsert = $connection->prepare($insertsql);
            $stmtinsert->bind_param("sssss", $name, $email, $hashedPassword, $tel, $email);
            $stmtinsert->execute();
            $stmtinsert->close();
            $connection->close();

            returnToRegister(3);
        } else {
            returnToRegister(2);
        }
    } else {
        returnToRegister(1);
    }
} else {
    returnToRegister(4);
}
function returnToRegister($errorNumber)
{
    session_start();
    if ($errorNumber == 1) {
        $_SESSION['errorcode'] = "register_exist_email_error";
    } elseif ($errorNumber == 2) {
        $_SESSION['errorcode'] = "register_password_error";
    } elseif ($errorNumber == 3) {
        header("Refresh: 0; url=../Pages/login.php");
        exit();
    } elseif ($errorNumber == 4) {
        $_SESSION['errorcode'] = "register_different_email_error";
    }

    header("Refresh: 0; url=../Pages/registreren.php");
    exit();
}
?>

