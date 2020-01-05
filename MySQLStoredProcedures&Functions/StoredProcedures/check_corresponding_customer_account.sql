DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `check_corresponding_customer_account`(
IN accountNr INT
)
BEGIN
SELECT count(customerID) AS customer from customers where PrimaryContactPersonID = accountNr;

END$$
DELIMITER ;