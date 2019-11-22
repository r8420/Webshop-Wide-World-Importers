<?php
include '../Modules/head.php';
include '../Modules/header.php';
include '../DatabaseFactory.php';

$connectionObject = new DatabaseFactory();
$connection = $connectionObject->getConnection();
if($connection == false) {
    die("Can't connect to database");
}

$search = ISSET($_GET['search']) ? $_GET['search'] : '';
$category = ISSET($_GET['category']) ? $_GET['category'] : null;

//Als de category niet gespecificeerd is
if($category == null) {
    $stmt = $connection->prepare("SELECT * FROM stockitems WHERE SearchDetails LIKE ?");
} else {
    $stmt = $connection->prepare("SELECT * FROM stockitemstockgroups sisg JOIN stockitems si ON si.StockItemID = sisg.StockItemID WHERE si.SearchDetails LIKE ? AND sisg.StockGroupID LIKE ?");
}

$searchSQL = '%'.$search.'%';
$stmt->bind_param("s", $searchSQL);

$stmt->execute();
$result = $stmt->get_result();

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
                        $numResults = $result->num_rows;
                        print("<h5 class=\"float-left\">$numResults resultaten voor '$search'</h5>")
                        ?>
                        <select class="float-right custom-select w-25">
                            <option value="" disabled="" selected>Sorteer op</option>
                            <option value="name">Naam</option>
                            <option value="dateNewOld">Datum: Nieuw-Oud</option>
                            <option value="dateOldNew">Datum: Oud-Nieuw</option>
                            <option value="priceLowHigh">Prijs: Laag-Hoog</option>
                            <option value="priceHighLow">Prijs: Hoog-Laag</option>
                        </select>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div>

                            </div>
                        </li>
                        <?php
                        while($row = $result->fetch_assoc()) {
                            $productName = $row['StockItemName'];
                            $productPrice = $row['RecommendedRetailPrice'];
                            $productPhoto = base64_encode($row['Photo']);
                            print('<li class="list-group-item shadow"><img src="data:image/jpeg;base64,' . $productPhoto . '" width="100" height="100"><span class="col-8">'.$productName.'</span><span class="col-4">'. $productPrice.'</span></li>');
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>
    </main>
<?php
include('../Modules/footer.php');
?>