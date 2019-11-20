<?php
require "../DatabaseFactory.php";
$username = "";
$password = "";
$connection = new DatabaseFactory();
$connection->getConnection();
$tbl_name = "people_archive";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
} else {
    header("Refresh: 0; url=login.php");
    exit();
}

$sql = "SELCT PersonID, LogonName, HashedPassword FROM $tbl_name WHERE LogonName=$username";
$result = mysqli_query($sql);
$count = mysqli_num_rows($result);


if ($count == 1) {
    $hash = $result[2];
    if (password_verify($password, $hash)) {
        session_start();
        $_SESSION['logedin'] = true;
        $_SESSION['userNr'] = $result[0];

    }
}


?>

