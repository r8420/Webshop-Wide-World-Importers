<?php
include 'Modules/functions.php';
print_header();

$orderID = $_GET['orderNr'];
if(!filter_var($orderID, FILTER_VALIDATE_INT)) {
    die('Don\'t try any funny business');
}
?>
<!-- Begin page content -->
<div class="container text-center" style="margin-top: 100px; margin-bottom: 100px">
    <div>
        <img src="Images/checkmark.png" class="mb-3" style="width: 199px; height: 188px" alt="Artikel foto">
    </div>
    <div class="mb-3">
        <h1>Bestelling succesvol</h1>
    </div>
    <div class="container mb-4 text-center" style="width: 400px">
        <p>
            Bedankt voor uw aankoop.
        </p>
        <p style="color: blue">
            <em>Order Nummer: #<?php echo $_GET['orderNr'] ?></em>
        </p>
    </div>
    <a class="btn btn-success text-white" href="index.php">Terug naar de homepagina</a>
</div>

<?php
print_footer();
?>
