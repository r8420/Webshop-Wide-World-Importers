<?php

function getUser($userId, $connection){

    $sql = "CALL getUser(?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($personId, $fullName, $phoneNumber, $emailAddress);
    $stmt->store_result();
    $stmt->fetch();

    return array($personId, $fullName, $phoneNumber, $emailAddress);
}
function getAssociatedOrders($userId, $connection){
    $orders = array();

    $sql = "CALL getAssociatedOrders(?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($orderId);
    $stmt->store_result();
    while ($stmt->fetch()){
        $orders[] = $orderId;
    }
    return $orders;



}
?>

