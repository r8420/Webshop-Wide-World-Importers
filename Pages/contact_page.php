<?php
include "../Modules/functions.php";
print_header();
?>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col">
            <h1>Contact<br><br></h1>

            <h2>Contact opnemen</h2>

            <p>Heeft u vragen over één van de producten die wij verkopen of heeft u een probleem met uw
                bestelling?
                Om
                een
                antwoord
                op deze en andere vragen te krijgen kunt u ons op maandag t/m vrijdag bereiken via onze <em
                        class="text-info">telefonische klantenservice.</em>
            </p>
            <h2>Contactgegevens</h2>
            <div class="container"><em><p>
                        WWI<br>
                        Torenstraat 118<br>
                        Dordrecht<br>
                        Zuid-Holland<br>
                        3311 TP<br>
                        +31 9404393940<br>
                        wwi@nfiewfoewnf.nl</em></p>
            </div>
        </div>
        <div class="col mt-1">
            <img src="../Images/Map.jpg">
            <div class="w-60 float-center mt-2">
                <form>
                    Naam*: <input class="form-control float-right" type="text" name="naam" required><br><br>
                    Ordernummer: <input class="form-control float-right" type="text" name="ordernummer"><br><br>
                    E-mailadres*: <input class="form-control float-right" type="email" name="email" required><br>
                    Bericht*:<br> <textarea name="bericht" class="form-control" rows="7" cols="60"
                                            required></textarea><br>
                    <div class="row justify-content-center"><input type="submit" class="btn btn-success pl-4 px-4"
                                                                   value="Verzenden"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
print_footer();
?>


