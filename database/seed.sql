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
('Chocolate', '6-inch', 24.99, 'Chocolate Buttercream', 10, 'images/ChocCake.jpeg', 1),
('Vanilla', '8-inch', 29.99, 'Vanilla Buttercream', 8, 'images/VanillaCake.jpeg', 1),
('Red Velvet', '6-inch', 27.99, 'Cream Cheese', 5, 'images/RedVelvet.jpeg', 2),
('Strawberry', '10-inch', 34.99, 'Whipped Cream', 6, 'images/StrawbCake.jpeg', 2),
('Carrot', '8-inch', 31.99, 'Cream Cheese', 4, 'images/CarrotCake.jpeg', 1);

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
(CustomerID, PaymentID, AddressID, AdminID, TimeDatePlaced, TimeDateDelivery, OrderStatus, Notes)
VALUES
(1,1,1,1,'2025-11-05 10:00:00','2025-11-06 14:00:00','Completed','birthday celebration'),
(2,2,2,1,'2025-11-12 12:30:00','2025-11-13 15:00:00','Completed','office party'),
(3,3,3,2,'2025-11-20 09:15:00','2025-11-21 13:00:00','Completed','family gathering'),

(1,1,1,1,'2025-12-02 11:00:00','2025-12-03 16:00:00','Completed','oliday dessert'),
(2,2,2,1,'2025-12-10 14:45:00','2025-12-11 17:00:00','Completed','work event'),
(3,3,3,2,'2025-12-18 10:20:00','2025-12-19 12:00:00','Completed','xmas party'),

(1,1,1,1,'2026-01-05 09:30:00','2026-01-06 14:00:00','Completed','new Year party'),
(2,2,2,1,'2026-01-11 13:00:00','2026-01-12 15:00:00','Completed','birthday order'),
(3,3,3,2,'2026-01-22 15:10:00','2026-01-23 18:00:00','Completed','celebration'),

(1,1,1,1,'2026-02-03 10:00:00','2026-02-04 13:00:00','Completed','small gathering'),
(2,2,2,1,'2026-02-14 12:00:00','2026-02-15 16:00:00','Completed','valentines special'),
(3,3,3,2,'2026-02-25 11:30:00','2026-02-26 14:00:00','Completed','anniversary'),

(1,1,1,1,'2026-03-02 09:45:00','2026-03-03 13:00:00','Completed','office treat'),
(2,2,2,1,'2026-03-10 14:10:00','2026-03-11 17:00:00','Completed','birthday cake'),
(3,3,3,2,'2026-03-18 10:50:00','2026-03-19 12:30:00','Completed','event order'),

(1,1,1,1,'2026-04-01 11:00:00','2026-04-02 15:00:00','Completed','spring event'),
(2,2,2,1,'2026-04-08 13:30:00','2026-04-09 16:00:00','Completed','family party'),
(3,3,3,2,'2026-04-15 09:20:00','2026-04-16 14:00:00','Processing','upcoming event'),

(1,1,1,1,'2026-04-18 10:15:00','2026-04-19 13:00:00','Processing','rush order'),
(2,2,2,1,'2026-04-19 12:40:00','2026-04-20 15:00:00','Processing','Weekend order'),
(3,3,3,2,'2026-04-20 14:00:00','2026-04-21 16:00:00','Processing','pickup order'),
(1,1,1,1,'2026-04-21 16:20:00','2026-04-22 18:00:00','Processing','last minute order');
-- ORDER ITEMS
INSERT INTO ORDER_ITEM 
(OrderID, CakeID, Quantity, UserImg, UserMessage)
VALUES
(1,1,1,NULL,NULL),
(1,2,1,NULL,NULL),
(2,2,1,NULL,NULL),
(3,3,2,NULL,NULL),
(4,1,1,NULL,NULL),
(4,4,1,NULL,NULL),
(5,2,2,NULL,NULL),
(6,3,1,NULL,NULL),
(7,4,1,NULL,NULL),
(7,5,1,NULL,NULL),
(8,1,2,NULL,NULL),
(9,2,1,NULL,NULL),
(10,3,1,NULL,NULL),
(10,4,1,NULL,NULL),
(11,5,2,NULL,NULL),
(12,1,1,NULL,NULL),
(13,2,1,NULL,NULL),
(14,3,1,NULL,NULL),
(15,4,2,NULL,NULL),
(16,5,1,NULL,NULL),
(17,1,1,NULL,NULL),
(18,2,1,NULL,NULL),
(19,3,1,NULL,NULL),
(20,4,1,NULL,NULL),
(21,5,1,NULL,NULL),
(22,1,2,NULL,NULL),
(23,2,1,NULL,NULL),
(24,3,1,NULL,NULL);


SET FOREIGN_KEY_CHECKS = 1;
