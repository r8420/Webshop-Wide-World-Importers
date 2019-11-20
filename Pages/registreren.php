<?php
include '../Modules/header.php'
?>
<!-- Begin page content -->
<div class="container col-sm-3">
    <div class="m-5 text-center">
        <h1>Registreren</h1>
    </div>
    <form>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-at"></i></div>
            </div>
            <input type="text" class="form-control rounded" placeholder="Voer uw emailadress in" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user"></i></div>
            </div>
            <input type="text" class="form-control rounded" placeholder="Voer een gebruikersnaam in" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
            </div>
            <input type="password" class="form-control rounded" placeholder="Voer een wachtwoord in" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
            </div>
            <input type="password" class="form-control rounded" placeholder="Voer het wachtwoord opnieuw in" required>
        </div>
        <div class="row justify-content-center">
            <button type="submit" class="btn btn-success pl-4 px-4 mb-3">Registreren</button>
        </div>
    </form>
    <p class="text-center">
        Heeft u al een account?<br>
        <a href="inlog.php">Log hier in</a>
    </p>
</div>
<?php
include '../Modules/footer.php'
?>