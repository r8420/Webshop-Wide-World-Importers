DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_product_stock`(
ID INT
 )
BEGIN
SELECT QuantityOnHand FROM stockitemholdings WHERE StockItemID = ID;
END$$
DELIMITER ;
