<?php

function checkSessionActive()
{
    if (isset($_SESSION['loggedin']) === FALSE || $_SESSION['loggedin'] === FALSE) {
        header('Refresh: 0; url=login.php');
        exit();
    }
}

function checkSessionActiveBestel()
{
    if (isset($_SESSION['loggedin']) === TRUE && $_SESSION['loggedin'] === TRUE) {
        header('Refresh: 0; url=bestel.php');
        exit();
    }
} ?>
