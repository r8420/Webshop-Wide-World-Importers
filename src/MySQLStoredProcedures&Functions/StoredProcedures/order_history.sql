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