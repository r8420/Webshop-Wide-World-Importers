<?php
include 'Modules/functions.php';
print_header();
?>
<!-- Begin page content -->
<div class="container col-sm-3 ">
    <div class="m-5 text-center">
        <h1>Login</h1>
    </div>
    <?php
    if (isset($_GET['errorcode']) && $_GET['errorcode'] === 'login_error') {
        ?>
        <div class="text-danger text-center pb-3">
            Gebruikersnaam of wachtwoord is verkeerd ingegeven.
        </div>
        <?php
    }
    ?>
    <form action="php/login_validation.php" method="POST">
        <div class="input-group  mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user"></i></div>
            </div>
            <input type="text" class="form-control rounded" placeholder="E-Mail" name="email" required>
        </div>
        <div class="input-group  mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
            </div>
            <input type="password" class="form-control rounded" placeholder="Wachtwoord" name="password" required>
        </div>

        <div class=" row justify-content-center">
            <button type="submit" id="inlogButton" class="btn btn-success pl-4 px-4 mb-3">Inloggen</button>
        </div>
        <input type="hidden" name="redirect" value="account">
    </form>
    <p class="text-center">
        Nog geen account?<br>
        <a href="registreren.php">Maak hier een account aan</a>
    </p>
</div>

<?php
print_footer();
?>


