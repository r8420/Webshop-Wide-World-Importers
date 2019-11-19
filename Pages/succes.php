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
<div class="container" align="center" style="margin-top: 100px; margin-bottom: 100px">
    <div>
        <img src="../Images/checkmark.png" class="mb-3" style="width: 199px; height: 188px>
    </div>
    <div class="mb-3">
        <h1>Bestelling succesvol</h1>
    </div>
    <div class="container mb-4" align="center" style="width: 400px">
        <p>
            Bedankt voor uw aankoop. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi et nisl hendrerit,
            aliquet mi sed, scelerisque tortor.
        </p>
        <p style="color: blue">
            <em>#bestelnummer</em>
        </p>
    </div>
    <a class="btn btn-success text-white" href="../index.php">Terug naar de homepagina</a>
</div>

<?php
include '../Modules/footer.php'
?>
<!-- Placed at the end of the document so the pages load faster -->
<script src="../js/imports-dist.js"></script>
</body>
</html>