DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` FUNCTION `get_categoryID`(
productID INT) RETURNS int(1)
    DETERMINISTIC
BEGIN
DECLARE categorieID INT DEFAULT NULL;
SELECT StockGroupID FROM stockitemstockgroups SG WHERE SG.StockItemID = productID 
limit 1
INTO categorieID;

RETURN categorieID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` FUNCTION `getDescription`(
ID DOUBLE) RETURNS varchar(100) CHARSET latin1
    DETERMINISTIC
BEGIN
	DECLARE newUnitPrice DOUBLE DEFAULT NULL;

    
    SELECT StockItemName FROM stockitems WHERE StockItemID = ID INTO newUnitPrice;
	RETURN newUnitPrice;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` FUNCTION `getLastOrderID`() RETURNS int(11)
    DETERMINISTIC
BEGIN
		DECLARE lastID INT;
			SELECT max(OrderID) FROM orders into lastID ;
			RETURN lastID;
	END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` FUNCTION `getLastPersonID`() RETURNS int(11)
    DETERMINISTIC
BEGIN
		DECLARE lastID INT;
			SELECT max(PersonID) FROM people into lastID ;
			RETURN lastID;
	END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` FUNCTION `getQuantity`(ID INT) RETURNS int(11)
    DETERMINISTIC
BEGIN
DECLARE quantityOnHandAfter INT DEFAULT NULL;
    
SELECT 
    QuantityOnHand
FROM
    stockitemholdings
WHERE
    StockItemID = ID INTO quantityOnHandAfter;
    
 RETURN quantityOnHandAfter;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` FUNCTION `getunitPrice`(
ID INT) RETURNS double
    DETERMINISTIC
BEGIN
	DECLARE newUnitPrice DOUBLE DEFAULT NULL;

    
    SELECT UnitPrice FROM stockitems WHERE StockItemID = ID INTO newUnitPrice;
	RETURN newUnitPrice;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` FUNCTION `InsertOrReturnCityStateCountry`(
city VARCHAR(60), 
provinceState VARCHAR(60),
country VARCHAR(60)) RETURNS int(11)
    DETERMINISTIC
BEGIN
	DECLARE returncityID INT DEFAULT NULL;
    DECLARE returnProvinceStateID INT DEFAULT NULL;
	DECLARE newCityID INT DEFAULT NULL;
    DECLARE newProvinceStateID INT DEFAULT NULL;
    DECLARE newCountryID INT DEFAULT NULL;
    
SELECT 
    CountryID
FROM
    countries
WHERE
    CountryName = country INTO newCountryID;
	
    IF newCountryID IS NULL THEN
    RETURN NULL;
    ELSE
    
    
    
SELECT 
    StateProvinceID
FROM
    stateprovinces
WHERE
    provinceState = StateProvinceName
        AND newCountryID = CountryID INTO newProvinceStateID;
    
    IF newProvinceStateID IS NOT NULL THEN
    SELECT CityID FROM cities WHERE city = cityName AND newProvinceStateID = StateProvinceID INTO newCityID;
	
    IF newCityID IS NULL THEN
    INSERT INTO cities (CityID, CityName, StateProvinceID) SELECT (max(CityID)+1), city, newProvinceStateID FROM cities;
    else 
    RETURN newCityID ;
    END IF;
 
    ELSEIF newProvinceStateID IS NULL THEN
    INSERT INTO stateprovinces (StateProvinceID, StateProvinceName, CountryID) 
    SELECT  (max(StateProvinceID)+1), provinceState, newCountryID FROM stateprovinces;
    
SELECT 
    MAX(StateProvinceID)
FROM
    stateprovinces INTO returnProvinceStateID;
    INSERT INTO cities (CityID, CityName, StateProvinceID) SELECT (max(CityID)+1), city, returnProvinceStateID FROM cities;
    END IF;
SELECT 
    MAX(CityID)
FROM
    cities INTO returncityID;
    RETURN returncityID;
    
END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` FUNCTION `setQuantity`(quantityOnHandAfter INT, ID INT) RETURNS int(11)
BEGIN

UPDATE stockitemholdings SET QuantityOnHand = quantityOnHandAfter WHERE StockItemID = ID;

RETURN NULL;
END$$
DELIMITER ;
