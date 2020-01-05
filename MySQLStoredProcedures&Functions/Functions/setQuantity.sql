
DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` FUNCTION `setQuantity`(quantityOnHandAfter INT, ID INT) RETURNS int(11)
BEGIN

UPDATE stockitemholdings SET QuantityOnHand = quantityOnHandAfter WHERE StockItemID = ID;

RETURN NULL;
END$$
DELIMITER ;
