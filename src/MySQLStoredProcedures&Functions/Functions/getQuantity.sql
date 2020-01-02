DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` FUNCTION `getQuantity`(ID INT) RETURNS int(11)
    DETERMINISTIC
BEGIN
DECLARE quantityOnHandAfter INT DEFAULT NULL;
    
SELECT 
    QuantityOnHand
FROM
    stockitemholdings
WHERE
    StockItemID = ID INTO quantityOnHandAfter;
    
 RETURN quantityOnHandAfter;
END$$
DELIMITER ;
