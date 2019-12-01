<?php
include "Modules/functions.php";
print_header("index");

if (isset($_GET['pagina'])) {
    $pagina = $_GET['pagina'];
} else {
    $pagina = 1;
}

$aantal_producten = getIfExists('itemsPerPage', 12);
$offset = ($pagina-1) * $aantal_producten;
$aantal_pagina_sql = "SELECT COUNT(*) FROM stockitems";
$result = mysqli_query($connection,$aantal_pagina_sql);
$aantal_rows = mysqli_fetch_array($result)[0];
$aantal_paginas = ceil($aantal_rows / $aantal_producten);


//Selecteerd random de prodcut id, product naam, product prijs en de foto van de database table stockitems.
$product = "SELECT StockItemID, StockItemName, RecommendedRetailPrice, Photo
                FROM stockitems LIMIT $offset, $aantal_producten;";
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

function getIfExists($param, $default) {
    return ISSET($_GET[$param]) ? $_GET[$param] : $default;
}

function setSelected($param, $valueToCheck) {
    if(getIfExists($param, '') == $valueToCheck) {
        print("selected");
    }
}

function getParam($default){
    $query = $_GET;
    $query['pagina'] = $default;
    return http_build_query($query);
}
?>
<div class="container">

    <! –– Product slider -->
    <div id="carouselExampleIndicators" class="carousel slide d-none d-md-block" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <?php
            //De slider wordt aangemaakt zodra er meer dan 0 rows zijn in de query.
            //De slider word maximaal 3x getoond op de homepagina met de productnaam en de foto.
            //De product id word toegevoegd in de href van de button zodat je naar de juiste product pagina geleid wordt.
            if (mysqli_num_rows($result_product_slider) > 0) {
                $active = 'active';
                while ($row = mysqli_fetch_assoc($result_product_slider)) {
                    ?>
                    <div class="carousel-item w-100  <?php echo $active;
                    $active = ""; ?>">
                        <img class="d-block slider mx-auto"
                             src="data:image/png;base64,<?php echo base64_encode($row['Photo']) ?>">
                        <div class="carousel-caption">
                            <h5 class="slider-text"><?php echo $row['StockItemName']; ?> </h5>
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
        if (mysqli_num_rows($result_product) > 0) {
            while ($row = mysqli_fetch_assoc($result_product)) {
                $prijs = $row['RecommendedRetailPrice'];
                ?>
                <div class="col-sm-3 col-md-3">
                    <a href="Pages/product_pagina.php?product=<?php echo $row['StockItemID']; ?>"
                       class="text-decoration-none">
                        <div class="card border-0">
                            <img src="data:image/png;base64,<?php echo base64_encode($row['Photo']) ?>"
                                 class="card-img-top w-75 mx-auto">
                            <div class="card-body">
                                <h5 class="card-title text-dark"><?php echo $row['StockItemName']; ?></h5>
                                <h5 class="card-title text-dark">
                                    € <?php echo str_replace(".", ",", "$prijs"); ?></h5>
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

    <! –– Paginering -->
    <script>
        /***
         * Zet de parameter in de url
         * @param {String} key the parameter key
         * @param {String} value the parameter value
         * @returns {URL} the url with the changed parameter
         */
        function setParam(key, value) {
            let url = new window.URL(window.location.href);
            let searchParams = url.searchParams;
            searchParams.set(key, value);
            url.searchParams = searchParams;
            return window.location = url;
        }

    </script>
    <div class="row mt-5">
        <nav aria-label="Page navigation example" class="float-left w-75">
            <ul class="pagination float-left w-75">
                <?php

                if($pagina > 1) {
                    //Print "Vorige" pagina link
                    print('<li class="page-item"><a class="page-link" href="?'. getParam($pagina - 1) .  '" tabindex = "-1" >&lt;</a ></li >');
                }
                if($pagina > 3) {
                    //Print de eerste pagina link
                    print('<li class="page-item"><a class="page-link" href="?'.getParam(1).'" tabindex="-1">1</a></li>');
                    print('<li class="page-item"><a class="page-link disabled text-dark">...</a></li>');
                }
                for($i = $pagina - 2; $i <= $pagina + 2; $i++) {
                    //print the vorige 2, en volgende 2 pagina links
                    if($i < 1 || $i > $aantal_paginas) continue;
                    $currentPageHighlight = "";
                    if($pagina == $i)
                        $currentPageHighlight = " bg-dark text-white";
                    print('<li class="page-item"><a class="page-link'.$currentPageHighlight.'" href="?'. getParam($i) . '">'.$i.'</a></li>');
                }
                if($pagina < $aantal_paginas - 2) {
                    //Print de laatste pagina link
                    print('<li class="page-item"><a class="page-link disabled text-dark">...</a></li>');
                    print('<li class="page-item"><a class="page-link" href="?'.getParam($aantal_paginas).'">'.$aantal_paginas.'</a></li>');
                }
                if($pagina != $aantal_paginas) {
                    //print de "Volgende" pagina link
                    print('<li class="page-item"><a class="page-link" href="?'.getParam($pagina + 1).'">&gt;</a></li>');
                }
                ?>
            </ul>
        </nav>
        <label class="w-25 float-right">
            <select class="custom-select" onchange="setParam('itemsPerPage', this.value)">
                <option value="" disabled="" selected>Resultaten per pagina</option>
                <option value="12" <?php setSelected('itemsPerPage', 12);?>>12</option>
                <option value="24" <?php setSelected('itemsPerPage', 24);?>>24</option>
                <option value="32" <?php setSelected('itemsPerPage', 32);?>>32</option>
                <option value="48" <?php setSelected('itemsPerPage', 48);?>>48</option>
                <option value="64" <?php setSelected('itemsPerPage', 64);?>>64</option>
            </select>
        </label>

    </div>
    <! –– Einde paginering -->

    <! –– Categorie -->
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
                            <img src="data:image/png;base64,<?php echo base64_encode($row['Photo']) ?>"
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
print_footer("index");
?>


