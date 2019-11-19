<?php
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Account</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/imports.css">
    <script src="/js/imports-dist.js"></script>
</head>
<?php
include '../Modules/header.php'
?>
<div class="container">
    <div class="col-sm-10 mt-5">
        <h1>Account</h1>
    </div>
    <div class="col-sm-5 mt-5 float-right ">
        <p class="border p-3"><strong>Order geschiedenis</strong><br>
            order:
        </p>
    </div>
    <div class="col-sm-5 mt-5 ">
            <p class="border p-3"><strong>Accountgegevens</strong><br>
                AccountNr:<br>
                Username:<br>
                E-Mail:<br>
                Geslacht:<br>
            </p>
        <button class="mb-2 btn-primary pt-1 pb-1 pl-2 px-2 rounded"><strong>Verander accountgegevens</strong></button>
    </div>

    <div class="col-sm-5 mt-5 ">
        <p class="border p-3"><strong>Adresgegevens</strong><br>
            Straatnaam:<br>
            Postcode:<br>
            Plaatsnaam:<br>
            Provincie:<br>
            Land:<br>
        </p>
        <button class="mb-2 btn-primary pt-1 pb-1 pl-2 px-2 rounded"><strong>Verander adresgegevens</strong></button>
    </div>
</div>
<?php
include '../Modules/footer.php'
?>

