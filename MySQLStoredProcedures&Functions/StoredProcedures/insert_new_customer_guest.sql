DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `insert_new_customer_guest`(
streetNumber VARCHAR(60),
postcode VARCHAR(10),
city VARCHAR(60), 
province VARCHAR(60),
country VARCHAR(60), 
fullname VARCHAR(60),
tel VARCHAR(15),
email VARCHAR(60)
)
BEGIN

INSERT INTO people (PersonID, FullName, PhoneNumber, EmailAddress) 
    SELECT (max(PersonID)+1), fullname, tel, email FROM people;  
    
INSERT INTO customers (CustomerID, CustomerName, PrimaryContactPersonID, DeliveryCityID, PhoneNumber,
 DeliveryAddressLine2, DeliveryPostalCode, PostalAddressLine2, PostalPostalCode) SELECT
 (max(C.CustomerID)+1), fullname, getLastPersonID(), InsertOrReturnCityStateCountry(city, province, country), tel, streetNumber, postcode, city, postcode from customers C;
    
SELECT max(CustomerID), max(PersonID) from customers
JOIN people ON PersonID = PrimaryContactPersonID;

END$$
DELIMITER ;