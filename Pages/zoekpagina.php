<?php
include "../Modules/functions.php";
print_header();
include '../DatabaseFactory.php';
$connectionObject = new DatabaseFactory();
$connection = $connectionObject->getConnection();
if($connection == false) {
    die("Can't connect to database");
}

$search = ISSET($_GET['search']) ? $_GET['search'] : '';
$category = ISSET($_GET['category']) ? $_GET['category'] : null;
$orderBy = ISSET($_GET['order']) ? $_GET['order'] : 'nameAZ';

$searchSQL = '%'.$search.'%';

//PAGINATION CODE
$page = ISSET($_GET['page']) ? $_GET['page'] : 1;
$numOfItemsPerPage = ISSET($_GET['itemsPerPage']) ? $_GET['itemsPerPage'] : 10;
$offset = ($page - 1) * $numOfItemsPerPage;

//Order by code
$orderSQL = "ORDER BY StockItemName";
switch ($orderBy) {
    case 'nameAZ':
        $orderSQL = "ORDER BY StockItemName";
        break;
    case 'nameZA':
        $orderSQL = "ORDER BY StockItemName DESC";
        break;
    case 'priceHighLow':
        $orderSQL = "ORDER BY RecommendedRetailPrice DESC";
        break;
    case 'priceLowHigh':
        $orderSQL = "ORDER BY RecommendedRetailPrice";
        break;
}

/**
 * @param string $parameter The parameter to change
 * @param string $parameterValue The value the parameter should have
 * @return string The url with the changed parameter
*/
function change_url_parameter($parameter,$parameterValue) {
    $url=parse_url($_SERVER['REQUEST_URI']);
    parse_str($url["query"],$parameters);
    unset($parameters[$parameter]);
    $parameters[$parameter]=$parameterValue;
    return  $url["path"]."?".http_build_query($parameters);
}

//Als de category niet gespecificeerd is
if($category == null) {
    $stmt = $connection->prepare("SELECT StockItemName, RecommendedRetailPrice, Photo FROM stockitems WHERE SearchDetails LIKE ? $orderSQL LIMIT $offset, $numOfItemsPerPage");
    $stmt->bind_param("s", $searchSQL);

    $paginationSTMT = $connection->prepare("SELECT COUNT(*) FROM stockitems WHERE SearchDetails LIKE ? ");
    $paginationSTMT->bind_param("s", $searchSQL);
} else {
    $stmt = $connection->prepare("SELECT StockItemName, RecommendedRetailPrice, Photo, StockGroupName FROM stockitemstockgroups sisg JOIN stockitems si ON si.StockItemID = sisg.StockItemID JOIN stockgroups sg ON sg.StockGroupID = sisg.StockGroupID WHERE si.SearchDetails LIKE ? AND sisg.StockGroupID LIKE ? $orderSQL LIMIT $offset, $numOfItemsPerPage");
    $stmt->bind_param("si", $searchSQL, $category);

    $paginationSTMT = $connection->prepare("SELECT COUNT(*) FROM stockitemstockgroups sisg JOIN stockitems si ON si.StockItemID = sisg.StockItemID JOIN stockgroups sg ON sg.StockGroupID = sisg.StockGroupID WHERE si.SearchDetails LIKE ? AND sisg.StockGroupID LIKE ?");
    $paginationSTMT->bind_param("si", $searchSQL, $category);
}

$stmt->execute();
$result = $stmt->get_result();
if($category != null)
    $categoryName = $result->fetch_assoc()['StockGroupName'];

$paginationSTMT->execute();
$numResults = $paginationSTMT->get_result()->fetch_array()[0];
$totalPages = ceil($numResults / $numOfItemsPerPage);
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
                        if($category == null) {
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
                            <option value="nameAZ" <?php if(ISSET($_GET['order']) && $_GET['order'] == "nameAZ") print("selected");?>>Naam: A-Z</option>
                            <option value="nameZA" <?php if(ISSET($_GET['order']) && $_GET['order'] == "nameZA") print("selected");?>>Naam: Z-A</option>
                            <option value="priceLowHigh" <?php if(ISSET($_GET['order']) && $_GET['order'] == "priceLowHigh") print("selected");?>>Prijs: Laag-Hoog</option>
                            <option value="priceHighLow" <?php if(ISSET($_GET['order']) && $_GET['order'] == "priceHighLow") print("selected");?>>Prijs: Hoog-Laag</option>
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
                                <option value="12" <?php if(ISSET($_GET['itemsPerPage']) && $_GET['itemsPerPage'] == "12") print("selected");?>>12</option>
                                <option value="24" <?php if(ISSET($_GET['itemsPerPage']) && $_GET['itemsPerPage'] == "24") print("selected");?>>24</option>
                                <option value="32" <?php if(ISSET($_GET['itemsPerPage']) && $_GET['itemsPerPage'] == "32") print("selected");?>>32</option>
                                <option value="48" <?php if(ISSET($_GET['itemsPerPage']) && $_GET['itemsPerPage'] == "48") print("selected");?>>48</option>
                                <option value="64" <?php if(ISSET($_GET['itemsPerPage']) && $_GET['itemsPerPage'] == "64") print("selected");?>>64</option>
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