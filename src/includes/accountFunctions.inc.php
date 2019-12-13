<?php

function getUser($userId, $connection) {

    $sql = 'CALL getUser(?)';
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->bind_result($personId, $fullName, $phoneNumber, $emailAddress);
    $stmt->store_result();
    $stmt->fetch();
    $stmt->close();
    return array($personId, $fullName, $phoneNumber, $emailAddress);
}

function getUserAddress($userId, $connection) {

    $sql = 'CALL getUserAddress(?)';
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->bind_result($address, $postCode, $cityName);
    $stmt->store_result();
    $stmt->fetch();
    $stmt->close();

    return array($address, $postCode, $cityName);
}


function getAssociatedOrders($userId, $connection) {
    $orders = array();

    $sql = 'CALL getAssociatedOrders(?)';
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->bind_result($orderId);
    $stmt->store_result();
    while ($stmt->fetch()) {
        $orders[] = $orderId;
    }
    return $orders;


}



