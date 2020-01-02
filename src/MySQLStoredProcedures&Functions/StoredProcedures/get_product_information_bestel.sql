DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_product_information_bestel`(
ID INT
 )
BEGIN
SELECT StockItemID, StockItemName, RecommendedRetailPrice FROM stockitems WHERE StockItemID = ID  ;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_product_information_order`(
quantity INT,
ID INT
 )
BEGIN
SELECT StockItemID, StockItemName, quantity, UnitPrice FROM stockitems WHERE StockItemID = ID;
END$$
DELIMITER ;