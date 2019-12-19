<?php
include 'includes/sessionFunctions.inc.php';
include 'Modules/functions.php';
checkSessionActive();
print_header();
include 'includes/orderHistoryFunctions.inc.php';
$itemList = getSqlResults($_GET['orderId'], $_SESSION['userNr'], $connection);
$totaal = 0;


?>
<div class="container">
    <div class="m-5">
        <h1>Bestelling <?php echo $_GET['orderId']; ?></h1>
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
            foreach ($itemList as $item) { ?>
                <tr>
                    <td><img src="data:image/png;base64,<?php echo base64_encode($item[5]) ?>" alt="Artikel foto"></td>
                    <td><?php echo $item[3] ?></td>
                    <td><?php echo $item[2] ?></td>
                    <td><?php echo '€' . number_format($item[4], 2, ',', '.') ?></td>
                    <td><?php echo '€' . number_format($item[2] * $item[4], 2, ',', '.') ?></td>
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
                <th scope="row"><?php echo '€' . number_format($totaal, 2, ',', '.') ?></th>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
print_footer();
?>

