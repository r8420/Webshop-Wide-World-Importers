

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` FUNCTION `getLastOrderID`() RETURNS int(11)
    DETERMINISTIC
BEGIN
		DECLARE lastID INT;
			SELECT max(OrderID) FROM orders into lastID ;
			RETURN lastID;
	END$$
DELIMITER ;