DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `insert_account`(
full_name  VARCHAR(50),
email_user VARCHAR(50),
hashed_password VARCHAR(60),
phone_number VARCHAR(20)
 )
BEGIN
	INSERT INTO people (PersonID, FullName, LogonName, HashedPassword, PhoneNumber, EmailAddress) 
    SELECT (max(PersonID)+1), full_name, email_user, hashed_password, phone_number, email_user FROM people;
END$$
DELIMITER ;
