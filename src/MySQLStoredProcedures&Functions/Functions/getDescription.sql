

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` FUNCTION `getDescription`(
ID DOUBLE) RETURNS varchar(100) CHARSET latin1
    DETERMINISTIC
BEGIN
	DECLARE newUnitPrice DOUBLE DEFAULT NULL;

    
    SELECT StockItemName FROM stockitems WHERE StockItemID = ID INTO newUnitPrice;
	RETURN newUnitPrice;
END$$
DELIMITER ;