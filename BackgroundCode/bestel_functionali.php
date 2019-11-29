<?php

function BestelGegevens($CustomerName, $DeliveryCityID, $Phonenumber, $DeliveryAdressLine, $DeliveryPostalCode, $connection)
{
    $return = false;
    try {
        $query = mysqli_prepare($connection, "insert into customers (CustomerName, DeliveryCityID, PhoneNumber, DeliveryAdressLine1, DeliveryPostalCode) values (?,?,?,?,?)");
        $query->bind_param("sisss", $CustomerName, $DeliveryCityID, $Phonenumber, $DeliveryAdressLine, $DeliveryPostalCode);
        $query->execute();
        $return = true;

    } catch (mysqli_sql_exception $e) {
        $return = false;
    }
    return $return;
}

?>
