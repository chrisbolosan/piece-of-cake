USE z1405381;
-- Run this ONCE to initialize database
-- DO NOT run again unless resetting database

DROP TABLE IF EXISTS ORDER_ITEM;
DROP TABLE IF EXISTS ORDERS;
DROP TABLE IF EXISTS CAKE;
DROP TABLE IF EXISTS PAYMENT;
DROP TABLE IF EXISTS DESTINATION;
DROP TABLE IF EXISTS ADMINISTRATOR;
DROP TABLE IF EXISTS CUSTOMER;

CREATE TABLE CUSTOMER (
    CustomerID  INT             AUTO_INCREMENT PRIMARY KEY,
    Name        VARCHAR(100)    NOT NULL,
    Email       VARCHAR(150)    NOT NULL UNIQUE,
    PhoneNum    VARCHAR(20)     NOT NULL
);

CREATE TABLE ADMINISTRATOR (
    AdminID     INT AUTO_INCREMENT PRIMARY KEY,
    Name        VARCHAR(100)    NOT NULL
);

CREATE TABLE CAKE (
    CakeID        INT             AUTO_INCREMENT PRIMARY KEY,
    Flavor        VARCHAR(100)    NOT NULL,
    Size          VARCHAR(50)     NOT NULL,
    BasePrice     DECIMAL(8, 2)   NOT NULL,
    Frosting      VARCHAR(100)    NOT NULL,
    NumInStock    INT             NOT NULL DEFAULT 0,
    Img           VARCHAR(255)    NOT NULL DEFAULT 'comingsoon.png',
    AdminID       INT,
    FOREIGN KEY (AdminID) REFERENCES ADMINISTRATOR(AdminID)
);

CREATE TABLE PAYMENT (
    PaymentID       INT             AUTO_INCREMENT PRIMARY KEY,
    Method          VARCHAR(50)     NOT NULL,
    Amount          DECIMAL(10, 2)  NOT NULL,
    PaymentStatus   VARCHAR(50)     NOT NULL DEFAULT 'Processing',
    CardholderName  VARCHAR(150)    NOT NULL,
    CardLastFour    CHAR(4)         NOT NULL
);

CREATE TABLE DESTINATION (
    AddressID       INT             AUTO_INCREMENT PRIMARY KEY,
    StreetAddress   VARCHAR(255)    NOT NULL,
    AptNumber       VARCHAR(50),
    ZIP             VARCHAR(10)     NOT NULL,
    City            VARCHAR(100)    NOT NULL,
    State           VARCHAR(50)     NOT NULL
);

CREATE TABLE ORDERS (
    OrderID             INT             AUTO_INCREMENT PRIMARY KEY,
    CustomerID          INT             NOT NULL,
    PaymentID           INT             NOT NULL,
    AddressID           INT             NOT NULL,
    AdminID             INT,
    TimeDatePlaced      DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    TimeDateDelivery    DATETIME,
    OrderStatus         VARCHAR(50)     NOT NULL DEFAULT 'Processing',
    TrackingNumber      VARCHAR(50),
    FulfillmentType     VARCHAR(25)	NOT NULL DEFAULT 'Delivery',
    Notes               TEXT,
    FOREIGN KEY (CustomerID) REFERENCES CUSTOMER(CustomerID),
    FOREIGN KEY (PaymentID)  REFERENCES PAYMENT(PaymentID),
    FOREIGN KEY (AddressID)  REFERENCES DESTINATION(AddressID),
    FOREIGN KEY (AdminID)    REFERENCES ADMINISTRATOR(AdminID)
);

CREATE TABLE ORDER_ITEM (
    OrderID     INT     NOT NULL,
    CakeID      INT     NOT NULL,
    Quantity    INT     NOT NULL DEFAULT 1,
    UserImg     VARCHAR(255),
    UserMessage TEXT,
    PRIMARY KEY (OrderID, CakeID),
    FOREIGN KEY (OrderID) REFERENCES ORDERS(OrderID),
    FOREIGN KEY (CakeID)  REFERENCES CAKE(CakeID)
);
