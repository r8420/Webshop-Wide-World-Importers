<?php
include "../Modules/functions.php";
print_header();
?>
    <div class="container">
        <div class="m-5">
            <h1>Winkelwagen</h1>
        </div>
        <div class="row col-12 bg-dark text-white border rounded-top">
            <div class="col-2 mt-3 mb-3"></div>
            <div class="col-4 mt-3 mb-3">
                <p class="m-0"> Artikel</p>
            </div>
            <div class="col-2 mt-3 mb-3">
                <p class="m-0">Aantal:</p>
            </div>
            <div class="col-2 mt-3 mb-3">
                <p class="m-0">Prijs:</p>
            </div>
            <div class="col-2 mt-3 mb-3">
                <p class="m-0">Totaal:</p>
            </div>
        </div>
        <div class="row col-12 border rounded-0 ">
            <div class="col-2 mt-1 mb-1">
                <img src="../Images/logo.png">
            </div>
            <div class="col-4 m-auto">
                <p class="m-0"> article</p>
            </div>
            <div class="col-2 m-auto">
                <form>
                    <input type="number" min="0" class="form-control" id="aantal" placeholder="2">
                </form>
            </div>
            <div class="col-2 m-auto">
                <p class="m-0"> 12.00</p>
            </div>
            <div class="col-2 m-auto">
                <p class="m-0">24.00</p>
            </div>
        </div>
        <div class="row col-12 bg-dark text-white border rounded-bottom">
            <div class="col-2 mt-3 mb-3"></div>
            <div class="col-4 mt-3 mb-3">
                <p class="m-0"> Totaal:</p>
            </div>
            <div class="col-2 mt-3 mb-3">
            </div>
            <div class="col-2 mt-3 mb-3">
            </div>
            <div class="col-2 mt-3 mb-3">
                <p class="m-0">24.00</p>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-8"></div>
            <div class="col-2 ">
                <a href="zoekpagina.php"><button class="mb-2 btn-primary pt-1 pb-1 pl-2 px-2 rounded"><strong>Door winkelen</strong></button></a>
            </div>
            <div class="col-2 ">
                <a href="bestel.php"><button class="mb-2 btn-primary pt-1 pb-1 pl-2 px-2 rounded"><strong>Afrekenen</strong></button></a>
            </div>
        </div>
    </div>


<?php
print_footer();
?>