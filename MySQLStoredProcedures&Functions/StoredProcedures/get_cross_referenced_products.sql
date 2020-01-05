
DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_cross_referenced_products`(
productID INT)
BEGIN


DECLARE categorieID INT DEFAULT NULL;
SELECT StockGroupID FROM stockitemstockgroups SG WHERE SG.StockItemID = productID 
ORDER BY rand() limit 1
INTO categorieID;

SELECT SI.StockItemID, StockItemName, UnitPrice, RecommendedRetailPrice, Photo FROM stockitems SI
JOIN stockitemstockgroups SG ON SG.StockItemID = SI.StockItemID
WHERE SG.StockGroupID = categorieID
ORDER BY RAND() LIMIT 4;


END$$
DELIMITER ;