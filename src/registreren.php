<?php
include "Modules/functions.php";
print_header();
?>
<!-- Begin page content -->
<div class="container col-sm-3">
    <div class="m-5 text-center">
        <h1>Registreren</h1>
    </div>
    <?php
    if (isset($_GET['errorcode'])) {
        switch ($_GET['errorcode']) {
            case "register_exist_email_error":?>
                <div class="text-danger text-center pb-3">
                    Er bestaat al een account met dit e-mailadres.
                </div>
                <?php break;
            case "register_different_password_error":?>
                <div class="text-danger text-center pb-3">
                    Wachtwoorden komen niet overeen met elkaar.
                </div>
                <?php break;
            case "register_different_email_error":?>
                <div class="text-danger text-center pb-3">
                    E-mailadressen komen niet overeen met elkaar.
                </div>
                <?php break;
        }
    }
    ?>
    <form action="BackgroundCode/register_validation.php" method="POST">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-at"></i></div>
            </div>
            <input type="text" class="form-control rounded" placeholder="E-mailadres" name="email" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-at"></i></div>
            </div>
            <input type="text" class="form-control rounded" placeholder="E-mailadres" name="email_validation" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user"></i></div>
            </div>
            <input type="text" class="form-control rounded" placeholder="Voledige naam" name="name" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-phone"></i></div>
            </div>
            <input type="text" class="form-control rounded" placeholder="Telefoonnummer" name="telephone" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
            </div>
            <input type="password" class="form-control rounded" placeholder="wachtwoord" name="password" required>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
            </div>
            <input type="password" class="form-control rounded" placeholder="wachtwoord opnieuw"
                   name="password_validation" required>
        </div>
        <div class="row justify-content-center">
            <button type="submit" class="btn btn-success pl-4 px-4 mb-3">Registreren</button>
        </div>
    </form>
    <p class="text-center">
        Heeft u al een account?<br>
        <a href="login.php">Log hier in</a>
    </p>
</div>
<?php
print_footer();
?>
