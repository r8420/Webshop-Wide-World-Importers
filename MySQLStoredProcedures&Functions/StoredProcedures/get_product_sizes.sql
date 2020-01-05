DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_product_sizes`(
param_StockName VARCHAR(200)
)
BEGIN
SELECT DISTINCT Size, StockItemID
FROM stockitems 
where size != '' 
AND StockItemName LIKE 
CASE
	WHEN param_StockName LIKE "%(%" THEN CONCAT('%',REVERSE(SUBSTRING(REVERSE(param_StockName), INSTR(REVERSE(param_StockName), ')'))),'%')
        ELSE
        param_StockName
END
ORDER by IF(length(size)<5,StockItemID,StockItemName);
END$$
DELIMITER ;