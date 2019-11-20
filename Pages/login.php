<?php
include '../Modules/head.php';
include '../Modules/header.php';
?>
<!-- Begin page content -->
<div class="container col-sm-3 ">
    <div class="m-5 text-center">
        <h1>Login</h1>
    </div>
    <form action="../BackgroundCode/login_validation.php" method="post">
        <div class="input-group  mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user"></i></div>
            </div>
            <input type="text" class="form-control rounded" placeholder="Gebruikersnaam" required>
        </div>
        <div class="input-group  mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
            </div>
            <input type="password" class="form-control rounded" placeholder="Wachtwoord" required>
        </div>
        <div class=" row justify-content-center">
            <button type="submit" id="inlogbutton" class="btn btn-success pl-4 px-4 mb-3">Inloggen</button>
        </div>
    </form>
    <p class="text-center">
        Nog geen account?<br>
        <a href="registreren.php">Maak hier een account aan</a>
    </p>
</div>

<?php
include '../Modules/footer.php'
?>
