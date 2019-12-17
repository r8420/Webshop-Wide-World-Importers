<?php
include 'Modules/functions.php';
print_header();
include "includes/orderFunctions.inc.php";
include "includes/accountFunctions.inc.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin']) && (isset($_SESSION['adressnaw']) && $_SESSION['adressnaw'])) {
    $userID = $_SESSION['userNr'];
    $currentUserAddress = getUserAddress($userID, $connection);
}
if (isset($_POST['inlogButton'])) {
    BestelGegevens($_POST['InputNaam'], $_POST['InputStraatEnHuisnummer'], $_POST['InputPlaats'], $_POST['InputPostcode'], $_POST['InputTelefoonnummer'], $connection);

}
$countrys = getCountrys($connection);
$total = 0;



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
            <form method="POST" action="php/order_validation_guest.php">

                <div class="form-group">
                    <label>Naam*:</label>
                    <input name="InputNaam" type="text" class="form-control" placeholder="" required>
                </div>
                <div class="form-group">
                    <label>Telefoonnummer*:</label>
                    <input name="InputTelefoonnummer" type="text" class="form-control" placeholder="" required>
                </div>
                <div class="form-group">
                    <label>E-mailadres*:</label>
                    <input name="InputEmailadres" type="text" class="form-control" placeholder="" required>
                </div>

                <?php }
                if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin']) && (isset($_SESSION['adressnaw']) && $_SESSION['adressnaw'])) { ?>
                <form method="POST" action="php/order_validation_account_last_naw.php">
                    <div class="form-group">
                        <p class="mb-0">Kies voor u oude adres of vul een nieuw adres in</p>
                        <p class="text-danger mt-0"> Pas op bij het invullen van het nieuwe adres word het oude adres
                            verwijderd!! </p>
                    </div>
                    <div class="form-group">
                        <label class="m-0 w-75">
                            <input type="radio" name="addressChoice" value="oldAddress" class="mr-2" required>
                            Eerder gebruikt adres
                            <div class="row m-1 mt-2 mb-5">
                                <div class="col-6 p-0 pl-2 border-top border-left border-bottom">
                                    <p class=" pt-3"><strong>Adresgegevens</strong><br>
                                        Straatnaam:<br>
                                        Postcode:<br>
                                        Plaatsnaam:<br>
                                        Staat/Provincie:<br>
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
                                        <?php echo $currentUserAddress[4] ?><br>
                                    </p>
                                </div>
                            </div>
                        </label> <br>
                        <label class="m-0">
                            <input type="radio" name="addressChoice" value="newAddress" class="mr-2" required>
                            Nieuw adres
                        </label><br>

                    </div>
                    <div class="form-group">
                        <label>Straat en huisnummer*:</label>
                        <input name="InputStraatEnHuisnummer" type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Postcode*:</label>
                        <input name="InputPostcode" type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Plaats*:</label>
                        <input name="InputPlaats" type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Staat/Provincie*:</label>
                        <input name="InputProvince" type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Land*:</label>
                        <select name="InputCountry" class="form-control">
                            <?php
                            foreach ($countrys AS $country) { ?>
                                <option value="<?php echo $country; ?>"><?php echo $country; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <?php } else { ?>

                        <div class="form-group">
                            <label>Straat en huisnummer*:</label>
                            <input name="InputStraatEnHuisnummer" type="text" class="form-control" placeholder=""
                                   required>
                        </div>
                        <div class="form-group">
                            <label>Postcode*:</label>
                            <input name="InputPostcode" type="text" class="form-control" placeholder=""
                                   required>
                        </div>
                        <div class="form-group">
                            <label>Plaats*:</label>
                            <input name="InputPlaats" type="text" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label>Staat/Provincie*:</label>
                            <input name="InputProvince" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Land*:</label>
                            <select name="InputCountry" class="form-control">
                                <?php foreach ($countrys AS $country) { ?>
                                    <option value="<?php echo $country; ?>"><?php echo $country; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    <?php } ?>
                    <div class="form-group float-right">
                        <a href="succes.php">
                            <button name="inlogButton" id="inlogButton" class="btn btn-success">Naar betalen</button>
                        </a>
                    </div>
                </form>


        </div>

        <div class="col-md-6">
            <div class="mb-md-5 mt-md-3">
                <h3>Besteloverzicht</h3>
                <p>Aantal artikelen: <?php echo(count($_SESSION['shoppingCart'])) ?> <span
                            class="text-primary float-right"><a href="winkelwagen.php">WINKELWAGEN AANPASSEN
                </a>    </span>
                </p>

                <?php foreach ($_SESSION['shoppingCart'] AS $key => $item) {
                    echo $key;
//                    $currentProduct = getProductInformation($connection, $key)
                    $currentProduct = getProductInformation($connection, 1) ?>
                    <div class="row p-0">
                        <div class="col-9">
                            - <b><?php echo $currentProduct['StockItemName']; ?></b>
                        </div>
                        <div class="col-1">
                            <?php echo $item; ?>
                        </div>
                        <div class="col-2 text-lg-right ">
                            €<?php echo number_format(($item * $currentProduct['RecommendedRetailPrice']),
                                2, ',', '.');
                            $total += $item * $currentProduct['RecommendedRetailPrice']; ?>
                        </div>
                    </div>
                <?php } ?>
                <hr>
                <p><b>Subtotaal:<span class="float-right"><?php echo $total ?>
                    </span></b></p>
                <p>Verzendkosten:<span class="float-right">€5.00</span></p>
                <hr>
                <p><b>Totaalbedrag:<span class="float-right"><?php echo $total + 5;
                            $total += 5; ?>
                        </span></b></p>

            </div>
        </div>
    </div>
</div>
<?php
print_footer();
?>

