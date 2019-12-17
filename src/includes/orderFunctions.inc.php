<?php

/***
 * Een functie om de informatie over een product/artikel uit de database te halen
 * @param int $productID De product ID om de informatie uit de database te halen
 * @return array("StockItemID"=>int,"StockItemName"=>string,"UnitPrice"=>int,"Photo"=>blob)
 */
function getProductInformation($connection, $productID) {
    $stmt = $connection->prepare('CALL get_product_information(?)');
    $stmt->bind_param('i', $productID);
    $stmt->execute();
    $stmt->bind_result($stockItemID, $stockItemName, $recommendedRetailPrice, $price, $photo, $customFields, $typicalWeightPerUnit, $marketingComments);
    $stmt->fetch();
    return array($stockItemID, $stockItemName, $recommendedRetailPrice, $price, $photo, $customFields, $typicalWeightPerUnit, $marketingComments);
}

function getProductInformationOrder($connection, $productID, $quantity) {
    $stmt = $connection->prepare('CALL get_product_information_order(?,?)');
    $stmt->bind_param('ii', $quantity, $productID);
    $stmt->execute();
    $stmt->bind_result($stockItemID, $stockItemName, $newQuantity, $unitPrice);
    $stmt->fetch();
    return array("stockitem" => $stockItemID, "itemdescription" => $stockItemName, "quantity" => $newQuantity, "unitprice" => $unitPrice);
}

function updateCustomerRecords($connection, $nawRecords, $orderType){
    switch ($orderType){
        case 1:
            $customerNr = insertNewCustomerGuest($connection, $nawRecords);
            break;
        case 2:
            $customerNr = updateCustomerRecordsOldNaw($connection, $nawRecords);
            break;
        case 3:
            $customerNr = insertNewCustomerAccount($connection,$nawRecords);
            break;
        default:
            $customerNr = null;
            break;
    }
    return $customerNr;


}

function insertNewCustomerGuest($connection, $nawRecords){

    $sql = 'CALL insert_new_customer_guest(?,?,?,?,?,?,?,?)';
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('ssssssss', $nawRecords[0], $nawRecords[1], $nawRecords[2], $nawRecords[3], $nawRecords[4],
        $nawRecords[5], $nawRecords[6], $nawRecords[7]);
    $stmt->execute();
    $stmt->bind_results($customerNr, $personNr);
    $stmt->fetch();
    return array ($customerNr, $personNr);

}


function updateCustomerRecordsOldNaw($connection, $nawRecords){

    $sql = 'CALL update_customer_account(?,?,?,?,?,?)';
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('isssss', $_SESSION['userNr'], $nawRecords[0], $nawRecords[1], $nawRecords[2], $nawRecords[3], $nawRecords[4],
        $nawRecords[5]);
    $stmt->execute();
    $stmt->bind_results($customerNr);
    $stmt->fetch();
    return array ($customerNr, $_SESSION['userNr']);
}

function insertNewCustomerAccount($connection,$nawRecords){

    $sql = 'CALL insert_customer_account(?,?,?,?,?,?)';
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('isssss', $_SESSION['userNr'], $nawRecords[0], $nawRecords[1], $nawRecords[2], $nawRecords[3], $nawRecords[4],
        $nawRecords[5]);
    $stmt->execute();
    $stmt->bind_results($customerNr);
    $stmt->fetch();
    return array ($customerNr, $_SESSION['userNr']);
}

function orderinsert($connection, $customerinfo){
    $shoppingCartArray = array();
    $i = 0;
    foreach ($_SESSION['shoppingCart'] AS $key => $item){
        $currentproduct = getProductInformationOrder($connection, $key, $item);
        $shoppingCartArray[] = $currentproduct;
        $i++;
    }
    $jsonShoppingCart = json_encode($shoppingCartArray, JSON_FORCE_OBJECT);

    $sql = "CALL insert_order(?,?,?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('iis',$customerinfo[0],$customerinfo[1], $jsonShoppingCart);
    $stmt->execute();
    $stmt->bind_results($orderNr);
    $stmt->fetch();

    return $orderNr;


}

function headtoconfirmpage($orderNr){
    header('Refresh: 0; url=../login.php?errorcode=' . $orderNr);
    exit();
}

function getCountrys($connection){

    $result_countrys = array();

    $res = $connection->query('CALL getCountrys()');
    while ($row =$res->fetch_assoc()){
        $result_countrys[] = $row['CountryName'];
    }


    return $result_countrys;
}




?>