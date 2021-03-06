<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//Een manier om de session aan te passen via de jQuery post
if (isset($_POST['updateCart'])) {
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

    $stmt = $connection->prepare('CALL get_product_information(?)');
    $stmt->bind_param('i', $productID);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
}

/***
 * Krijg het hoeveelheid die in het magazijn zit.
 * @param $productID INT Het productID om mee te kijken
 * @return array
 */
function getProductStock($productID) {
    global $connection;

    $stmt = $connection->prepare('CALL get_product_stock(?)');
    $stmt->bind_param('i', $productID);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result->fetch_assoc()['QuantityOnHand'];
}

/***
 * @param int $productID De product ID
 * @param int $amount De hoeveelheid
 */
function updateCart($productID, $amount) {
    if ($amount <= 0) {
        unset($_SESSION['shoppingCart'][$productID]);
    } else {
        $_SESSION['shoppingCart'][$productID] = $amount;
    }
}

