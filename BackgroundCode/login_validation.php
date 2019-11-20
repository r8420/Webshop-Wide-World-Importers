<?php
require "../DatabaseFactory.php";
$username = "";
$password = "";
$Connection = new DatabaseFactory();
$connection = $Connection->getConnection();
$tbl_name = "people_archive";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
} else {
    header("Refresh: 0; url=login.php");
    exit();
}

$sql = "SELECT PersonID, LogonName, HashedPassword FROM $tbl_name WHERE LogonName=$username";
$result = mysqli_query($connection, $sql);
if ($result == null) {
    returntologin();
} else {
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $hash = $result[2];
        if (password_verify($password, $hash)) {
            session_start();
            $_SESSION['logedin'] = true;
            $_SESSION['userNr'] = $result[0];

        } else {
            returntologin();
        }
    }
}
function returntologin()
{
    session_start();
    $_SESSION['errorcode'] =  "login_error";
    header("Refresh: 0; url=../Pages/login.php");
    exit();
}


?>

