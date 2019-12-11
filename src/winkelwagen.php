<?php
include "Modules/functions.php";
print_header();
include "BackgroundCode/winkelwagen_backcode.php";
?>
    <div class="container">
        <div class="m-5">
            <h1>Winkelwagen</h1>
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
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($_SESSION['shoppingCart'])) {
                    $shoppingCart = $_SESSION['shoppingCart'];
                } else {
                    $shoppingCart = array();
                }

                $totalPrice = 0;
                foreach ($shoppingCart as $productID=>$amount) {
                    $productInfo = getProductInformation($productID);
                    $numberInStock = getProductStock($productID);

                    $productName = strip_tags($productInfo['StockItemName']);
                    $productPriceFormatted = strip_tags($productInfo['price']);
                    $productPrice = strip_tags($productInfo['RecommendedRetailPrice']);
                    $productPhoto = base64_encode($productInfo['Photo']);
                    $totalPrice += $amount*$productPrice;
                    print('
                    <tr id="row'.$productID.'">
                        <td>
                            <a href="product_pagina.php?product='.$productID.'">
                            <img src="data:image/jpeg;base64,' . $productPhoto . '" alt="Artikelfoto"
                            </a>
                        </td>
                        <td>
                            <a href="product_pagina.php?product='.$productID.'">'.$productName.'</a>
                        </td>
                        <td>
                            <input min="0" max="'.$numberInStock.'" onchange="sendPostRequest('.$productID.', this.value, '.$productPrice.')" class="form-control w-60" type="number" value="'.$amount.'">
                        </td>
                        <td>€'.$productPriceFormatted.'</td>
                        <td id="productPrice'.$productID.'">€'.number_format($productPrice*$amount, 2, ',', '.').'</td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="sendPostRequest('.$productID.', 0, '.$productPrice.')"><i style="font-size: 17px" class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>');
                }
                print('<tr class="bg-dark text-white">
                    <td></td>
                    <td></td>
                    <td></td>
                    <th scope="row">Totaal</th>
                    <th id="totalPrice" scope="row">€'.number_format($totalPrice, 2, ',', '.').'</th>
                    <td></td>
                </tr>');
                ?>
                </tbody>
            </table>
            <div class="my-5">
                <button class="btn btn-success ml-5 mr-4 float-right" onclick="window.location.href='#'">Bestellen</button>
                <button class="btn btn-primary mr-5 float-right mr-1" onclick="window.location.href='index.php'">Terug naar homepagina</button>
            </div>
            <div class="p-5">

            </div>
        </div>
    </div>
<script src="js/winkelwagen_ajax.js"></script>
<!--    <div class="container">-->
<!--        <div class="m-5">-->
<!--            <h1>Winkelwagen</h1>-->
<!--        </div>-->
<!--        <div class="row col-12 bg-dark text-white border rounded-top">-->
<!--            <div class="col-2 mt-3 mb-3"></div>-->
<!--            <div class="col-4 mt-3 mb-3">-->
<!--                <p class="m-0"> Artikel</p>-->
<!--            </div>-->
<!--            <div class="col-2 mt-3 mb-3">-->
<!--                <p class="m-0">Aantal:</p>-->
<!--            </div>-->
<!--            <div class="col-2 mt-3 mb-3">-->
<!--                <p class="m-0">Prijs:</p>-->
<!--            </div>-->
<!--            <div class="col-2 mt-3 mb-3">-->
<!--                <p class="m-0">Totaal:</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row col-12 border rounded-0 ">-->
<!--            <div class="col-2 mt-1 mb-1">-->
<!--                <img src="Images/logo.png">-->
<!--            </div>-->
<!--            <div class="col-4 m-auto">-->
<!--                <p class="m-0"> article</p>-->
<!--            </div>-->
<!--            <div class="col-2 m-auto">-->
<!--                <form>-->
<!--                    <input type="number" min="0" class="form-control" id="aantal" placeholder="2">-->
<!--                </form>-->
<!--            </div>-->
<!--            <div class="col-2 m-auto">-->
<!--                <p class="m-0"> 12.00</p>-->
<!--            </div>-->
<!--            <div class="col-2 m-auto">-->
<!--                <p class="m-0">24.00</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row col-12 bg-dark text-white border rounded-bottom">-->
<!--            <div class="col-2 mt-3 mb-3"></div>-->
<!--            <div class="col-4 mt-3 mb-3">-->
<!--                <p class="m-0"> Totaal:</p>-->
<!--            </div>-->
<!--            <div class="col-2 mt-3 mb-3">-->
<!--            </div>-->
<!--            <div class="col-2 mt-3 mb-3">-->
<!--            </div>-->
<!--            <div class="col-2 mt-3 mb-3">-->
<!--                <p class="m-0">24.00</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row mt-5 mb-5">-->
<!--            <div class="col-8"></div>-->
<!--            <div class="col-2 ">-->
<!--                <a href="zoekpagina.php"><button class="mb-2 btn-primary pt-1 pb-1 pl-2 px-2 rounded"><strong>Door winkelen</strong></button></a>-->
<!--            </div>-->
<!--            <div class="col-2 ">-->
<!--                <a href="bestel.php"><button class="mb-2 btn-primary pt-1 pb-1 pl-2 px-2 rounded"><strong>Afrekenen</strong></button></a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->


<?php
print_footer();
?>