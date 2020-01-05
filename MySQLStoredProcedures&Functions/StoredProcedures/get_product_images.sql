DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_product_images`(productID INT)
BEGIN
SELECT picture FROM imgs WHERE StockItemID = productID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_product_information`(
ID INT
 )
BEGIN
SELECT StockItemID, StockItemName, RecommendedRetailPrice, REPLACE(CAST(RecommendedRetailPrice AS CHAR), '.', ',') as price, Photo, Video, CustomFields, TypicalWeightPerUnit, MarketingComments, ColorID, Size FROM stockitems WHERE StockItemID = ID;
END$$
DELIMITER ;