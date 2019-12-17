<?php
include 'Modules/functions.php';
print_header();
include 'includes/indexFunctions.inc.php';


//Selecteert random de product id, product naam, product prijs en de foto van de database table stockitems.
$products = getIndexProducts($connection);

//Selecteert random de product id, product naam, product prijs en de foto van de database table stockitems en wordt gelimiteerd op 3.
$productsSlider = getIndexSlider($connection);

//Selecteert de productnaam, foto, categorienaam en de categorie id van de database table stockitems, stockitemstockgroups en van stockgroups.
$categorieProducts = getIndexCategories($connection);
?>
<div class="container">

    <! –– Product slider -->
    <div id="carouselExampleIndicators" class="carousel slide d-none d-md-block" data-ride="carousel">
        <ol class="carousel-indicators bg-secondary rounded">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <?php
            //De slider wordt aangemaakt zodra er meer dan 0 rows zijn in de query.
            //De slider word maximaal 3x getoond op de homepagina met de productnaam en de foto.
            //De product id word toegevoegd in de href van de button zodat je naar de juiste product pagina geleid wordt.
            if ($productsSlider !== null) {
                $active = 'active';
                foreach ($productsSlider AS $product) {
                    ?>
                    <div class="carousel-item w-100  <?php echo $active;
                    $active = ''; ?>">
                        <img class="d-block slider mx-auto"
                             src="data:image/png;base64,<?php echo base64_encode($product[3]) ?>" alt="Artikel foto">
                        <div class="carousel-caption">
                            <h5 class="slider-text"><?php echo $product[1]; ?> </h5>
                            <a href="product.php?id=<?php echo $product[0]; ?>">
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
            <span class="sr-only">Vorige</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Volgende</span>
        </a>
    </div>
    <! –– Einde Product slider -->

    <! –– Producten -->
    <div class="row mt-5">
        <?php
        //De product wordt aangemaakt zodra er meer dan 0 rows zijn in de query.
        //Alle producten worden getoond met de productnaam, product foto en de product prijs.
        //De product id word toegevoegd in de href van de button zodat je naar de juiste product pagina geleid wordt.
        if ($products !== null) {
            foreach ($products AS $product) {
                $prijs = $product[3];
                ?>
                <div class="col-sm-3 col-md-3">
                    <a href="product.php?id=<?php echo $product[0]; ?>"
                       class="text-decoration-none">
                        <div class="card border-0">
                            <img src="data:image/png;base64,<?php echo base64_encode($product[4]) ?>"
                                 class="card-img-top w-75 mx-auto" alt="Artikel foto">
                            <div class="card-body">
                                <h5 class="card-title text-dark"><?php echo $product[1]; ?></h5>
                                <h5 class="card-title text-dark">
                                    € <?php echo str_replace('.', ',', (string)$prijs); ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
        }
        ?>

    </div>
    <! –– Einde producten -->

    <! –– Categorie -->
    <h2 class="my-5">Categorieën</h2>
    <div class="row mt-5">
        <?php
        //De categorie wordt aangemaakt zodra er meer dan 0 rows zijn in de query.
        //Alle categorieën worden getoond met de categorie naam en de product foto.
        //De categorie id word toegevoegd in de href van de a tag zodat je naar de juiste product pagina geleid wordt.
        if ($categorieProducts !== null) {
            foreach ($categorieProducts as $product) {
                ?>
                <div class="col-sm-3">
                    <a href="zoeken.php?category=<?php echo $product[3]; ?>"
                       class="text-decoration-none">
                        <div class="card align-items-center border-0">
                            <div class="card-body">
                                <h3 class="h4 text-dark font-weight-bold text-center"><?php echo $product[2]; ?></h3>
                            </div>
                            <img src="data:image/png;base64,<?php echo base64_encode($product[1]) ?>"
                                 class="card-img-top w-75 mx-auto pt-3"
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
    <! –– Einde categorie -->

</div>

<?php
print_footer();
?>


