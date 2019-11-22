<?php
include "../Modules/functions.php";
print_header();
$getal1 = 75;
$getal2 = 2.74;
$getal3 = $getal1 * $getal2;
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
            <tr>
                <td>
                    <img src="../Images/logo.png">
                </td>
                <td>Shipping carton (Brown) 480x270x320mm</td>
                <?php print "<td>" . $getal1 . "</td>";
                print  "<td>" . $getal2 . "</td>";
                print   "<td>" . $getal3 . "</td>";
                ?>
            </tr>
            <tr>
                <td>
                    <img src="../Images/logo.png">
                </td>
                <td>Shipping carton (Brown) 305x305x305mm</td>
                <?php print "<td>" . $getal1 . "</td>";
                print  "<td>" . $getal2 . "</td>";
                print  "<td>" . $getal3 . "</td>";
                ?>
            </tr>
            <tr>
                <td>
                    <img src="../Images/logo.png">
                </td>
                <td>Shipping carton (Brown) 279x254x217mm</td>
                <?php print "<td>" . $getal1 . "</td>";
                print "<td>" . $getal2 . "</td>";
                print  "<td>" . $getal3 . "</td>";
                ?>
            </tr>
            <tr>
                <td>
                    <img src="../Images/logo.png">
                </td>
                <td>Halloween skull mask (Gray) S</td>
                <?php print "<td>" . $getal1 . "</td>";
                print "<td>" . $getal2 . "</td>";
                print  "<td>" . $getal3 . "</td>";
                ?>

            </tr>
            <tr>
                <td>
                    <img src="../Images/logo.png">
                </td>
                <td>"The Gu" red shirt XML tag t-shirt (White) S</td>
                <?php print "<td>" . $getal1 . "</td>";
                print   "<td>" . $getal2 . "</td>";
                print  "<td>" . $getal3 . "</td>";
                ?>
            </tr>
            <tr class="bg-dark text-white">
                <td></td>
                <th scope="row">Totaal</th>
                <td></td>
                <td></td>
                <th scope="row">2614.75</th>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
print_footer();
?>
