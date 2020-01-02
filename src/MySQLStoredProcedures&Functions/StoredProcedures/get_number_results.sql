
DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_number_results`(
search VARCHAR(60)
)
BEGIN
SELECT count(*) 
FROM
(
SELECT StockItemID, StockItemName, RecommendedRetailPrice, Photo FROM stockitems WHERE MATCH (stockitemname, searchdetails, tags) AGAINST (CONCAT('+',REPLACE(
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
) t;
END$$
DELIMITER ;
