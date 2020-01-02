DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_slider_index`(
)
BEGIN
SELECT StockItemID, StockItemName, RecommendedRetailPrice, Photo
                FROM stockitems ORDER BY RAND() LIMIT 3;
END$$
DELIMITER ;