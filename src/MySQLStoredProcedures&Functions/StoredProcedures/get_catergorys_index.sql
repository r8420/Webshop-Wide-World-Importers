DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_catergorys_index`(
)
BEGIN
SELECT i.StockItemName, i.Photo, sg.StockGroupName, g.StockGroupID
                FROM stockitems i
                JOIN stockitemstockgroups g ON i.StockItemID = g.StockItemID
                JOIN stockgroups sg ON g.StockGroupID = sg.StockGroupID
                group by sg.StockGroupName;
END$$
DELIMITER ;
