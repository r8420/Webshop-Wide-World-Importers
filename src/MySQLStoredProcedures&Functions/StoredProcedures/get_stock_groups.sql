DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_stock_groups`()
BEGIN 
SELECT DISTINCT sg.StockGroupID, sg.StockGroupName FROM stockgroups sg
JOIN stockitemstockgroups sitg ON sitg.StockGroupID = sg.StockGroupID;
END$$
DELIMITER ;
