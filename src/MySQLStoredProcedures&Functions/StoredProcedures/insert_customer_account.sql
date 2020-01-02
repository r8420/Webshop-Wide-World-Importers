DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `insert_customer_account`(
personID INT,
streetNumber VARCHAR(60),
postcode VARCHAR(10),
city VARCHAR(60), 
province VARCHAR(60),
country VARCHAR(60)
)
BEGIN

INSERT INTO customers (CustomerID, PrimaryContactPersonID, DeliveryCityID,
DeliveryAddressLine2, DeliveryPostalCode, PostalAddressLine2, PostalPostalCode) SELECT
(max(C.CustomerID)+1), personID, InsertOrReturnCityStateCountry(city, province, country), streetNumber, postcode, city, postcode from customers C;

SELECT CustomerID FROM customers WHERE PrimaryContactPersonID = personID;
    

END$$
DELIMITER ;