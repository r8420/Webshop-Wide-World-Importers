<?php
session_start();
include 'php/DatabaseFactory.php';
$connection = startDBConnection();

function print_header()
{
global $connection;



$stmt = $connection->prepare('CALL get_stock_groups()');
$stmt->execute();
$result_categorie = $stmt->get_result();
$stmt->close();

?>

    <!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/imports.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/imports-dist.js"></script>
    <title>WWI Webshop</title>
</head>
<body>
<div id="page-container">
    <div id="content-wrap">
        <nav class="navbar navbar-expand-lg bg-primary navbar-light mb-5">
            <div class="container">
                <a class="navbar-brand text-white mb-0 h1" href="./">
                    <img src="Images/wide-world-importers-logo-small.png" width="175" height="57"
                         alt="">
                </a>
                <div class="my-2 my-lg-0 d-lg-none">
                    <div class="fas dropdown fa-user text-white ml-5 mr-4" id="navbarDropdown1" role="button"
                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                            <a class="dropdown-item" href="login.php"
                               onclick="window.location.href='login.php'">Inloggen</a>
                            <a class="dropdown-item" href="registreren.php"
                               onclick="window.location.href='registreren.php'">Account
                                aanmaken</a>
                        </div>
                    </div>
                    <a class="shoppingCart" href="winkelwagen.php">
                        <span class="fa-stack fa-2x has-badge jsShoppingCart"
                              data-count="<?php echo getShoppingCartNumber() ?>">
                            <i class="fas fa-shopping-cart text-white"></i>
                        </span>
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white font-weight-bold" href="#" id="navbarDropdown"
                               role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categorieën bekijken
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php
                                if (mysqli_num_rows($result_categorie) > 0) {
                                    while ($row = mysqli_fetch_assoc($result_categorie)) {
                                        ?>
                                        <a class="dropdown-item"
                                           href="zoeken.php?category=<?php echo $row['StockGroupID']; ?>"><?php echo $row['StockGroupName']; ?></a>
                                        <?php
                                    }
                                } else {
                                    echo '0 results';
                                }

                                ?>
                            </div>
                        </li>
                    </ul>
                    <form class="form-inline mr-md-auto w-50" method="get"
                          action="zoeken.php">
                        <input class="form-control mr-sm-2 w-75" type="search" name="search" placeholder="Zoeken..."
                               aria-label="Search">
                    </form>
                </div>
                <div class="my-2 my-lg-0 d-none d-lg-block ">
                    <div class="fas dropdown fa-user text-white ml-5 mr-4" id="navbarDropdown1" role="button"
                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                            <?php if (isset($_SESSION['loggedin']) === FALSE || $_SESSION['loggedin'] === FALSE) { ?>
                                <a class="dropdown-item" href="login.php"
                                   onclick="window.location.href='login.php'">Inloggen</a>
                                <a class="dropdown-item" href="registreren.php"
                                   onclick="window.location.href='registreren.php'">Account
                                    aanmaken</a>
                            <?php } elseif (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE) {
                                ?>
                                <a class="dropdown-item" href="account.php"
                                   onclick="window.location.href='account.php'"
                                >Account
                                </a>
                                <a class="dropdown-item" href="logout.php"
                                   onclick="window.location.href='logout.php'"
                                >Uitloggen
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                    <a class="shoppingCart" href="winkelwagen.php">
                        <span class="fa-stack fa-2x has-badge jsShoppingCart"
                              data-count="<?php echo getShoppingCartNumber() ?>">
                            <i class="fas fa-shopping-cart text-white"></i>
                        </span>
                    </a>
                    <a href="contact.php">
                        <i class="fas fa-comments text-white"></i>
                    </a>
                </div>
            </div>
        </nav>


        <?php
        }

        /***
         * Get the number of items in the shopping cart
         * @return int
         */
        function getShoppingCartNumber() {
            if (isset($_SESSION['shoppingCart'])) {
                $shoppingCart = $_SESSION['shoppingCart'];
            } else {
                $shoppingCart = array();
            }
            $returnValue = 0;
            foreach ($shoppingCart as $value) {
                $returnValue += $value;
            }
            return $returnValue;
        }

        function print_footer($var = false)
        {
        ?>
    </div>
    <footer class="text-white bg-primary mt-5" id="fixed-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 pt-3 pb-4">
                    <img class="float-left mr-1" src="Images/logo.png" width="40px" height="40px" alt="Logo">
                    <h2>WWI</h2>
                    <p class="pt-2">Wide World Importers is een importeur en groothandel die producten levert aan
                        verschillende warenhuizen en supermarkten in de Verenigde Staten. Ook levert WWI producten door
                        aan
                        weer andere groothandels. Incidenteel verkoopt WWI producten rechtstreeks aan consumenten. WWI
                        werkt
                        met een groot netwerk aan vertegenwoordigers die het land doortrekken om hun producten in de
                        markt
                        te krijgen.</p>

                </div>
                <div class="col-sm-6 pt-3 pb-4">
                    <h2>Klantenservice</h2>
                    <p class="pt-2">Heeft u vragen over één van de producten die wij verkopen of heeft u eenprobleem met
                        uw
                        bestelling? Om een antwoord op deze en andere vragen te krijgen kunt u ons op maandag t/m
                        vrijdag bereiken via onze telefonische klantenservice
                        <br>
                        <b> 1017 CA, Amsterdam<br>
                            +31 9404393940 || wwi@wwi.nl</b>
                    </p>

                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>


<?php
}


?>


