<?php
include '../Modules/head.php';
include '../Modules/header.php';
?>
    <main class="container">
        <div class="row">
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
            <div class="col-9 pl-0">
                <div class="card border-left-0">
                    <div class="card-body">
                        <?php
                        $search = ISSET($_GET['search']) ? $_GET['search'] : '';
                        print("<h5 class=\"float-left\">x resultaten voor '$search'</h5>")
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
                            <!-- HIER KOMEN DE KAARTEN VAN DE ARTIKELEN-->
                            <div class="container">
                                Test
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
<?php
include('../Modules/footer.php');
?>