DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `login_validation`( email_user VARCHAR(50) )
BEGIN
	SELECT PersonID, LogonName, HashedPassword FROM people WHERE LogonName = email_user ;
END$$
DELIMITER ;