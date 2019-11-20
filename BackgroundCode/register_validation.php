<?php
$connectionObject =  new DatabaseFactory();
$connection = $connectionObject->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
} else {
    header("Refresh: 0; url=../Pages/registeren.php");
    exit();
}


?>
