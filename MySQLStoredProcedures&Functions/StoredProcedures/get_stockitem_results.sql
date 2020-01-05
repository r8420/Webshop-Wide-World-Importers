DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_stockitem_results`(
search VARCHAR(60),
ordersql INT,
off_set INT,
item_per_page INT 
)
BEGIN
SELECT StockItemID, TRIM(TRAILING ' (' FROM 
	CASE
		WHEN StockItemName LIKE "%(%" THEN REVERSE(SUBSTRING(REVERSE(stockitemname), INSTR(REVERSE(stockitemname), '(')))
		ELSE stockitemname
	END) 
as StockItemName, RecommendedRetailPrice, Photo FROM stockitems WHERE MATCH (stockitemname, searchdetails, tags) AGAINST (CONCAT('+',REPLACE(
CASE
	WHEN length(search)>1 THEN search
    ELSE 'a'
END
,' ', '* +'),'*') IN BOOLEAN MODE) OR searchdetails LIKE CONCAT('%',search,'%')
GROUP BY
CASE
	WHEN StockItemName LIKE "%(%" THEN REVERSE(SUBSTRING(REVERSE(stockitemname), INSTR(REVERSE(stockitemname), '(')))
	ELSE stockitemname
END
ORDER BY 
(CASE 
	WHEN ordersql=3 THEN RecommendedRetailPrice
    END)
    ASC,
(CASE 
	WHEN ordersql=1 THEN StockItemName
    END)
    ASC,
(CASE     
	WHEN ordersql=4 THEN RecommendedRetailPrice
    END)
    DESC,
(CASE 
	WHEN ordersql=2 THEN StockItemName
    END)
    DESC
 
 LIMIT off_set, item_per_page;
     
END$$
DELIMITER ;