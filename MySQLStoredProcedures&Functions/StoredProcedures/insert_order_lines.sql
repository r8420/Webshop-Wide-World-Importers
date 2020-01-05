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