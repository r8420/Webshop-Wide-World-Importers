DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` FUNCTION `getunitPrice`(
ID INT) RETURNS double
    DETERMINISTIC
BEGIN
	DECLARE newUnitPrice DOUBLE DEFAULT NULL;

    
    SELECT UnitPrice FROM stockitems WHERE StockItemID = ID INTO newUnitPrice;
	RETURN newUnitPrice;
END$$
DELIMITER ;