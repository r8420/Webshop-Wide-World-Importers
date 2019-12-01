<?php

function getSqlResults($orderIDget, $userNr, $connection)
{
    $results = array();

    $query = mysqli_prepare($connection, "CALL order_history(?,?)");
    $query->bind_param("ii", $orderIDget, $userNr);
    $query->execute();
    $query->bind_result($contactPersonID, $orderID, $quantity, $stockItemName, $unitPrice);
    while ($query->fetch()) {
        $row = array($contactPersonID, $orderID, $quantity, $stockItemName, $unitPrice);
        $results[] = $row;
    }
    return $results;

}

?>
