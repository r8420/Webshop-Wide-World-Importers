<?php
session_start();
if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == FALSE ){
    header("Refresh: 0; url=login.php");
    exit();
}
include '../Modules/head.php';
include '../Modules/header.php';
?>
<div class="container">
    <div class="col-sm-10 mt-5">
        <h1>Account</h1>
    </div>
    <div class="row">
        <div class="col-md-6 mt-5 mb-5 ">
            <p class="border p-3"><strong>Accountgegevens</strong><br>
                AccountNr:<br>
                Username:<br>
                E-Mail:<br>
                Geslacht:<br>
            </p>
            <button class="mb-2 btn-primary pt-1 pb-1 pl-2 px-2 rounded"><strong>Verander accountgegevens</strong>
            </button>
        </div>
        <div class="col-md-6 mt-5 mb-5 ">
            <p class="border p-3"><strong>Order geschiedenis</strong><br>
                order:
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
include '../Modules/footer.php'
?>

