<?php
include 'Modules/functions.php';
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
            case 'register_exist_email_error':
                ?>
                <div class="text-danger text-center pb-3">
                    Er bestaat al een account met dit e-mailadres.
                </div>
                <?php break;
            case 'register_different_password_error':
                ?>
                <div class="text-danger text-center pb-3">
                    Wachtwoorden komen niet overeen met elkaar.
                </div>
                <?php break;
            case 'register_different_email_error':
                ?>
                <div class="text-danger text-center pb-3">
                    E-mailadressen komen niet overeen met elkaar.
                </div>
                <?php break;
            case 'register_invalid_email_error':
                ?>
                <div class="text-danger text-center pb-3">
                    Voer een geldig e-mailadres in.
                </div>
                <?php break;
            case 'register_invalid_password_error':
                ?>
                <div class="text-danger text-center pb-3">
                    Het wachtwoord voldoet niet aan de eisen.
                </div>
                <?php break;
            case 'register_invalid_phone_number_error':
                ?>
                <div class="text-danger text-center pb-3">
                    Voer een geldig telefoonnummer in.
                </div>
                <?php break;
        }
    }
    ?>
    <form action="php/register_validation.php" method="POST">
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
            <input type="text" class="form-control rounded" placeholder="Volledige naam" name="name" required>
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
            <input type="password" class="form-control rounded validate" placeholder="wachtwoord" name="password"
                   pattern="(?=.*\d.*\d.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                   title="Het wachtwoord moet tenminste bestaan uit één hoofdletter, één kleine letter, 3 getallen, en het moet minimaal 8 karakters lang zijn"
                   required>
            <div class="alert alert-warning password-alert" role="alert" id="message">
                <ul>
                    <li class="requirements leng"><i class="fas fa-check green-text"></i><i class="fas fa-times red-text"></i> Uw wachtwoord moet tenminste bestaan uit 8 karakters</li>
                    <li class="requirements big-letter"><i class="fas fa-check green-text"></i><i class="fas fa-times red-text"></i> Uw wachtwoord moet tenminste bestaan uit 1 hoofdletter.</li>
                    <li class="requirements num"><i class="fas fa-check green-text"></i><i class="fas fa-times red-text"></i> Uw wachtwoord moet tenminste bestaan uit 3 getallen.</li>
                    <li class="requirements small-letter"><i class="fas fa-check green-text"></i><i class="fas fa-times red-text"></i> Uw wachtwoord moet tenminste bestaan uit 1 kleine letter.</li>
                </ul>
            </div>
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
<script src="js/passwordChecker.js"></script>
<?php
print_footer();
?>
