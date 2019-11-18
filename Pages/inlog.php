<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inloggen</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/imports.css">
    <style>
        .container {
            margin: 100px auto;
            max-width: 400px;
            text-align: center;
        }
        #inlogbutton {
            width: 120px;
            margin-top: 6px;
        }
        .mb-13px {
            margin-bottom: 13px;
        }
        .input-group-text {
            background-color: unset;
            border: unset;
        }
        .input-group-text .fas {
            font-size: 1.5rem;
            padding-right: 15px;
        }
        #InputGebruikersnaam, #InputWachtwoord1 {
            border-radius: .25rem;
        }
    </style>
</head>
<body>

<?php
include '../Modules/header.php'
?>
<!-- Begin page content -->
<div class="container">
    <div class="mb-5">
        <h1>Login</h1>
    </div>
    <form>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user"></i></div>
            </div>
            <input type="text" class="form-control" id="InputGebruikersnaam" placeholder="Gebruikersnaam" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
            </div>
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
</body>
</html>