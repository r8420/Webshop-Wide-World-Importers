DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_product_colors`(
param_StockName VARCHAR(200), 
param_size VARCHAR(20)
)
BEGIN
SELECT DISTINCT ColorName, colors.ColorID, StockItemID 
from colors 
left join stockitems on colors.ColorID = stockitems.ColorID 
where colors.ColorID != 0 
AND size = param_size
AND StockItemName LIKE 
CASE
	WHEN param_StockName LIKE "%(%" THEN CONCAT('%',REVERSE(SUBSTRING(REVERSE(param_StockName), INSTR(REVERSE(param_StockName), '('))),'%') 
        ELSE
        param_StockName
END;
END$$
DELIMITER ;
