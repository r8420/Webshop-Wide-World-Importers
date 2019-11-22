<?php
include "Modules/functions.php";
print_header("index");

//Selecteerd random de prodcut id, product naam, product prijs en de foto van de database table stockitems.
$product = "SELECT StockItemID, StockItemName, RecommendedRetailPrice, Photo
                FROM stockitems ORDER BY RAND() LIMIT 12;";
//Selecteerd random de prodcut id, product naam, product prijs en de foto van de database table stockitems en wordt gelimiteerd op 3.
$product_slider = "SELECT StockItemID, StockItemName, RecommendedRetailPrice, Photo
                FROM stockitems ORDER BY RAND() LIMIT 3;";

//Selecteerd de productnaam, foto, categorienaam en de categorie id van de database table stockitems, stockitemstockgroups en van stockgroups.
$categorie = "SELECT i.StockItemName, i.Photo, sg.StockGroupName, g.StockGroupID
                FROM stockitems i
                JOIN stockitemstockgroups g ON i.StockItemID = g.StockItemID
                JOIN stockgroups sg ON g.StockGroupID = sg.StockGroupID
                group by sg.StockGroupName;";

//De query wordt hier uitgevoerd
$result_product = mysqli_query($connection, $product);
$result_product_slider = mysqli_query($connection, $product_slider);
$result_categorie = mysqli_query($connection, $categorie);
?>
<div class="container">
    <div id="carouselExampleIndicators" class="carousel slide mt-5 d-none d-md-block" data-ride="carousel">
        <ol class="carousel-indicators rounded">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner rounded">
            <?php
            //De slider wordt aangemaakt zodra er meer dan 0 rows zijn in de query.
            //De slider word maximaal 3x getoond op de homepagina met de productnaam en de foto.
            //De product id word toegevoegd in de href van de button zodat je naar de juiste product pagina geleid wordt.
            if (mysqli_num_rows($result_product_slider) > 0) {
                $active = 'active';
                while ($row = mysqli_fetch_assoc($result_product_slider)) {
                    ?>
                    <div class="carousel-item <?php echo $active;
                    $active = ""; ?>">
                        <img class="d-block w-100"
                             src="https://socialbrothers.nl/wp-content/uploads/2016/11/r_atr-header-main.jpg"
                             alt="First slide">
                        <div class="carousel-caption">
                            <h5 class="mb-5"><?php echo $row['StockItemName']; ?> </h5>
                            <a href="Pages/product_pagina.php?product=<?php echo $row['StockItemID']; ?>">
                                <button type="button" class="mt-5 mb-5 btn btn-success text-white">Bekijk product
                                </button>
                            </a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="row mt-5">
        <?php
        //De product wordt aangemaakt zodra er meer dan 0 rows zijn in de query.
        //Alle producten worden getoond met de productnaam, product foto en de product prijs.
        //De product id word toegevoegd in de href van de button zodat je naar de juiste product pagina geleid wordt.
        if (mysqli_num_rows($result_product) > 0) {
            while ($row = mysqli_fetch_assoc($result_product)) {
                $prijs = $row['RecommendedRetailPrice'];
                ?>
                <div class="col-sm-3 col-md-3">
                    <a href="Pages/product_pagina.php?product=<?php echo $row['StockItemID']; ?>"
                       class="text-decoration-none">
                        <div class="card border-0">
                            <img src="Images/product1.png" class="card-img-top w-75 mx-auto pt-3" alt="...">
                            <div class="card-body">
                                <h3 class="card-title h5 text-dark"><?php echo $row['StockItemName']; ?></h3>
                                <h3 class="card-title h5 text-dark">
                                    € <?php echo str_replace(".", ",", "$prijs"); ?></h3>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
        } else {
            echo "0 results";
        }

        ?>
    </div>
    <div class="row justify-content-end">
        <div class="col-2">
            <select class="custom-select">
                <option selected value="12">12</option>
                <option value="24">24</option>
                <option value="48">48</option>
                <option value="96">96</option>
                <option value="194">194</option>
            </select>
        </div>
    </div>

    <div class="row mt-5">
        <?php
        //De categorie wordt aangemaakt zodra er meer dan 0 rows zijn in de query.
        //Alle categorien worden getoond met de categorie naam en de product foto.
        //De categorie id word toegevoegd in de href van de a tag zodat je naar de juiste product pagina geleid wordt.
        if (mysqli_num_rows($result_categorie) > 0) {
            while ($row = mysqli_fetch_assoc($result_categorie)) {
                ?>
                <div class="col-sm-3">
                    <a href="Pages/zoekpagina.php?category=<?php echo $row['StockGroupID']; ?>"
                       class="text-decoration-none">
                        <div class="card align-items-center border-0">
                            <div class="card-body">
                                <h3 class="h4 text-dark"><?php echo $row['StockGroupName']; ?></h3>
                            </div>
                            <img src="<?php echo $row['StockItemName']; ?>" class="card-img-top w-75 mx-auto pt-3"
                                 alt="...">
                            <div class="card-body">
                                <h3 class="card-title h5 text-primary font-weight-bold">Bekijk categorie</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>
<?php

print_footer("index");

?>


