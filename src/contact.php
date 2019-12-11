<?php
include 'Modules/functions.php';
print_header();

//stuurt mail mits ingevuld en beveiligd door strip_tags.
if (isset($_POST['naam'], $_POST['bericht'], $_POST['email'])) {

    $name = strip_tags($_POST['naam']);
    $message = strip_tags($_POST['bericht']);
    $message = nl2br($message);
    $email = strip_tags($_POST['email']);
    $ordernummer = strip_tags($_POST['ordernummer']);
    $finalMessage = 'Een nieuw bericht ontvangen van ' . $name . ' (' . $email . ')<br>';
    if (isset($ordernummer) && !empty($ordernummer)) {
        $finalMessage .= '<b>Ordernummer:</b> ' . $ordernummer . '<br>';
    }
    $finalMessage .= '<b>Bericht:</b><br>';
    $finalMessage .= $message;
    if (!empty($name) && !empty($message) && !empty($email)) {
        // Always set content-type when sending HTML email
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";

        // More headers
        $headers .= 'From: Wide World Importers <admin@wwiproject.ml>' . "\r\n";
        $headers .= 'Reply-To: ' . $email . "\r\n";

        if (mail('admin@wwiproject.ml', 'Nieuw contact form bericht van ' . $name, $finalMessage, $headers)) {
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
            <div class="container"><em>
                    WWI<br>
                    Herengracht 450<br>
                    Amsterdam<br>
                    Noord-Holland<br>
                    1017 CA<br>
                    +31 9404393940<br>
                    admin@wwiproject.ml</em>
            </div>
        </div>
        <div class="col mt-1">
            <img src="Images/Map.jpg" alt="Kaart">
            <div class="w-60 float-center mt-2">
                <form method="post">
                    <label class="d-block">Naam*:
                        <input class="form-control float-right" type="text" name="naam" required>
                    </label><br><br>
                    <label class="d-block">Ordernummer:
                        <input class="form-control float-right" type="text" name="ordernummer">
                    </label><br><br>
                    <label class="d-block">E-mailadres*:
                        <input class="form-control float-right" type="email" name="email" required>
                    </label><br>
                    <br> <label class="d-block">Bericht*:
                        <textarea name="bericht" class="form-control" rows="7" cols="60"
                                  required></textarea>
                    </label><br>
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
