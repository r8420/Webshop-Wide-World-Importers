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