<?php
include "../BackgroundCode/SessionCode.php";
include "../BackgroundCode/account_background.php";
include "../DatabaseFactory.php";
checkSessionActive();
$userID = getUserID();
$dbConnection = startDBConnection();
$currentUser = getUser($userID, $dbConnection);


//include_once "../Modules/functions.php";
//print_header();
?>
<div class="container">
    <div class="col-sm-10 mt-5">
        <h1>Account</h1>
    </div>
    <div class="row">
        <div class="col-md-6 mt-5 mb-5 ">
            <p class="border p-3"><strong>Accountgegevens</strong><br>
                AccountNr:<?php echo $currentUser[0]?><br>
                Voledige Naam:<?php echo $currentUser[1]?><br>
                Telefoon: <?php echo $currentUser[2]?><br>
                E-Mail:<?php echo $currentUser[3]?><br>
            </p>
            <button class="mb-2 btn-primary pt-1 pb-1 pl-2 px-2 rounded"><strong>Verander accountgegevens</strong>
            </button>
        </div>
        <div class="col-md-6 mt-5 mb-5 ">
            <p class="border p-3"><strong>Order geschiedenis</strong><br>
                order: <a href="bestelgeschiedenispagina.php">4046</a>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-6 mt-5 mb-5 ">
            <p class="border p-3"><strong>Adresgegevens</strong><br>
                Straatnaam:<br>
                Postcode:<br>
                Plaatsnaam:<br>
                Provincie:<br>
                Land:<br>
            </p>
            <button class="mb-2 btn-primary pt-1 pb-1 pl-2 px-2 rounded"><strong>Verander adresgegevens</strong>
            </button>
        </div>
    </div>
</div>
<?php
//print_footer();
?>

