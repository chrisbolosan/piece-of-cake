USE z1405381;

-- RESET BEFORE RESEED 
SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE ORDER_ITEM;
TRUNCATE TABLE ORDERS;
TRUNCATE TABLE PAYMENT;
TRUNCATE TABLE DESTINATION;
TRUNCATE TABLE CAKE;
TRUNCATE TABLE CUSTOMER;
TRUNCATE TABLE ADMINISTRATOR;

SET FOREIGN_KEY_CHECKS = 1;

-- ADMIN
INSERT INTO ADMINISTRATOR (Name) VALUES
('Molly Manager'),
('Bob Sagat Supervisor');

-- CUSTOMERS
INSERT INTO CUSTOMER (Name, Email, PhoneNum) VALUES
('Chris Bolosan', 'chris123@gmail.com', '6308675309'),
('John Doe', 'jane@gmail.com', '6305555678'),
('James Cameron', 'mike@gmail.com', '6304321234');

-- CAKES
INSERT INTO CAKE (Flavor, Size, BasePrice, Frosting, NumInStock, Img, AdminID) VALUES
('Chocolate', '6-inch', 24.99, 'Chocolate Buttercream', 10, 'images/germancoconutcake.jpeg', 1),
('Vanilla', '8-inch', 29.99, 'Vanilla Buttercream', 8, 'images/germancoconutcake.jpeg', 1),
('Red Velvet', '6-inch', 27.99, 'Cream Cheese', 5, 'images/germancoconutcake.jpeg', 2),
('Strawberry', '10-inch', 34.99, 'Whipped Cream', 6, 'images/germancoconutcake.jpeg', 2),
('Carrot', '8-inch', 31.99, 'Cream Cheese', 4, 'images/germancoconutcake.jpeg', 1);

-- DESTINATION
INSERT INTO DESTINATION (StreetAddress, AptNumber, ZIP, City, State) VALUES
('123 Main St', NULL, '60543', 'Oswego', 'IL'),
('456 Decatur St', 'Apt 2B', '60540', 'Naperville', 'IL'),
('789 Oak Drive', NULL, '60616', 'Chicago', 'IL');

--PAYMENTS
INSERT INTO PAYMENT (Method, Amount, PaymentStatus, CardholderName, CardLastFour) VALUES
('Card', 54.98, 'Completed', 'Chris Bolosan', '1234'),
('Card', 29.99, 'Completed', 'John Doe', '5678'),
('Card', 62.98, 'Processing', 'James Cameron', '4321');

-- ORDERS
INSERT INTO ORDERS 
(CustomerID, PaymentID, AddressID, AdminID, TimeDateDelivery, OrderStatus, Notes)
VALUES
(1, 1, 1, 1, '2026-04-20 14:00:00', 'Completed', 'Birthday cake'),
(2, 2, 2, 1, '2026-04-21 16:00:00', 'Completed', 'No nuts'),
(3, 3, 3, 2, '2026-04-22 12:00:00', 'Processing', 'Add extra frosting');

-- ORDER ITEMS
INSERT INTO ORDER_ITEM 
(OrderID, CakeID, Quantity, UserImg, UserMessage)
VALUES
(1, 1, 1, '/uploads/caketopperthor.jpg', 'Happy Birthday Monkey!'),
(1, 2, 1, NULL, NULL),
(2, 2, 1, NULL, 'Congrats Jackie!'),
(3, 3, 2, NULL, 'Go Army!');
