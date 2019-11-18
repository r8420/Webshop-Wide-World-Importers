<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registreren</title>
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
//include '../Modules/Navbar.php'
//?>
<!-- Begin page content -->
<div class="container">
    <div class="mb-5">
        <h1>Registreren</h1>
    </div>
    <form>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-at"></i></div>
            </div>
            <input type="text" class="form-control" id="InputEmail" placeholder="Voer uw emailadress in" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user"></i></div>
            </div>
            <input type="text" class="form-control" id="InputGebruikersnaam" placeholder="Voer een gebruikersnaam in" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
            </div>
            <input type="password" class="form-control" id="InputWachtwoord1" placeholder="Voer een wachtwoord in" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
            </div>
            <input type="password" class="form-control" id="InputWachtwoord2" placeholder="Voer het wachtwoord opnieuw in" required>
        </div>
        <button type="submit" id="registreerbutton" class="btn btn-success mb-13px">Registreren</button>
    </form>
    <p>
        Heeft u al een account?<br>
        <a href="inlog.php">Log hier in</a>
    </p>
</div>

<?php
//include '../Modules/footer.php'
//?>
</body>
</html>