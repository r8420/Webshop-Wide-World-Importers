DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `update_customer_account`(
personID INT,
streetNumber VARCHAR(60),
postcode VARCHAR(10),
city VARCHAR(60), 
province VARCHAR(60),
country VARCHAR(60)
)
BEGIN

UPDATE customers 
SET DeliveryCityID = InsertOrReturnCityStateCountry(city, province, country),
DeliveryAddressLine2 = streetNumber,
DeliveryPostalCode = postcode,
PostalAddressLine2= city,
PostalPostalCode = postcode
WHERE PrimaryContactPersonID = personID;

SELECT CustomerID FROM customers WHERE PrimaryContactPersonID = personID;
    

END$$
DELIMITER ;
