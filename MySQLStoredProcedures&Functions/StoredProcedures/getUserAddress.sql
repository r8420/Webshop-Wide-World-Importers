
DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `getUserAddress`(
userId INTEGER
 )
BEGIN
	SELECT CU.DeliveryAddressLine2, CU.DeliveryPostalCode , C.CityName, SP.StateProvinceName, CON.CountryName FROM customers CU
    JOIN cities C ON C.CityID = CU.DeliveryCityID
    JOIN stateprovinces SP ON C.StateProvinceID = SP.StateProvinceID
    JOIN countries CON ON CON.CountryID = SP.CountryID
    JOIN people PE ON PE.PersonID = CU.PrimaryContactPersonID
    WHERE PersonID = userId;
END$$
DELIMITER ;