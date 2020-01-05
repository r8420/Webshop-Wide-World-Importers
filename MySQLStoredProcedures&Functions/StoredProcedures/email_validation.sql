DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `email_validation`( email_user VARCHAR(50) )
BEGIN
	SELECT LogonName FROM people WHERE LogonName = email_user ;
END$$
DELIMITER ;