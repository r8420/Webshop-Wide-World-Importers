<?php
include "../Modules/functions.php";
print_header();
include '../DatabaseFactory.php';
$connectionObject = new DatabaseFactory();
$connection = $connectionObject->getConnection();
if($connection == false) {
    die("Can't connect to database");
}

$search = getIfExists('search', '');
$category = getIfExists('category', 0);
$orderBy = getIfExists('order', 'nameAZ');
$itemsPerPage = getIfExists('itemsPerPage', 10);

$numResults = getNumberResults($search, $category);
$totalPages = ceil($numResults / $itemsPerPage);
?>
    <main class="container">
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
                <div class="card">
                    <div class="card-body">
                        <?php
                        if($category == 0) {
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
                            <option value="nameAZ" <?php setSelected('order', 'nameAZ');?>>Naam: A-Z</option>
                            <option value="nameZA" <?php setSelected('order', 'nameZA');?>>Naam: Z-A</option>
                            <option value="priceLowHigh" <?php setSelected('order', 'priceLowHigh');?>>Prijs: Laag-Hoog</option>
                            <option value="priceHighLow" <?php setSelected('order', 'priceHighLow');?>>Prijs: Hoog-Laag</option>
                        </select>
                    </div>
                    <ul class="list-group list-group-flush" id="productList">
                        <li class="list-group-item">
                            <div>

                            </div>
                        </li>
                        <?php
                        $resultArray = array();
                        while($row = $result->fetch_assoc()) {
                            $resultArray[] = $row;
                        }
                        for($i = 0; $i < $numOfItemsPerPage; $i++) {
                            $productName = strip_tags($resultArray[$i]['StockItemName']);
                            $productPrice = strip_tags($resultArray[$i]['RecommendedRetailPrice']);
                            $productPhoto = base64_encode($resultArray[$i]['Photo']);
                            print('<li class="list-group-item shadow"><img src="data:image/jpeg;base64,' . $productPhoto . '" width="100" height="100"><span class="col-8">'.$productName.'</span><span class="col-4">'. $productPrice.'</span></li>');
                        }
                        ?>
                        <script>
                            //now put it into the javascript
                            let arrayObjects = [<?php
                                    foreach ($resultArray as $item) {
                                        $productName = $item['StockItemName'];
                                        $productPrice = $item['RecommendedRetailPrice'];
                                        print("{'StockItemName':`$productName`, 'RecommendedRetailPrice': `$productPrice`},");
                                    }
                                ?>];
                            console.log(arrayObjects);
                        </script>
                        <li class="list-group-item">
                            <ul class="pagination">
                                <li class="page-item <?php if($page <= 1){ print 'disabled'; } ?>">
                                    <a class="page-link" href="<?php if($page <= 1){ print '#'; } else { print change_url_parameter("page", $page - 1); } ?>" tabindex="-1">Vorige</a>
                                </li>
                                <?php
                                    for($i = $page - 2; $i <= $page + 2; $i++) {
                                        if($i < 1 || $i > $totalPages) continue;
                                        print('<li class="page-item"><a class="page-link" href="'.change_url_parameter("page", $i).'">'.$i.'</a></li>');
                                    }
                                ?>
                                <li class="page-item <?php if($page >= $totalPages){ print 'disabled'; } ?>">
                                    <a class="page-link" href="<?php if($page >= $totalPages){ print '#'; } else { print change_url_parameter("page", $page + 1); } ?>">Volgende</a>
                                </li>
                            </ul>
                            <select class="float-right custom-select w-25" onchange="setParam('itemsPerPage', this.value)">
                                <option value="" disabled="" selected>Resultaten per pagina</option>
                                <option value="12" <?php setSelected('itemsPerPage', 12);?>>12</option>
                                <option value="24" <?php setSelected('itemsPerPage', 24);?>>24</option>
                                <option value="32" <?php setSelected('itemsPerPage', 32);?>>32</option>
                                <option value="48" <?php setSelected('itemsPerPage', 48);?>>48</option>
                                <option value="64" <?php setSelected('itemsPerPage', 64);?>>64</option>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
<?php
print_footer();
?>