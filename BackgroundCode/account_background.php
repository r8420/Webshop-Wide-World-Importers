<?php
function getUser($userId, $connection){
    $tbName = "people";
    $sql = "SELECT PersonID, FullName, PhoneNumber, EmailAddress FROM $tbName WHERE PersonID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s",$userId);
    $stmt->execute();
    $stmt->bind_result($PersonID, $FullName, $PhoneNumber, $EmailAddress);
    $stmt->store_result();
    $stmt->fetch();
    return array($PersonID, $FullName, $PhoneNumber, $EmailAddress);
}
?>
