<?php
include "../BackgroundCode/SessionCode.php";
session_start();
checkSessionActive();
include "../Modules/functions.php";
print_header();
include "../BackgroundCode/Bestelgeschiedenis_functionali.php";
$itemlist = getSqlResults($_GET['orderId'], $_SESSION['userNr'], $connection);
$totaal = 0;


?>
<div class="container">
    <div class="m-5">
        <h1>Bestelling 4046</h1>
    </div>
    <div class="container rounded-0">
        <table class="table table-striped table-hover">
            <thead>
            <tr class="bg-dark text-white">
                <th scope="col"></th>
                <th scope="col">Artikel</th>
                <th scope="col">Aantal</th>
                <th scope="col">Prijs</th>
                <th scope="col">Totaal</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($itemlist as $item) {
                $productPhoto = base64_encode($item[5]);?>
            <tr>
                <td><img src="data:image/jpeg;base64,' . $productPhoto .'" ></td>
                <td><?php echo $item[3] ?></td>
                <td><?php echo $item[2] ?></td>
                <td><?php echo "€" . $item[4] ?></td>
                <td><?php echo "€" . $item[2] * $item[4] ?></td>
                <?php $totaal += $item[2] * $item[4] ?>
            </tr>
            <?php
            }
            ?>
            <tr class="bg-dark text-white">
                <td></td>
                <th scope="row">Totaal</th>
                <td></td>
                <td></td>
                <th scope="row"><?php echo "€" . $totaal ?></th>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
print_footer();
?>

