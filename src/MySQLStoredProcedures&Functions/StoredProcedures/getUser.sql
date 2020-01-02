DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `getUser`(
userId INTEGER
 )
BEGIN
	SELECT PersonID, FullName, PhoneNumber, EmailAddress FROM people WHERE PersonID = userId;
END$$
DELIMITER ;
