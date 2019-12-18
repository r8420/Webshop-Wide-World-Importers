<?php
// Buffer the output so nothing will be output until the PHP script ends.
// Because then the header() function can be used after the headers are set.
ob_start();

// Refresh cache so we dont get ERR_CACHE_MISS when we use the back button on the shopping cart.
session_cache_limiter('private, must-revalidate');


include 'Modules/functions.php';


include 'includes/productFunctions.inc.php';

$productId = (checkInt('GET', 'id') ? $_GET['id'] : false);
$amount = (checkInt('POST', 'amount') ? $_POST['amount'] : false);
$productInfo = getProductInfo($productId);
$tags = json_decode($productInfo['CustomFields'], true);



// If there's no product id defined, go back to index.php
if (!$productId) {
    header('Location: ./ ');
    die();
}

// If there is any amount that needs to be added to cart, add it.
if ($amount) {
    addToCart($productId, $amount);
}
print_header();
?>
<div class="container">
    <?php if ($amount) {
        ?>
        <div id="updateCartAlert" class="alert alert-success" role="alert">
            Dit item is toegevoegd aan uw winkelwagen. U heeft dit product nu
            <?php echo $_SESSION['shoppingCart'][$productId]; ?>
            keer in uw winkelwagen.
        </div>
        <?php
    }
    ?>
    <div class="row">
        <div class="col-md-8">
            <div class="m-5">
                <img src="data:image/jpeg;base64, <?php echo base64_encode($productInfo['Photo']) ?>" class="w-60"
                     alt="Artikel foto"/>
            </div>
            <div class="product-foto">
                <?php
                $stmt = $connection->prepare('SELECT picture FROM imgs WHERE StockItemID = ?');
                $stmt->bind_param('i', $productId);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                ?>
                        <img src="data:image/jpeg;base64, <?php echo base64_encode($row['picture']) ?>"
                             alt="Artikel foto"/>
                <?php
                    }
                }
                ?>

            </div>

            <div class="m5">
                <h3><strong>Productbeschrijving</strong></h3>
                <?php
                if (!isset($tags['Tags'][0])) {
                    $tags['Tags'][0] = '';
                }
                ?>
                <?php print(sprintf('<p>Gebruik de %s voor al je %s skills.
                    Door de super goede %s is %s geen grote klus meer. Moet je het product een keer
                    meenemen, dan maak je het niet te zwaar voor jezelf. Deze %s weegt namelijk maar %s gram. Ook in het
                    donker werken vormt geen enkel probleem, want met deze %s is het niet moeilijk om
                    de juiste weg te vinden.</p>',
                    $productInfo['StockItemName'], strtolower($tags['Tags'][0]), $productInfo['StockItemName'], strtolower($tags['Tags'][0]),
                    $productInfo['StockItemName'], $productInfo['TypicalWeightPerUnit'], $productInfo['StockItemName'])) ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mt-5">
                <h1><?php echo $productInfo['StockItemName'] ?></h1>
            </div>
            <div>
                <p>
                    <?php
                    foreach ($tags['Tags'] as $tag => $tagValue) {
                        echo $tagValue;
                        if ($tag !== count($tags['Tags']) - 1) {
                            echo ', ';
                        }
                    }
                    ?>
                </p>
            </div>
            <div>
                <p><?php echo $productInfo['MarketingComments'] ?>
                </p>
            </div>
            <div>
                <h2>€<?php echo $productInfo['price'] ?></h2>
            </div>
            <div>
                <p><i class="fas fa-circle text-success"> </i> In voorraad</p>
            </div>
            <div>
                <form method="post">
                    <div class="row">
                        <div class="col-4">
                            <input name="amount" type="number" min="0" class="form-control" id="aantal" value="1">
                        </div>
                        <div class="col-8">
                            <button type="submit" class="btn btn-success">In winkelwagen</button>
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <p>Voor 23.59 uur besteld, morgen gratis bezorgd
                    Gratis binnen 30 dagen te retourneren
                    Onze klantenservice is tot 23.59 uur geopend
                    Klanten geven WWI een 10/10</p>
            </div>
        </div>
    </div>
</div>
<?php
print_footer();
?>

