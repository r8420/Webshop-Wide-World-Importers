DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `getCountrys`(

 )
BEGIN
	SELECT CountryName FROM countries;
END$$
DELIMITER ;