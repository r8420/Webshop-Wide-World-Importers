<?php
include 'Modules/functions.php';
include 'includes/sessionFunctions.inc.php';
checkSessionActive();
print_header();
include 'includes/accountFunctions.inc.php';
$userID = $_SESSION['userNr'];
$currentUser = getUser($userID, $connection);
$currentUserAddress = getUserAddress($userID, $connection);
$orders = getAssociatedOrders($userID, $connection)

?>
<div class="container">
    <div class="col-sm-10 mt-5">
        <h1>Account van <?php echo $currentUser[1] ?></h1>
    </div>
    <div class="row">
        <div class="col-md-6 mt-5">
            <div class="row m-1">
                <div class="col-6 p-0 pl-2 border-top border-left border-bottom">
                    <p class="pt-3"><strong>Accountgegevens</strong><br>
                        AccountNr:<br>
                        Volledige Naam:<br>
                        Telefoon:<br>
                        E-Mail:
                    </p>
                </div>
                <div class="col-6 p-0 border-top border-right border-bottom">
                    <p class="pt-3">
                        <br>
                        <?php echo $currentUser[0] ?><br>
                        <?php echo $currentUser[1] ?><br>
                        <?php echo $currentUser[2] ?><br>
                        <?php echo $currentUser[3] ?>
                    </p>
                </div>
                <!--                <button class="mb-2 btn-primary mt-5 pt-1 pb-1 pl-2 px-2 rounded"><strong>Verander-->
                <!--                        accountgegevens</strong>-->
                <!--                </button>-->
            </div>
            <div class="row m-2 mt-5 mb-5">
                <div class="col-6 p-0 pl-2 border-top border-left border-bottom">
                    <p class=" pt-3"><strong>Adresgegevens</strong><br>
                        Straatnaam:<br>
                        Postcode:<br>
                        Plaatsnaam:<br>
                    </p>
                </div>
                <div class="col-6 p-0 border-top border-right border-bottom">
                    <p class=" pt-3">
                        <br>
                        <?php echo $currentUserAddress[0] ?><br>
                        <?php echo $currentUserAddress[1] ?><br>
                        <?php echo $currentUserAddress[2] ?><br>
                    </p>
                </div>
                <!--                <button class="mb-2 btn-primary mt-5 pt-1 pb-1 pl-2 px-2 rounded"><strong>Verander-->
                <!--                        adresgegevens</strong>-->
                <!--                </button>-->
            </div>
        </div>
        <div class="col-md-6 mt-5 mb-5 ">
            <div class=" m-1 ">
                <?php if ($orders !== null) { ?>
                    <p class="border col-12 pt-3 pb-3"><strong>Order geschiedenis</strong><br>
                        <?php foreach ($orders as $order) { ?>
                            <a href="bestelgeschiedenis.php?orderId=<?php echo $order ?>">
                                Order: <?php echo $order ?></a><br>
                        <?php } ?>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php
print_footer();
?>

