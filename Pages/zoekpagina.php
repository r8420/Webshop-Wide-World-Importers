<?php

if (isset($_POST['id']) && filter_var($_POST['id'], FILTER_VALIDATE_INT)) {
    $cartProductID = $_POST['id'];
}

session_start();

function addToCart($productId, $amount)
{
    if (!isset($_SESSION["shoppingCart"])) {
        $_SESSION["shoppingCart"] = array();
    }
    if (isset($_SESSION["shoppingCart"][$productId])) {
        $_SESSION["shoppingCart"][$productId] += $amount;
    } else {
        $_SESSION["shoppingCart"][$productId] = $amount;
    }
}

if (isset($_POST['id']) && isset($_POST['addToCart'])) {
    addToCart($cartProductID, 1);
}


include "../Modules/functions.php";
print_header();
include "../BackgroundCode/zoekfunctie_backcode.php";

$search = getIfExists('search', '');
$category = getIfExists('category', 0);
$orderBy = getIfExists('order', 'nameAZ');
$itemsPerPage = getIfExists('itemsPerPage', 12);
$page = getIfExists('page', 1);


$categoryName = getCategoryName($category);

$numResults = getNumberResults($search, $category);
$totalPages = ceil($numResults / $itemsPerPage);

//Als de gegeven pagina buiten de hoogste pagina valt, zet de pagina naar de hoogst mogelijke
if ($page > $totalPages)
    $page = $totalPages;
?>
    <main class="container">
        <?php if (isset($_POST['id']) && isset($_POST['addToCart'])) {
            ?>
            <div id="updateCartAlert" class="alert alert-success" role="alert">
                <?php echo "Dit item is toegevoegd aan uw winkelwagen. U heeft dit product nu " . $_SESSION["shoppingCart"][$cartProductID] . " keer in uw winkelwagen."; ?>
            </div>
            <?php
        }
        ?>
        <div class="row">
            <!-- Voor nu niet nodig
            <form class="col-3 pr-0">
                <div class="card" style="">
                    <div class="card-body form-row">
                        <h5 class="card-title pl-1 w-100">Prijs</h5>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Min</label>
                            <input type="number" class="form-control" id="inputEmail4" placeholder="0">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Max</label>
                            <input type="number" class="form-control" id="inputPassword4" placeholder="0">
                        </div>
                    </div>
                </div>
                <div class="card border-top-0" style="">
                    <div class="card-body">
                        <h5 class="card-title">Specificaties</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <button class="btn btn-outline-primary" type="button" data-toggle="collapse"
                                    data-target="#collapseExample" aria-expanded="false"
                                    aria-controls="collapseExample">
                                Kleur
                            </button>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input class="custom-control-input" type="checkbox" name="colorGreen"
                                               id="colorGreen" value="Groen">
                                        <label class="custom-control-label" for="colorGreen">Groen</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input class="custom-control-input" type="checkbox" name="colorGray"
                                               id="colorGray" value="Grijs">
                                        <label class="custom-control-label" for="colorGray">Grijs</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input class="custom-control-input" type="checkbox" name="colorBlack"
                                               id="colorBlack" value="Zwart">
                                        <label class="custom-control-label" for="colorBlack">Zwart</label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
            </form>
            -->
            <div class="col-11 pl-0">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <?php
                        if ($category == 0) {
                            print("<h5 class=\"float-left\">$numResults resultaten voor '$search'</h5>");
                        } else {
                            print("<h5 class=\"float-left\">$numResults resultaten voor '$search' in category $categoryName</h5>");
                        }
                        ?>
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
                        <select class="float-right custom-select w-25" onchange="setParam('order', this.value);">
                            <option value="" disabled="" selected>Sorteer op</option>
                            <option value="nameAZ" <?php setSelected('order', 'nameAZ'); ?>>Naam: A-Z</option>
                            <option value="nameZA" <?php setSelected('order', 'nameZA'); ?>>Naam: Z-A</option>
                            <option value="priceLowHigh" <?php setSelected('order', 'priceLowHigh'); ?>>Prijs:
                                Laag-Hoog
                            </option>
                            <option value="priceHighLow" <?php setSelected('order', 'priceHighLow'); ?>>Prijs:
                                Hoog-Laag
                            </option>
                        </select>
                    </div>
                    <li class="list-group list-group-flush text-dark" id="productList">
                    <li class="list-group-item">
                        <div>

                        </div>
                    </li>
                    <?php
                    if ($numResults > 0) {
                        $resultArray = getSearchResults($search, $category, $orderBy, $page, $itemsPerPage);
                        for ($i = 0; $i < count($resultArray) && $i < abs(($page - 1) * $itemsPerPage - $numResults); $i++) {
                            $productName = strip_tags($resultArray[$i]['StockItemName']);
                            $productPrice = strip_tags($resultArray[$i]['UnitPrice']);
                            $productPrice = str_replace(".", ",", $productPrice);
                            $productPhoto = base64_encode($resultArray[$i]['Photo']);
                            print('<li class="list-group-item shadow"><a href="product_pagina.php?product=' . $resultArray[$i]["StockItemID"] . '"><img src="data:image/jpeg;base64,' . $productPhoto . '" width="190" height="120"><span class="col-8">' . $productName . '</span><span class="col-4">'."€ " . $productPrice . '</span></a>');
                            ?>
                            <form method="post" style="display: inline;">

                                <input name="id" type="hidden"
                                       value="<?php echo $resultArray[$i]["StockItemID"] ?>" style="display: inline;">

                                <button name="addToCart" type="submit" class="btn btn-success float-right my-5">In
                                    winkelwagen
                                </button>


                            </form>
                            </li>
                            <?php
                        }
                    }
                    ?>
                    </ul>
                    <div class="card">
                        <div class="card-body align-content-center">
                            <select class="float-right custom-select w-25"
                                    onchange="setParam('itemsPerPage', this.value)">
                                <option value="" disabled="" selected>Resultaten per pagina</option>
                                <option value="12" <?php setSelected('itemsPerPage', 12); ?>>12</option>
                                <option value="24" <?php setSelected('itemsPerPage', 24); ?>>24</option>
                                <option value="32" <?php setSelected('itemsPerPage', 32); ?>>32</option>
                                <option value="48" <?php setSelected('itemsPerPage', 48); ?>>48</option>
                                <option value="64" <?php setSelected('itemsPerPage', 64); ?>>64</option>
                            </select>
                            <ul class="pagination float-left w-75">
                                <?php
                                if ($page > 1) {
                                    //Print "Vorige" pagina link
                                    print('<li class="page-item"><a class="page-link" href = "' . change_url_parameter("page", $page - 1) . '" tabindex = "-1" >&lt;</a ></li >');
                                }
                                if ($page > 3) {
                                    //Print de eerste pagina link
                                    print('<li class="page-item"><a class="page-link" href="' . change_url_parameter("page", 1) . '" tabindex="-1">1</a></li>');
                                    print('<li class="page-item"><a class="page-link disabled text-dark">...</a></li>');
                                }
                                for ($i = $page - 2; $i <= $page + 2; $i++) {
                                    //print the vorige 2, en volgende 2 pagina links
                                    if ($i < 1 || $i > $totalPages) continue;
                                    $currentPageHighlight = "";
                                    if ($page == $i)
                                        $currentPageHighlight = " bg-dark text-white";
                                    print('<li class="page-item"><a class="page-link' . $currentPageHighlight . '" href="' . change_url_parameter("page", $i) . '">' . $i . '</a></li>');
                                }
                                if ($page < $totalPages - 2) {
                                    //Print de laatste pagina link
                                    print('<li class="page-item"><a class="page-link disabled text-dark">...</a></li>');
                                    print('<li class="page-item"><a class="page-link" href="' . change_url_parameter("page", $totalPages) . '">' . $totalPages . '</a></li>');
                                }
                                if ($page != $totalPages) {
                                    //print de "Volgende" pagina link
                                    print('<li class="page-item"><a class="page-link" href = "' . change_url_parameter("page", $page + 1) . '">&gt;</a></li>');
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
print_footer();
?>