<?php
include "../Modules/functions.php";
print_header();
?>
<!-- Begin page content -->
<div class="container">
    <div class="row mt-5">
        <div class="col-6 border-right">
            <div class="mb-5 mt-3">
                <h1>Bestellen<br><br></h1>
                <h3>Adresgegevens</h3>
            </div>
            <form>

                <div class="form-group">
                    <label for="InputNaam">Naam*:</label>
                    <input type="text" class="form-control" id="InputNaam" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="InputStraatenhuisnummer">Straat en huisnummer*:</label>
                    <input type="text" class="form-control" id="InputStraatenhuisnummer" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="InputPlaats">Plaats*:</label>
                    <input type="text" class="form-control" id="InputPlaats" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="InputPostcode">Postcode*:</label>
                    <input type="text" class="form-control" id="InputPostcode" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="InputTelefoonnummer">Telefoonnummer*:</label>
                    <input type="text" class="form-control" id="InputTelefoonnummer" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="InputEmailadres">E-mailadres*:</label>
                    <input type="text" class="form-control" id="InputEmailadres" placeholder="" required>
                </div>
            </form>
            <div class="float-right">
                <a href="<?php echo $prefix; ?>Pages/succes.php">
                    <button id="inlogbutton" class="btn btn-success">Naar betalen</button>
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

