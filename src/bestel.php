<?php
include 'Modules/functions.php';
print_header();
include "includes/orderFunctions.inc.php";
include "includes/accountFunctions.inc.php";

if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin']) && (isset($_SESSION['adressnaw']) && $_SESSION['adressnaw'])) {
    $userID = $_SESSION['userNr'];
    $currentUserAddress = getUserAddress($userID, $connection);
}
if (isset($_POST['inlogButton'])) {
    BestelGegevens($_POST['InputNaam'], $_POST['InputStraatEnHuisnummer'], $_POST['InputPlaats'], $_POST['InputPostcode'], $_POST['InputTelefoonnummer'], $connection);

}


?>
<!-- Begin page content -->
<div class="container">
    <div class="row mt-5">
        <div class="col-md-6 border-right">
            <div class="mb-5 mt-3">
                <h1>Bestellen<br><br></h1>
                <h3>Adresgegevens</h3>
            </div>
            <?php if (isset($_SESSION['loggedin']) === FALSE || $_SESSION['loggedin'] === FALSE) { ?>
            <form method="post">

                <div class="form-group">
                    <label for="InputNaam">Naam*:</label>
                    <input name="InputNaam" type="text" class="form-control" id="InputNaam" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="InputTelefoonnummer">Telefoonnummer*:</label>
                    <input name="InputTelefoonnummer" type="text" class="form-control" id="InputTelefoonnummer"
                           placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="InputEmailadres">E-mailadres*:</label>
                    <input name="InputEmailadres" type="text" class="form-control" id="InputEmailadres"
                           placeholder=""
                           required>
                </div>

                <?php }
                if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin']) && (isset($_SESSION['adressnaw']) && $_SESSION['adressnaw'])) { ?>
                <form method="post">
                    <div class="form-group">
                        <p class="mb-0">Kies voor u oude adres of vul een nieuw adres in</p>
                        <p class="text-danger mt-0"> Pas op bij het invullen van het nieuwe adres word het oude adres
                            verwijderd!! </p>
                    </div>
                    <div class="form-group">
                        <label class="m-0">
                            <input type="radio" name="addressChoice" value="oldAddress" class="mr-2">
                            Eerder gebruikt adres
                            <div class="row m-1 mt-2 mb-5">
                                <div class="col-6 p-0 pl-2 border-top border-left border-bottom">
                                    <p class=" pt-3"><strong>Adresgegevens</strong><br>
                                        Straatnaam:<br>
                                        Postcode:<br>
                                        Plaatsnaam:<br>
                                        Provincie:<br>
                                        Land:<br>
                                    </p>
                                </div>
                                <div class="col-6 pl-0 border-top border-right border-bottom">
                                    <p class=" pt-3">
                                        <br>
                                        <?php echo $currentUserAddress[0] ?><br>
                                        <?php echo $currentUserAddress[1] ?><br>
                                        <?php echo $currentUserAddress[2] ?><br>
                                        <?php echo $currentUserAddress[3] ?><br>
                                        <?php echo $currentUserAddress[4] ?>
                                    </p>
                                </div>
                            </div>
                        </label> <br>
                        <label class="m-0">
                            <input type="radio" name="addressChoice" value="newAddress" class="mr-2">
                            Nieuw adres
                        </label><br>

                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <label for="InputStraatEnHuisnummer">Straat en huisnummer*:</label>
                        <input name="InputStraatEnHuisnummer" type="text" class="form-control"
                               id="InputStraatEnHuisnummer"
                               placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="InputPlaats">Plaats*:</label>
                        <input name="InputPlaats" type="text" class="form-control" id="InputPlaats" placeholder=""
                               required>
                    </div>
                    <div class="form-group">
                        <label for="InputPostcode">Postcode*:</label>
                        <input name="InputPostcode" type="text" class="form-control" id="InputPostcode" placeholder=""
                               required>
                    </div>
                    <div class="form-group float-right">
                        <a href="succes.php">
                            <button name="inlogButton" id="inlogButton" class="btn btn-success">Naar betalen</button>
                        </a>
                    </div>
                </form>




        </div>

        <div class="col-md-6">
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

