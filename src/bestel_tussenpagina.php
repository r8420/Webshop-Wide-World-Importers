<?php
include 'Modules/functions.php';
print_header();
include 'includes/orderFunctions.inc.php';


?>
<!-- Begin page content -->
<div class="container mb-5">
    <div class="row mt-5">
        <div class="col-md-2"></div>
        <div class="col-md-4 border-right">
            <div class="mb-5">
                <h1>Bestellen<br><br></h1>
                <h4>Bestaande Klant</h4>
            </div>
            <form action="php/login_validation.php" method="POST">
                <div class="input-group  mb-3 w-100">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                    </div>
                    <input type="text" class="form-control rounded" placeholder="E-Mail" name="email" required>
                </div>
                <div class="input-group  mb-3 w-100">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    </div>
                    <input type="password" class="form-control rounded" placeholder="Wachtwoord" name="password"
                           required>
                </div>
                <input type="hidden" name="redirect" value="order">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 "></div>
        <div class="col-sm-12 col-md-4">
            <div class="mx-auto text-center">
                <button type="submit" id="inlogbutton" class="btn btn-success pl-4 px-4 mb-3">Inloggen</button>
            </div>
            </form>
        </div>
        <div class="col-sm-12 col-md-4 ">
            <div class="mx-auto text-center">
                <a href="bestel.php">
                    <button name="inlogbutton" id="inlogbutton" class="btn btn-primary">Doorgaan als gast</button>
                </a>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>

</div>
<?php
print_footer();
?>

