<?php

/***
 * Een functie om de informatie over een product/artikel uit de database te halen
 * @param int $productID De product ID om de informatie uit de database te halen
 * @return array("StockItemID"=>int,"StockItemName"=>string,"UnitPrice"=>int,"Photo"=>blob)
 */
function getProductInformation($connection, $productID) {
    $stmt = $connection->prepare('CALL get_product_information_bestel(?)');
    $stmt->bind_param('i', $productID);
    $stmt->execute();
    $stmt->bind_result($stockItemID, $stockItemName, $recommendedRetailPrice);
    $stmt->fetch();
    $stmt->close();
    return array($stockItemID, $stockItemName, $recommendedRetailPrice);
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
    $stmt->bind_result($customerNr, $personNr);
    $stmt->fetch();
    $stmt->close();
    return array ($customerNr, $personNr);

}


function updateCustomerRecordsOldNaw($connection, $nawRecords){

    $sql = 'CALL update_customer_account(?,?,?,?,?,?)';
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('isssss', $_SESSION['userNr'], $nawRecords[0], $nawRecords[1], $nawRecords[2], $nawRecords[3], $nawRecords[4]);
    $stmt->execute();
    $stmt->bind_result($customerNr);
    $stmt->fetch();
    $stmt->close();
    return array ($customerNr, $_SESSION['userNr']);
}

function insertNewCustomerAccount($connection,$nawRecords){

    $sql = 'CALL insert_customer_account(?,?,?,?,?,?)';
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('isssss', $_SESSION['userNr'], $nawRecords[0], $nawRecords[1], $nawRecords[2], $nawRecords[3], $nawRecords[4],
        );
    $stmt->execute();
    $stmt->bind_result($customerNr);
    $stmt->fetch();
    $stmt->close();
    return array ($customerNr, $_SESSION['userNr']);
}

function orderinsert($connection, $customerinfo){

    $orderNr = insertOrderNr($connection, $customerinfo);

    foreach ($_SESSION['shoppingCart'] AS $key => $item){
        insertOrderLines($connection, $orderNr, $key, $item);

    }

    return $orderNr;


}
function insertOrderNr($connection, $customerinfo ){
    $sql = "CALL insert_orderNr(?,?)";
    $stmt = $connection->prepare($sql);
    print_r($customerinfo);
    $stmt->bind_param('ii',$customerinfo[0],$customerinfo[1]);
    $stmt->execute();
    $stmt->bind_result($orderNr);
    $stmt->store_result();
    $stmt->fetch();
    $stmt->close();

    return $orderNr;
}

function insertOrderLines($connection,$orderID, $stockitemId, $quantity){

    $sql = "CALL insert_order_lines(?,?,?);";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("iii", $orderID, $stockitemId, $quantity);
    $stmt->execute();
    $stmt->close();

}

function headtoconfirmpage($orderNr){

    unset($_SESSION['shoppingCart']);
    header('Refresh: 0; url=../succes.php?orderNr=' . $orderNr);
    exit();
}

function getCountrys($connection){

    $result_countrys = array();

    $stmt = $connection->prepare('CALL getCountrys()');
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row =$result->fetch_assoc()){
        $result_countrys[] = $row['CountryName'];
    }

    $stmt->close();

    return $result_countrys;
}




?>