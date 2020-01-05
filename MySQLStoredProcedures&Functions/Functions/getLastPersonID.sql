DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` FUNCTION `getLastPersonID`() RETURNS int(11)
    DETERMINISTIC
BEGIN
		DECLARE lastID INT;
			SELECT max(PersonID) FROM people into lastID ;
			RETURN lastID;
	END$$
DELIMITER ;