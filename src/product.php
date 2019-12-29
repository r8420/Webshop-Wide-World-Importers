<?php
// Buffer the output so nothing will be output until the PHP script ends.
// Because then the header() function can be used after the headers are set.
ob_start();

// Refresh cache so we dont get ERR_CACHE_MISS when we use the back button on the shopping cart.
session_cache_limiter('private, must-revalidate');


include 'Modules/functions.php';


include 'includes/productFunctions.inc.php';
include 'includes/shoppingCartFunctions.inc.php';

$productId = (checkInt('GET', 'id') ? $_GET['id'] : false);
$amount = (checkInt('POST', 'amount') ? $_POST['amount'] : false);
$productInfo = getProductInfo($productId);
$tags = json_decode($productInfo['CustomFields'], true);
$numberInStock = getProductStock($productId);
$crossreferencedproducts = getCrossReferencedProducts($productId);


// If there's no product id defined, go back to index.php
if (!$productId || !isset($productInfo['StockItemName'])) {
    header('Location: ./');
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
                $stmt = $connection->prepare('CALL get_product_images(?)');
                $stmt->bind_param('i', $productId);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <img src="data:image/jpeg;base64, <?php echo base64_encode($row['picture']) ?>"
                             alt="Artikel foto"/>
                        <?php
                    }
                }

                $stmt->close();
                if (isset($productInfo['Video'])) {
                    ?>
                    <a href="#" data-toggle="modal" data-target="#videoModal">
                        <img src="Images/video-placeholder.gif"
                             alt="Artikel foto"/>
                    </a>


                    <?php

                }
                ?>

                <!-- Modal -->
                <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <video width="100%" height="100%" controls>
                                    <source src="videos/<?php echo $productInfo['Video'] ?>.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <script>
                $('#videoModal').on('hidden.bs.modal', function () {
                    $('video').trigger('pause');
                }).on('show.bs.modal', function () {
                    $('video').trigger('play');
                })
            </script>
        </div>
        <div class="col-md-4">
            <div class="mt-5">
                <h2><?php echo $productInfo['StockItemName'] ?></h2>
            </div>
            <div>
                <p>
                    <?php
                    if (isset($tags['Tags'][0])) {
                        echo 'Tags: ';

                        foreach ($tags['Tags'] as $tag => $tagValue) {
                            echo $tagValue;
                            if ($tag !== count($tags['Tags']) - 1) {
                                echo ', ';
                            }
                        }
                    }
                    ?>
                </p>
            </div>
            <div>
                <p><?php if (!empty($productInfo['MarketingComments'])) {
                        echo $productInfo['MarketingComments'];
                    } ?>
                </p>
            </div>
            <div>
                <h2>€<?php echo $productInfo['price'] ?></h2>
            </div>
            <div>
                <?php
                if ($numberInStock > 10) {
                    echo('<p><i class="fas fa-circle text-success"> </i><?php echo $numberInStock ?> In voorraad</p>');
                } elseif ($numberInStock > 1) {
                    echo('<p><i class="fas fa-circle text-warning"> </i><?php echo $numberInStock ?> Minder dan 10 in voorraad!</p>');
                } else {
                    echo('<p><i class="fas fa-circle text-danger"> </i><?php echo $numberInStock ?> Niet leverbaar</p>');
                }
                ?>

            </div>
            <div>
                <form method="post" class="mb-2">
                    <div class="row mb-2">

                        <?php
                        $stmt = $connection->prepare('CALL get_product_sizes(?)');
                        $stmt->bind_param('s', $productInfo['StockItemName']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 1) {
                            ?>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="size">Grootte/Maat</label>
                                    <select class="form-control" id="size"
                                            onchange="window.location.replace('product.php?id='+this.value)">
                                        <?php
                                        while ($row = $result->fetch_assoc()) {

                                            if ($productInfo['Size'] === $row['Size']) {
                                                echo '<option selected>';
                                            } else {
                                                echo '<option value="' . $row['StockItemID'] . '">';
                                            }


                                            //echo '<option>';
                                            echo $row['Size'];
                                            echo '</option>';
                                        }
                                        ?></select>
                                </div>
                            </div>
                            <?php
                        }
                        $stmt->close();
                        ?>


                        <?php
                        $stmt = $connection->prepare('CALL get_product_colors(?,?)');
                        $stmt->bind_param('ss', $productInfo['StockItemName'], $productInfo['Size']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 1) {
                            ?>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="color">Kleur</label>
                                    <select class="form-control" id="color"
                                            onchange="window.location.replace('product.php?id='+this.value)">
                                        <?php
                                        while ($row = $result->fetch_assoc()) {
                                            if ($productInfo['ColorID'] === $row['ColorID']) {
                                                echo '<option selected>';
                                            } else {
                                                echo '<option value="' . $row['StockItemID'] . '">';
                                            }
                                            echo $row['ColorName'];
                                            echo '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <?php
                        }

                        $stmt->close();
                        ?>


                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="aantal">Aantal</label><input name="amount" type="number" min="0"
                                                                     max="<?php echo $numberInStock; ?>"
                                                                     class="form-control" id="aantal" value="1">
                        </div>
                        <div class="col-8">
                            <label for="submitAmount">&nbsp;</label>
                            <button <?php if ($numberInStock < 1): echo 'disabled'; endif ?> type="submit"
                                                                                             id="submitAmount"
                                                                                             class="btn btn-success w-100">
                                In winkelwagen
                            </button>
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
    <div class="row">
        <?php
        if ($crossreferencedproducts !== null) {
            foreach ($crossreferencedproducts AS $product) {
                $prijs = $product[3]; ?>
                <div class="col-sm-3 col-md-3 mt-3">
                    <a href="product.php?id=<?php echo $product[0]; ?>"
                       class="text-decoration-none">
                        <div class="card border h-100 pt-3">
                            <img src="data:image/png;base64,<?php echo base64_encode($product[4]) ?>"
                                 class="card-img-top w-75 mx-auto" alt="Artikel foto">
                            <div class="card-body">
                                <h5 class="card-title text-dark text-center"><?php echo $product[1]; ?></h5>
                                <h5 class="card-title text-dark font-weight-bold">
                                    € <?php echo str_replace('.', ',', (string)$prijs); ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>
<?php
print_footer();
?>

