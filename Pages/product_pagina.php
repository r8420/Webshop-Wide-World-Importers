<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




include "../Modules/functions.php";
print_header();

if (!filter_var($_GET['product'], FILTER_VALIDATE_INT)){
    die();
} else{
    $productId = $_GET['product'];
}


$stmt = $connection->prepare("SELECT *, REPLACE(CAST(stockitems.UnitPrice AS CHAR), '.', ',') as price FROM stockitems WHERE StockItemID = ?");
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
//print_r($row);
$tags = json_decode($row['CustomFields'], true);
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="m-5">
                <img src="data:image/jpeg;base64, <?php echo base64_encode($row['Photo'])?>" class="w-60"  onerror="this.src='https://source.unsplash.com/1600x900/?<?php echo $row['StockItemName']?>'" />
                <img type= src= class="w-60">
            </div>
            <div class="m5">
                <h3><strong>Productbeschrijving</strong></h3>
                <?php
                if(!isset($tags['Tags'][0])){
                    $tags['Tags'][0] = '';
                }
                ?>
                <?php print('<p>Gebruik de '.$row['StockItemName'].' voor al je '.strtolower($tags['Tags'][0]).' skills.
                    Door de super goede '.$row['StockItemName'].' is '.strtolower($tags['Tags'][0]).' geen grote klus meer. Moet je het product een keer
                    meenemen, dan maak je het niet te zwaar voor jezelf. Deze '.$row['StockItemName'].' weegt namelijk maar '.$row['TypicalWeightPerUnit'].' gram. Ook in het
                    donker werken vormt geen enkel probleem, want met deze '.$row['StockItemName'].' is het niet moeilijk om
                    de juiste weg te vinden.</p>')?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mt-5">
                <h1><?php echo $row['StockItemName']?></h1>
            </div>
<!--            <div class="card-body text-danger">-->
<!--                <i class="fas fa-star rating"></i>-->
<!--                <i class="fas fa-star rating"></i>-->
<!--                <i class="fas fa-star rating"></i>-->
<!--                <i class="fas fa-star rating"></i>-->
<!--                <i class="fas fa-star-half-alt rating"></i>-->
<!--            </div>-->
            <div>
                <p>
                    <?php

                    for ($i=0;$i<count($tags['Tags']);$i++){
                        echo $tags['Tags'][$i];
                        if($i != count($tags['Tags'])-1){
                            echo ', ';
                        }
                    }

                    ?>
                </p>
            </div>
            <div>
                <p><?php echo $row['MarketingComments']?>
                </p>
            </div>
            <div>
                <h2>€<?php echo $row['price']?></h2>
            </div>
            <div>
                <p><i class="fas fa-circle text-success"> </i>In voorraad</p>
            </div>
            <div>
                <form>
                    <div class="row">
                        <div class="col-4">
                            <input type="number" min="0" class="form-control" id="aantal" value="1">
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

