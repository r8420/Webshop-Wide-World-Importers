<?php

function checkSessionActive() {
    if (isset($_SESSION['loggedin']) === FALSE || $_SESSION['loggedin'] === FALSE) {
        header('Refresh: 0; url=login.php');
        exit();
    }

}
