
DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_stockitem_results_category`(
search VARCHAR(60),
category INT,
ordersql INT,
off_set INT,
item_per_page INT 
)
BEGIN 
SELECT si.StockItemID, TRIM(TRAILING ' (' FROM 
	CASE
		WHEN StockItemName LIKE "%(%" THEN REVERSE(SUBSTRING(REVERSE(stockitemname), INSTR(REVERSE(stockitemname), '(')))
		ELSE stockitemname
	END) 
as StockItemName, RecommendedRetailPrice, Photo FROM stockitemstockgroups sisg 
JOIN stockitems si ON si.StockItemID = sisg.StockItemID 
JOIN stockgroups sg ON sg.StockGroupID = sisg.StockGroupID 
WHERE si.SearchDetails LIKE concat('%',search, '%') AND sisg.StockGroupID = category
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
 
LIMIT off_set,item_per_page;
END$$
DELIMITER ;
