<?php


function getIndexProducts($connection){

    $results = array();
    $sql = "CALL get_products_index()";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($stockItemID, $stockItemName, $unitPrice, $recommendedRetailPrice, $photo);

    while ($stmt->fetch()) {
        $row = array($stockItemID, $stockItemName, $unitPrice, $recommendedRetailPrice, $photo);
        $results[] = $row;
    }
    $stmt->close();
    return $results;


}

function getIndexSlider($connection){
    $results = array();
    $sql = "CALL get_slider_index()";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($stockItemID, $stockItemName, $recommendedRetailPrice, $photo);

    while ($stmt->fetch()) {
        $row = array($stockItemID, $stockItemName, $recommendedRetailPrice, $photo);
        $results[] = $row;
    }
    $stmt->close();
    return $results;
}



function getIndexCategorys($connection){
    $results = array();
    $sql = "CALL get_catergorys_index()";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($stockItemName, $photo, $stockGroupName, $stockGroupID);

    while ($stmt->fetch()) {
        $row = array($stockItemName, $photo, $stockGroupName, $stockGroupID);
        $results[] = $row;
    }
    $stmt->close();
    return $results;
}

?>