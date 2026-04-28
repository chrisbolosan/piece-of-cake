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
('James Cameron', 'mike@gmail.com', '6304321234'),
('Sarah Connor', 'sarah@gmail.com', '6301112222'),
('Tony Stark', 'tony@gmail.com', '6303334444');

-- CAKES
INSERT INTO CAKE (Flavor, Size, BasePrice, Frosting, NumInStock, Img, AdminID) VALUES

-- CHOCOLATEE
('Chocolate', '6-inch', 24.99, 'Chocolate Buttercream', 10, 'images/ChocCake.jpg', 1),
('Chocolate', '8-inch', 29.99, 'Chocolate Buttercream', 8, 'images/ChocCake.jpg', 1),
('Chocolate', '10-inch', 34.99, 'Chocolate Buttercream', 6, 'images/ChocCake.jpg', 1),
('Chocolate', '12-inch', 39.99, 'Chocolate Buttercream', 5, 'images/ChocCake.jpg', 1),

-- VANILLA
('Vanilla', '6-inch', 23.99, 'Vanilla Buttercream', 9, 'images/VanillaCake.jpg', 1),
('Vanilla', '8-inch', 29.99, 'Vanilla Buttercream', 8, 'images/VanillaCake.jpg', 1),
('Vanilla', '10-inch', 33.99, 'Vanilla Buttercream', 6, 'images/VanillaCake.jpg', 1),
('Vanilla', '12-inch', 38.99, 'Vanilla Buttercream', 5, 'images/VanillaCake.jpg', 1),

-- RED VELVET
('Red Velvet', '6-inch', 27.99, 'Cream Cheese', 7, 'images/RedVelvet.jpg', 2),
('Red Velvet', '8-inch', 31.99, 'Cream Cheese', 6, 'images/RedVelvet.jpg', 2),
('Red Velvet', '10-inch', 36.99, 'Cream Cheese', 5, 'images/RedVelvet.jpg', 2),
('Red Velvet', '12-inch', 41.99, 'Cream Cheese', 4, 'images/RedVelvet.jpg', 2),

-- STRAWBERRY
('Strawberry', '6-inch', 26.99, 'Whipped Cream', 8, 'images/StrawbCake.jpg', 2),
('Strawberry', '8-inch', 30.99, 'Whipped Cream', 7, 'images/StrawbCake.jpg', 2),
('Strawberry', '10-inch', 34.99, 'Whipped Cream', 6, 'images/StrawbCake.jpg', 2),
('Strawberry', '12-inch', 39.99, 'Whipped Cream', 5, 'images/StrawbCake.jpg', 2),
-- CARROT
('Carrot', '6-inch', 25.99, 'Cream Cheese', 7, 'images/CarrotCake.jpg', 1),
('Carrot', '8-inch', 31.99, 'Cream Cheese', 6, 'images/CarrotCake.jpg', 1),
('Carrot', '10-inch', 35.99, 'Cream Cheese', 5, 'images/CarrotCake.jpg', 1),
('Carrot', '12-inch', 40.99, 'Cream Cheese', 4, 'images/CarrotCake.jpg', 1);
-- DESTINATION
INSERT INTO DESTINATION (StreetAddress, AptNumber, ZIP, City, State) VALUES
('123 Main St', NULL, '60543', 'Oswego', 'IL'),
('456 Decatur St', 'Apt 2B', '60540', 'Naperville', 'IL'),
('789 Oak Drive', NULL, '60616', 'Chicago', 'IL');

--PAYMENTS
INSERT INTO PAYMENT (Method, Amount, PaymentStatus, CardholderName, CardLastFour) VALUES
('Card', 54.98, 'Completed', 'Chris Bolosan', '1234'),
('Card', 29.99, 'Completed', 'John Doe', '5678'),
('Card', 62.98, 'Processing', 'James Cameron', '4321'),
('Card', 48.99, 'Completed', 'Sarah Connor', '2222'),
('Card', 59.99, 'Completed', 'Tony Stark', '4444'),
('Card', 72.99, 'Completed', 'Chris Bolosan', '1234'),
('Card', 18.99, 'Completed', 'John Doe', '5678'),
('Card', 120.50, 'Completed', 'Tony Stark', '4444'),
('Card', 45.00, 'Completed', 'Sarah Connor', '2222'),
('Card', 89.99, 'Completed', 'James Cameron', '4321'),
('Card', 15.99, 'Completed', 'John Doe', '5678'),
('Card', 200.00, 'Completed', 'Tony Stark', '4444');

-- ORDERS
INSERT INTO ORDERS 
(CustomerID, PaymentID, AddressID, AdminID, TimeDatePlaced, TimeDateDelivery, OrderStatus, TrackingNumber, FulfillmentType, Notes)
VALUES
(1,1,1,1,'2025-11-05 10:00:00','2025-11-06 14:00:00','Delivered','TRK10001','Delivery','birthday celebration'),
(2,2,2,1,'2025-11-12 12:30:00','2025-11-13 15:00:00','Delivered','TRK10002','Delivery','office party'),
(3,3,3,2,'2025-11-20 09:15:00','2025-11-21 13:00:00','Delivered','TRK10003','Delivery','family gathering'),

(1,1,1,1,'2025-12-02 11:00:00','2025-12-03 16:00:00','Delivered','TRK10004','Delivery','oliday dessert'),
(2,2,2,1,'2025-12-10 14:45:00','2025-12-11 17:00:00','Delivered','TRK10005','Delivery','work event'),
(3,3,3,2,'2025-12-18 10:20:00','2025-12-19 12:00:00','Delivered','TRK10006','Delivery','xmas party'),

(1,1,1,1,'2026-01-05 09:30:00','2026-01-06 14:00:00','Delivered','TRK10007','Delivery','new Year party'),
(2,2,2,1,'2026-01-11 13:00:00','2026-01-12 15:00:00','Delivered','TRK10008','Delivery','birthday order'),
(3,3,3,2,'2026-01-22 15:10:00','2026-01-23 18:00:00','Delivered','TRK10009','Delivery','celebration'),

(1,1,1,1,'2026-02-03 10:00:00','2026-02-04 13:00:00','Delivered','TRK10010','Delivery','small gathering'),
(2,2,2,1,'2026-02-14 12:00:00','2026-02-15 16:00:00','Delivered','TRK10011','Delivery','valentines special'),
(3,3,3,2,'2026-02-25 11:30:00','2026-02-26 14:00:00','Delivered','TRK10012','Delivery','anniversary'),

(1,1,1,1,'2026-03-02 09:45:00','2026-03-03 13:00:00','Delivered','TRK10013','Delivery','office treat'),
(2,2,2,1,'2026-03-10 14:10:00','2026-03-11 17:00:00','Delivered','TRK10014','Delivery','birthday cake'),
(3,3,3,2,'2026-03-18 10:50:00','2026-03-19 12:30:00','Delivered','TRK10015','Delivery','event order'),

(1,1,1,1,'2026-04-01 11:00:00','2026-04-02 15:00:00','Delivered','TRK10016','Delivery','spring event'),
(2,2,2,1,'2026-04-08 13:30:00','2026-04-09 16:00:00','Delivered','TRK10017','Delivery','family party'),
(3,3,3,2,'2026-04-15 09:20:00','2026-05-16 14:00:00','Processing','','Delivery','upcoming event'),

(1,1,1,1,'2026-04-18 10:15:00','2026-04-30 13:00:00','Processing','TRK10019','Delivery','rush order'),
(2,2,2,1,'2026-04-19 12:40:00','2026-05-20 15:00:00','Processing','TRK10020','Delivery','Weekend order'),
(3,3,3,2,'2026-04-20 14:00:00',NULL,'Delivered','TRK1021','Pickup','Will be there around 3pm'),

(1,1,1,1,'2026-04-21 16:20:00','2026-04-29 18:00:00','Processing','TRK10022','Delivery','last minute order'),
(4,4,1,1,'2026-04-10 12:00:00','2026-04-11 15:00:00','Delivered','TRK10023','Delivery','first order'),
(5,5,2,2,'2026-04-11 14:00:00','2026-04-12 16:00:00','Delivered','TRK10024','Delivery','first order'),
(1,6,1,1,'2026-04-22 10:00:00','2026-04-23 14:00:00','Delivered','TRK20001','Delivery','repeat customer'),
(2,7,2,1,'2026-04-22 12:30:00','2026-04-23 16:00:00','Shipped','TRK20002','Delivery','gift'),
(3,8,3,2,'2026-04-23 09:15:00',NULL,'Processing','','Delivery','big event'),

(4,9,1,1,'2026-04-24 11:00:00','2026-04-25 15:00:00','Delivered','TRK20004','Delivery','family order'),
(5,10,2,2,'2026-04-25 14:45:00',NULL,'Processing','','Pickup','pickup soon'),

(1,11,1,1,'2026-04-26 09:30:00','2026-04-27 13:00:00','Delivered','TRK20006','Delivery','BULK'),
(2,12,2,1,'2026-04-26 13:00:00',NULL,'Processing','','Delivery','RUSH'),
(3,13,3,2,'2026-04-27 15:10:00','2026-04-28 18:00:00','Shipped','TRK20008','Delivery','priority'),

(5,14,2,2,'2026-04-27 16:00:00','2026-04-28 19:00:00','Delivered','TRK20009','Delivery','VIP add extra utensils!');

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
(24,3,1,NULL,NULL),
(25,1,1,NULL,NULL),
(26,2,1,NULL,NULL),
(27,1,2,NULL,NULL),
(28,5,1,NULL,NULL),
(29,10,3,NULL,NULL),
(30,8,1,NULL,NULL),
(31,12,2,NULL,NULL),
(32,15,4,NULL,NULL),
(33,3,1,NULL,NULL),
(34,6,2,NULL,NULL),
(35,18,3,NULL,NULL);

SET FOREIGN_KEY_CHECKS = 1;
