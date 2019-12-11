<?php
include 'Modules/functions.php';
print_header();
include 'includes/orderFunctions.inc.php';

if (isset($_POST['inlogButton'])) {
    BestelGegevens($_POST['InputNaam'], $_POST['InputStraatEnHuisnummer'], $_POST['InputPlaats'], $_POST['InputPostcode'], $_POST['InputTelefoonnummer'], $connection);

}


?>
<!-- Begin page content -->
<div class="container">
    <div class="row mt-5">
        <div class="col-6 border-right">
            <div class="mb-5 mt-3">
                <h1>Bestellen<br><br></h1>
                <h3>Adresgegevens</h3>
            </div>
            <form method="post">

                <div class="form-group">
                    <label for="InputNaam">Naam*:</label>
                    <input name="InputNaam" type="text" class="form-control" id="InputNaam" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="InputStraatEnHuisnummer">Straat en huisnummer*:</label>
                    <input name="InputStraatEnHuisnummer" type="text" class="form-control" id="InputStraatEnHuisnummer"
                           placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="InputPlaats">Plaats*:</label>
                    <input name="InputPlaats" type="text" class="form-control" id="InputPlaats" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="InputPostcode">Postcode*:</label>
                    <input name="InputPostcode" type="text" class="form-control" id="InputPostcode" placeholder=""
                           required>
                </div>
                <div class="form-group">
                    <label for="InputTelefoonnummer">Telefoonnummer*:</label>
                    <input name="InputTelefoonnummer" type="text" class="form-control" id="InputTelefoonnummer"
                           placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="InputEmailadres">E-mailadres*:</label>
                    <input name="InputEmailadres" type="text" class="form-control" id="InputEmailadres" placeholder=""
                           required>
                </div>
            </form>
            <div class="float-right">
                <a href="registreren.php">
                    <button name="inlogButton" id="inlogButton" class="btn btn-success">Account aanmaken</button>
                </a>
                <a href="succes.php">
                    <button name="inlogButton" id="inlogButton" class="btn btn-success">Naar betalen</button>
                </a>
            </div>
        </div>

        <div class="col-6">
            <div class="mb-5 mt-3 w-75">
                <h3>Besteloverzicht</h3>
                <p>Aantal artikelen: 4 <span class="text-primary float-right"><a href="winkelwagen.php">WINKELWAGEN AANPASSEN
                </a>    </span>
                </p>
                <ul>
                    <li>Productnaam1</li>
                    <li>Productnaam2</li>
                    <li>Productnaam3</li>
                </ul>
                <hr>
                <p><b>Subtotaal:<span class="float-right">€21.98
                    </span></b></p>
                <p>Verzendkosten:<span class="float-right">€3.00</span></p>
                <hr>
                <p><b>Totaalbedrag:<span class="float-right">€24.98</span></b></p>

            </div>
        </div>
    </div>
</div>
<?php
print_footer();
?>
