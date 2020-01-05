DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_number_results_category`(
search VARCHAR(60),
category INT
)
BEGIN

SELECT COUNT(*) 
FROM
(
SELECT si.StockItemID FROM stockitemstockgroups sisg 
JOIN stockitems si ON si.StockItemID = sisg.StockItemID 
JOIN stockgroups sg ON sg.StockGroupID = sisg.StockGroupID 
WHERE sisg.StockGroupID LIKE category AND si.SearchDetails LIKE concat('%',search, '%')
GROUP BY
CASE
	WHEN StockItemName LIKE "%(%" THEN REVERSE(SUBSTRING(REVERSE(stockitemname), INSTR(REVERSE(stockitemname), '(')))
	ELSE stockitemname
END
) f;
END$$
DELIMITER ;
