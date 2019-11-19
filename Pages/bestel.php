<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/imports.css">
</head>
<body>

<?php
include '../Modules/header.php'
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
                    <input type="text" class="form-control" id="InputNaam" placeholder="">
                </div>
                <div class="form-group">
                    <label for="InputStraatenhuisnummer">Straat en huisnummer*:</label>
                    <input type="text" class="form-control" id="InputStraatenhuisnummer" placeholder="">
                </div>
                <div class="form-group">
                    <label for="InputPlaats">Plaats*:</label>
                    <input type="text" class="form-control" id="InputPlaats" placeholder="">
                </div>
                <div class="form-group">
                    <label for="InputPostcode">Postcode*:</label>
                    <input type="text" class="form-control" id="InputPostcode" placeholder="">
                </div>
                <div class="form-group">
                    <label for="InputTelefoonnummer">Telefoonnummer*:</label>
                    <input type="text" class="form-control" id="InputTelefoonnummer" placeholder="">
                </div>
                <div class="form-group">
                    <label for="InputEmailadres">E-mailadres*:</label>
                    <input type="text" class="form-control" id="InputEmailadres" placeholder="">
                </div>
                <div class="float-right">
                    <button type="submit" id="inlogbutton" class="btn btn-success">Naar betalen</button>
                </div>
            </form>
        </div>

        <div class="col-6">
            <div class="mb-5 mt-3 w-75">
                <h3>Besteloverzicht</h3>
                <p>Aantal artikelen: 4 <span class="text-primary float-right">WINKELWAGEN AANPASSEN
                    </span>
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
include '../Modules/footer.php'
//?>
<!-- Placed at the end of the document so the pages load faster -->
<script src="../js/imports-dist.js"></script>
</body>
</html>