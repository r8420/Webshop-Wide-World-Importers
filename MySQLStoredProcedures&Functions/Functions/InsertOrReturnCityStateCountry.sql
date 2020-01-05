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
