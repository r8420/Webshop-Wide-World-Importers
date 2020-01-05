DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `check_corresponding_customer_account`(
IN accountNr INT
)
BEGIN
SELECT count(customerID) AS customer from customers where PrimaryContactPersonID = accountNr;

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `email_validation`( email_user VARCHAR(50) )
BEGIN
	SELECT LogonName FROM people WHERE LogonName = email_user ;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_catergorys_index`(
)
BEGIN
SELECT i.StockItemName, i.Photo, sg.StockGroupName, g.StockGroupID
                FROM stockitems i
                JOIN stockitemstockgroups g ON i.StockItemID = g.StockItemID
                JOIN stockgroups sg ON g.StockGroupID = sg.StockGroupID
                group by sg.StockGroupName;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_cross_referenced_products`(
productID INT)
BEGIN


DECLARE categorieID INT DEFAULT NULL;
SELECT StockGroupID FROM stockitemstockgroups SG WHERE SG.StockItemID = productID 
ORDER BY rand() limit 1
INTO categorieID;

SELECT SI.StockItemID, StockItemName, UnitPrice, RecommendedRetailPrice, Photo FROM stockitems SI
JOIN stockitemstockgroups SG ON SG.StockItemID = SI.StockItemID
WHERE SG.StockGroupID = categorieID
ORDER BY RAND() LIMIT 4;


END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_number_results`(
search VARCHAR(60)
)
BEGIN
SELECT count(*) 
FROM
(
SELECT StockItemID, StockItemName, RecommendedRetailPrice, Photo FROM stockitems WHERE MATCH (stockitemname, searchdetails, tags) AGAINST (CONCAT('+',REPLACE(
CASE
	WHEN length(search)>1 THEN search
    ELSE 'a'
END
,' ', '* +'),'*') IN BOOLEAN MODE) OR searchdetails LIKE CONCAT('%',search,'%')
GROUP BY
CASE
	WHEN StockItemName LIKE "%(%" THEN REVERSE(SUBSTRING(REVERSE(stockitemname), INSTR(REVERSE(stockitemname), '(')))
	ELSE stockitemname
END
) t;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_number_results_category`(
search VARCHAR(60),
category INT
)
BEGIN

SELECT COUNT(*) 
FROM
(
SELECT si.StockItemID FROM stockitemstockgroups sisg 
JOIN stockitems si ON si.StockItemID = sisg.StockItemID 
JOIN stockgroups sg ON sg.StockGroupID = sisg.StockGroupID 
WHERE sisg.StockGroupID LIKE category AND si.SearchDetails LIKE concat('%',search, '%')
GROUP BY
CASE
	WHEN StockItemName LIKE "%(%" THEN REVERSE(SUBSTRING(REVERSE(stockitemname), INSTR(REVERSE(stockitemname), '(')))
	ELSE stockitemname
END
) f;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_product_colors`(
param_StockName VARCHAR(200), 
param_size VARCHAR(20)
)
BEGIN
SELECT DISTINCT ColorName, colors.ColorID, StockItemID 
from colors 
left join stockitems on colors.ColorID = stockitems.ColorID 
where colors.ColorID != 0 
AND size = param_size
AND StockItemName LIKE 
CASE
	WHEN param_StockName LIKE "%(%" THEN CONCAT('%',REVERSE(SUBSTRING(REVERSE(param_StockName), INSTR(REVERSE(param_StockName), '('))),'%') 
        ELSE
        param_StockName
END;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_product_images`(productID INT)
BEGIN
SELECT picture FROM imgs WHERE StockItemID = productID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_product_information`(
ID INT
 )
BEGIN
SELECT StockItemID, StockItemName, RecommendedRetailPrice, REPLACE(CAST(RecommendedRetailPrice AS CHAR), '.', ',') as price, Photo, Video, CustomFields, TypicalWeightPerUnit, MarketingComments, ColorID, Size FROM stockitems WHERE StockItemID = ID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_product_information_bestel`(
ID INT
 )
BEGIN
SELECT StockItemID, StockItemName, RecommendedRetailPrice FROM stockitems WHERE StockItemID = ID  ;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_product_information_order`(
quantity INT,
ID INT
 )
BEGIN
SELECT StockItemID, StockItemName, quantity, UnitPrice FROM stockitems WHERE StockItemID = ID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_product_sizes`(
param_StockName VARCHAR(200)
)
BEGIN
SELECT DISTINCT Size, StockItemID
FROM stockitems 
where size != '' 
AND StockItemName LIKE 
CASE
	WHEN param_StockName LIKE "%(%" THEN CONCAT('%',REVERSE(SUBSTRING(REVERSE(param_StockName), INSTR(REVERSE(param_StockName), ')'))),'%')
        ELSE
        param_StockName
END
ORDER by IF(length(size)<5,StockItemID,StockItemName);
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_product_stock`(
ID INT
 )
BEGIN
SELECT QuantityOnHand FROM stockitemholdings WHERE StockItemID = ID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_products_index`(
)
BEGIN
SELECT StockItemID,  TRIM(TRAILING ' (' FROM 
	CASE
		WHEN StockItemName LIKE "%(%" THEN REVERSE(SUBSTRING(REVERSE(stockitemname), INSTR(REVERSE(stockitemname), '(')))
		ELSE stockitemname
	END) 
as StockItemName, UnitPrice, RecommendedRetailPrice, Photo FROM stockitems 
GROUP BY
CASE
	WHEN StockItemName LIKE "%(%" THEN REVERSE(SUBSTRING(REVERSE(stockitemname), INSTR(REVERSE(stockitemname), '(')))
	ELSE stockitemname
END
order by rand() LIMIT 12;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_slider_index`(
)
BEGIN
SELECT StockItemID, StockItemName, RecommendedRetailPrice, Photo
                FROM stockitems ORDER BY RAND() LIMIT 3;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_stock_group`(
stock_group_id INT
 )
BEGIN
SELECT StockGroupName FROM stockgroups WHERE StockGroupID = stock_group_id;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_stock_groups`()
BEGIN 
SELECT DISTINCT sg.StockGroupID, sg.StockGroupName FROM stockgroups sg
JOIN stockitemstockgroups sitg ON sitg.StockGroupID = sg.StockGroupID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_stockitem_results`(
search VARCHAR(60),
ordersql INT,
off_set INT,
item_per_page INT 
)
BEGIN
SELECT StockItemID, TRIM(TRAILING ' (' FROM 
	CASE
		WHEN StockItemName LIKE "%(%" THEN REVERSE(SUBSTRING(REVERSE(stockitemname), INSTR(REVERSE(stockitemname), '(')))
		ELSE stockitemname
	END) 
as StockItemName, RecommendedRetailPrice, Photo FROM stockitems WHERE MATCH (stockitemname, searchdetails, tags) AGAINST (CONCAT('+',REPLACE(
CASE
	WHEN length(search)>1 THEN search
    ELSE 'a'
END
,' ', '* +'),'*') IN BOOLEAN MODE) OR searchdetails LIKE CONCAT('%',search,'%')
GROUP BY
CASE
	WHEN StockItemName LIKE "%(%" THEN REVERSE(SUBSTRING(REVERSE(stockitemname), INSTR(REVERSE(stockitemname), '(')))
	ELSE stockitemname
END
ORDER BY 
(CASE 
	WHEN ordersql=3 THEN RecommendedRetailPrice
    END)
    ASC,
(CASE 
	WHEN ordersql=1 THEN StockItemName
    END)
    ASC,
(CASE     
	WHEN ordersql=4 THEN RecommendedRetailPrice
    END)
    DESC,
(CASE 
	WHEN ordersql=2 THEN StockItemName
    END)
    DESC
 
 LIMIT off_set, item_per_page;
     
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `get_stockitem_results_category`(
search VARCHAR(60),
category INT,
ordersql INT,
off_set INT,
item_per_page INT 
)
BEGIN 
SELECT si.StockItemID, TRIM(TRAILING ' (' FROM 
	CASE
		WHEN StockItemName LIKE "%(%" THEN REVERSE(SUBSTRING(REVERSE(stockitemname), INSTR(REVERSE(stockitemname), '(')))
		ELSE stockitemname
	END) 
as StockItemName, RecommendedRetailPrice, Photo FROM stockitemstockgroups sisg 
JOIN stockitems si ON si.StockItemID = sisg.StockItemID 
JOIN stockgroups sg ON sg.StockGroupID = sisg.StockGroupID 
WHERE si.SearchDetails LIKE concat('%',search, '%') AND sisg.StockGroupID = category
GROUP BY
CASE
	WHEN StockItemName LIKE "%(%" THEN REVERSE(SUBSTRING(REVERSE(stockitemname), INSTR(REVERSE(stockitemname), '(')))
	ELSE stockitemname
END
ORDER BY 
(CASE 
	WHEN ordersql=3 THEN RecommendedRetailPrice
    END)
    ASC,
(CASE 
	WHEN ordersql=1 THEN StockItemName
    END)
    ASC,
(CASE     
	WHEN ordersql=4 THEN RecommendedRetailPrice
    END)
    DESC,
(CASE 
	WHEN ordersql=2 THEN StockItemName
    END)
    DESC
 
LIMIT off_set,item_per_page;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `getAssociatedOrders`(
userId INT
 )
BEGIN
	SELECT OrderID FROM orders WHERE ContactPersonID = userId;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `getCountrys`(

 )
BEGIN
	SELECT CountryName FROM countries;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `getUser`(
userId INTEGER
 )
BEGIN
	SELECT PersonID, FullName, PhoneNumber, EmailAddress FROM people WHERE PersonID = userId;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `getUserAddress`(
userId INTEGER
 )
BEGIN
	SELECT CU.DeliveryAddressLine2, CU.DeliveryPostalCode , C.CityName, SP.StateProvinceName, CON.CountryName FROM customers CU
    JOIN cities C ON C.CityID = CU.DeliveryCityID
    JOIN stateprovinces SP ON C.StateProvinceID = SP.StateProvinceID
    JOIN countries CON ON CON.CountryID = SP.CountryID
    JOIN people PE ON PE.PersonID = CU.PrimaryContactPersonID
    WHERE PersonID = userId;
END$$
DELIMITER ;

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



DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `insert_order_lines`(
orderId INT,
itemID INT,
quantity INT

)
BEGIN
SET @unitprice = getunitPrice(itemID);
SET @DescriptionValue = getDescription(itemID);
SET @quantityOnHandAfter = getQuantity(itemID) - quantity;


INSERT INTO orderlines (OrderID, StockItemID, Description,  Quantity, UnitPrice)  VALUES (orderId, itemID, @DescriptionValue , quantity, @unitprice) ;

UPDATE stockitemholdings SET QuantityOnHand = @quantityOnHandAfter WHERE StockItemID = itemID;


END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `insert_orderNr`(
IN customer_id INT,
IN usernr INT

)
BEGIN

DECLARE currentdate DATETIME DEFAULT CURRENT_TIMESTAMP;
INSERT INTO orders (OrderID, CustomerID, ContactPersonID, OrderDate) SELECT (max(OrderID)+1), customer_id, usernr, currentdate from orders;

SELECT max(OrderID) as OrderID FROM orders;


END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `login_validation`( email_user VARCHAR(50) )
BEGIN
	SELECT PersonID, LogonName, HashedPassword FROM people WHERE LogonName = email_user ;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`***REMOVED***_root`@`%` PROCEDURE `order_history`(
order_id INT,
Usernr INT
 )
BEGIN
	SELECT O.ContactPersonID, OL.OrderID, OL.Quantity, SI.StockItemName, SI.RecommendedRetailPrice, SI.Photo FROM orders O
	LEFT JOIN orderlines OL ON O.OrderID = OL.OrderID 
	RIGHT JOIN stockitems SI ON SI.StockItemID = OL.StockItemID 
	WHERE OL.OrderID = order_id AND O.ContactPersonID = Usernr;
END$$
DELIMITER ;

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
