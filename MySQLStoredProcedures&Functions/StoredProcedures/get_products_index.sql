DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_products_index`(
)
BEGIN
SELECT StockItemID,  TRIM(TRAILING ' (' FROM 
	CASE
		WHEN StockItemName LIKE "%(%" THEN REVERSE(SUBSTRING(REVERSE(stockitemname), INSTR(REVERSE(stockitemname), '(')))
		ELSE stockitemname
	END) 
as StockItemName, UnitPrice, RecommendedRetailPrice, Photo FROM stockitems 
GROUP BY
CASE
	WHEN StockItemName LIKE "%(%" THEN REVERSE(SUBSTRING(REVERSE(stockitemname), INSTR(REVERSE(stockitemname), '(')))
	ELSE stockitemname
END
order by rand() LIMIT 12;
END$$
DELIMITER ;