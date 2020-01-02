DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_stock_group`(
stock_group_id INT
 )
BEGIN
SELECT StockGroupName FROM stockgroups WHERE StockGroupID = stock_group_id;
END$$
DELIMITER ;