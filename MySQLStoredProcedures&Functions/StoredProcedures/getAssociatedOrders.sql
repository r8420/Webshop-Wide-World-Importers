DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `getAssociatedOrders`(
userId INT
 )
BEGIN
	SELECT OrderID FROM orders WHERE ContactPersonID = userId;
END$$
DELIMITER ;