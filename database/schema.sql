USE z1405381;
-- Run this ONCE to initialize database
-- DO NOT run again unless resetting database

-- DO NOT DELETE TOUCH THIS. STILL USING FOR ASSIGNMENT GRADING
DROP TABLE IF EXISTS SP;
DROP TABLE IF EXISTS S;
DROP TABLE IF EXISTS P;

--supplier
CREATE TABLE S (
	S CHAR(5) PRIMARY KEY,
	SNAME VARCHAR(20) NOT NULL,
	STATUS INT NOT NULL,
	CITY VARCHAR(20) NOT NULL
);

--parts
CREATE TABLE P (
	P CHAR(10) PRIMARY KEY,
	PNAME VARCHAR(25) NOT NULL,
	COLOR VARCHAR(25) NOT NULL,
	WEIGHT INT NOT NULL
);		

--supplier and parts
CREATE TABLE SP (
	S CHAR(5),
	P CHAR(10),
	QTY INT NOT NULL,
	PRIMARY KEY (S, P),
	FOREIGN KEY (S) REFERENCES S(S),
	FOREIGN KEY (P) REFERENCES P(P)	
);

--data for S TABLE
INSERT INTO S VALUES
('S1','Smith',20,'London'),
('S2','Jones',10,'Paris'),
('S3','Blake',30,'Paris'),
('S4','Clark',20,'London'),
('S5','Adams',30,'Athens');

--data for P TABLE
INSERT INTO P VALUES
('P1','Nut','Red',12),
('P2','Bolt','Green',17),
('P3','Screw','Blue',17),
('P4','Screw','Red',14),
('P5','Cam','Blue',12),
('P6','Cog','Red',19);

--data for SP TABLE
INSERT INTO SP VALUES
('S1','P1',300),
('S1','P2',200),
('S1','P3',400),
('S1','P4',200),
('S1','P5',100),
('S1','P6',100),
('S2','P1',300),
('S2','P2',400),
('S3','P2',200),
('S4','P2',200),
('S4','P4',300),
('S4','P5',400);

-- DO NOT TOUCH ABOVE THIS. STILL USING FOR ASSIGNMENT GRADING

--WIP SCHEMA. AWAITING final from team

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
    Phone       VARCHAR(20)     NOT NULL
);

CREATE TABLE ADMINISTRATOR (
    AdminID     INT NULL        AUTO_INCREMENT PRIMARY KEY,
    Name        VARCHAR(100)    NOT NULL
);
CREATE TABLE CAKE (
    CakeID      INT             AUTO_INCREMENT PRIMARY KEY,
    Flavor      VARCHAR(100)    NOT NULL,
    Size        VARCHAR(50)     NOT NULL,
    BasePrice   DECIMAL(8, 2)   NOT NULL,
    Frosting    VARCHAR(100)    NOT NULL,
    num_in_stock INT            NOT NULL DEFAULT 0
);

CREATE TABLE PAYMENT (
    PaymentID       INT             AUTO_INCREMENT PRIMARY KEY,
    Method          VARCHAR(50)     NOT NULL,
    Amount          DECIMAL(10, 2)  NOT NULL,
    PaymentStatus   VARCHAR(50)     NOT NULL DEFAULT 'Pending',
    CardholderName  VARCHAR(150)    NOT NULL,
    CardLastFour    CHAR(4)         NOT NULL,
    BillingZIP      VARCHAR(10)     NOT NULL
);

CREATE TABLE DESTINATION (
    AddressID   INT             AUTO_INCREMENT PRIMARY KEY,
    ZIP         VARCHAR(10)     NOT NULL,
    City        VARCHAR(100)    NOT NULL,
    State       VARCHAR(50)     NOT NULL
);

CREATE TABLE ORDERS (
    OrderID             INT             AUTO_INCREMENT PRIMARY KEY,
    CustomerID          INT             NOT NULL,
    PaymentID           INT             NOT NULL,
    AddressID           INT             NOT NULL,
    AdminID             INT             NOT NULL,
    TimeDatePlaced      DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    TimeDateDelivery    DATETIME,
    OrderStatus         VARCHAR(50)     NOT NULL DEFAULT 'Processing',
    TrackingNumber      VARCHAR(100),
    Notes               TEXT,
    FOREIGN KEY (CustomerID)    REFERENCES CUSTOMER(CustomerID),
    FOREIGN KEY (PaymentID)     REFERENCES PAYMENT(PaymentID),
    FOREIGN KEY (AddressID)     REFERENCES DESTINATION(AddressID),
    FOREIGN KEY (AdminID)       REFERENCES ADMINISTRATOR(AdminID)
);

CREATE TABLE ORDER_ITEM (
    OrderID     INT     NOT NULL,
    CakeID      INT     NOT NULL,
    Quantity    INT     NOT NULL DEFAULT 1,
    PRIMARY KEY (OrderID, CakeID),
    FOREIGN KEY (OrderID)   REFERENCES ORDERS(OrderID),
    FOREIGN KEY (CakeID)    REFERENCES CAKE(CakeID)
);

