<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!function_exists('startDBConnection')) {
    global $connection;
    include '../DatabaseFactory.php';
    $connection = startDBConnection();
}

//Een manier om de session aan te passen via de jQuery post
if(isset($_POST['updateCart'])) {
    updateCart($_POST['productID'], $_POST['amount']);
    print(json_encode($_SESSION['shoppingCart']));
}

/***
 * Een functie om de informatie over een product/artikel uit de database te halen
 * @param int $productID De product ID om de informatie uit de database te halen
 * @return array("StockItemID"=>int,"StockItemName"=>string,"UnitPrice"=>int,"Photo"=>blob)
 */
function getProductInformation($productID) {
    global $connection;

    $stmt = $connection->prepare("SELECT StockItemID, StockItemName, UnitPrice, REPLACE(CAST(UnitPrice AS CHAR), '.', ',') as price, Photo FROM stockitems WHERE StockItemID = ?");
    $stmt->bind_param('i', $productID);
    $stmt->execute();
    $result = $stmt->get_result();

    $resultArray = $result->fetch_assoc();
    return $resultArray;
}

/***
 * @param int $productID De product ID
 * @param int $amount De hoeveelheid
 */
function updateCart($productID, $amount) {
    if($amount == 0) {
        unset($_SESSION['shoppingCart'][$productID]);
    } else {
        $_SESSION['shoppingCart'][$productID] = $amount;
    }
}

