<?php
include "../Modules/functions.php";
print_header();

//stuurt mail mits ingevuld en beveiligd door strip_tagz.
if (isset($_POST['naam']) && isset($_POST['bericht']) && isset($_POST['email'])) {

    $name = strip_tags($_POST['naam']);
    $message = strip_tags($_POST['bericht']);
    $message = nl2br($message);
    $email = strip_tags($_POST['email']);
    $ordernummer = strip_tags($_POST['ordernummer']);
    $finalmessage = 'Een nieuw bericht ontvangen van ' . $name . ' (' . $email . ')<br>';
    if (isset($ordernummer) && !empty($ordernummer)) {
        $finalmessage .= '<b>Ordernummer:</b> ' . $ordernummer . '<br>';
    }
    $finalmessage .= '<b>Bericht:</b><br>';
    $finalmessage .= $message;
    if (!empty($name) && !empty($message) && !empty($email)) {
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: Wide World Importers <admin@wwiproject.ml>' . "\r\n";
        $headers .= 'Reply-To: ' . $email . "\r\n";

        if (mail('admin@wwiproject.ml', 'Nieuw contact form bericht van ' . $name, $finalmessage, $headers)) {
            echo "<script>alert('Uw bericht is verzonden')</script>";
        }

    }
}
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
                <form method="post">
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
