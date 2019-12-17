<?php

use function Sodium\add;

/***
 * Een functie om de informatie over een product/artikel uit de database te halen
 * @param int $productID De product ID om de informatie uit de database te halen
 * @return array("StockItemID"=>int,"StockItemName"=>string,"UnitPrice"=>int,"Photo"=>blob)
 */
function getProductInformation($connection, $productID) {
    $stmt = $connection->prepare('CALL get_product_information(?)');
    $stmt->bind_param('i', $productID);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
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

    $sql = 'CALL insert_new_customer_guest(?,?,?,?,?,?)';
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('ssssssss', $nawRecords[0], $nawRecords[1], $nawRecords[2], $nawRecords[3], $nawRecords[4],
        $nawRecords[5]);
    $stmt->execute();
    $stmt->bind_results($customerNr, $personNr);
    $stmt->fetch();

    return array ($customerNr, $personNr);

}


function updateCustomerRecordsOldNaw($connection, $nawRecords){

}

function insertNewCustomerAccount($connection,$nawRecords){

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