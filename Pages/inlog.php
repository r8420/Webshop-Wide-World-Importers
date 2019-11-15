<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/imports.css">
    <style>
        .container {
            margin: 100px auto;
            width: 400px;
            text-align: center;
        }
        #inlogbutton {
            width: 120px;
            margin-top: 6px;
        }
        .mb-13px {
            margin-bottom: 13px;
        }
    </style>
</head>
<body>

<?php
include '../Modules/Navbar.php'
?>
<!-- Begin page content -->
<div class="container">
    <div class="mb-5">
        <h1>Login</h1>
    </div>
    <form>
        <div class="form-group">
            <input type="text" class="form-control" id="InputGebruikersnaam" placeholder="Gebruikersnaam" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="InputWachtwoord1" placeholder="Wachtwoord" required>
        </div>
        <button type="submit" id="inlogbutton" class="btn btn-success mb-13px">Inloggen</button>
    </form>
    <p>
        Nog geen account?<br>
        <a href="register.php">Maak hier een account aan</a>
    </p>
</div>

<?php
include '../Modules/footer.php'
?>
<!-- Placed at the end of the document so the pages load faster -->
<script src="../js/imports-dist.js"></script>
</body>
</html>