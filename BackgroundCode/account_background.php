<?php

function getUser($userId, $connection){

    $sql = "CALL getUser(?)";
//    $connection = startDBConnection();
    $stmt = $connection->prepare($sql);
//    if (mysqli_stmt_prepare( $sql, $connection)) {
//        mysqli_stmt_bind_param($stmt, "s", $userId);
//        mysqli_stmt_execute($stmt);
//        mysqli_stmt_bind_result($stmt, $personId, $fullName, $phoneNumber, $emailAddress);
//        mysqli_stmt_fetch($stmt);
//        mysqli_stmt_close($stmt);
//    }
//
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($personId, $fullName, $phoneNumber, $emailAddress);
    $stmt->store_result();
    $stmt->fetch();
    $stmt->close();

    print_r($personId, $fullName, $phoneNumber, $emailAddress);
    return array($personId, $fullName, $phoneNumber, $emailAddress);
}
function getUserAddress($userId, $connection){

    $sql = "CALL getUserAddress(?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($address, $postCode, $cityName, $stateProvince, $country);
    $stmt->store_result();
    $stmt->fetch();

    return array($address, $postCode, $cityName, $stateProvince, $country);
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

