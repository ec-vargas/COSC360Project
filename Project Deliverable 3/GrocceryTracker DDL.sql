-- Table: Users
CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    UserType VARCHAR(50),
    Username VARCHAR(50) UNIQUE NOT NULL,
    Password VARCHAR(100) NOT NULL,
    Email VARCHAR(100) UNIQUE NOT NULL,
    RegistrationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ProfilePicture VARCHAR(255) -- Path to the user's profile picture
);

-- Table: Categories
CREATE TABLE Categories (
    CategoryID INT AUTO_INCREMENT PRIMARY KEY,
    CategoryName VARCHAR(50) UNIQUE NOT NULL
);

-- Table: Products
CREATE TABLE Products (
    ProductID INT AUTO_INCREMENT PRIMARY KEY,
    ProductName VARCHAR(100) NOT NULL,
    CategoryID INT,
    Photo VARCHAR(255), -- Path to the product's photo
    FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID)
);

-- Table: Stores
CREATE TABLE Stores (
    StoreID INT AUTO_INCREMENT PRIMARY KEY,
    StoreName VARCHAR(100) NOT NULL,
    Location VARCHAR(255),
    StorePhoto VARCHAR(255) -- Path to the store's photo
);

-- Table: ProductStores
CREATE TABLE ProductStores (
    ProductID INT,
    StoreID INT,
    PRIMARY KEY (ProductID, StoreID),
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID),
    FOREIGN KEY (StoreID) REFERENCES Stores(StoreID)
);

-- Table: Prices
CREATE TABLE Prices (
    PriceID INT AUTO_INCREMENT PRIMARY KEY,
    ProductID INT,
    StoreID INT,
    Price DECIMAL(10, 2) NOT NULL,
    PriceDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID),
    FOREIGN KEY (StoreID) REFERENCES Stores(StoreID)
);

-- Table: Comments
CREATE TABLE Comments (
    CommentID INT AUTO_INCREMENT PRIMARY KEY,
    ProductID INT,
    UserID INT,
    Comment TEXT NOT NULL,
    CommentDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

INSERT INTO Categories (CategoryName) VALUES
('Fruits'),
('Vegetables'),
('Dairy'),
('Meat'),
('Bakery'),
('Canned Goods'),
('Frozen Foods'),
('Beverages'),
('Snacks'),
('Condiments'),
('Household'),
('Personal Care');

-- Tomatoes
INSERT INTO Products (ProductName, CategoryID) VALUES ('Tomatoes', 2);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Tomatoes', 2);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Tomatoes', 2);

-- Bananas
INSERT INTO Products (ProductName, CategoryID) VALUES ('Bananas', 1);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Bananas', 1);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Bananas', 1);

-- Cheddar Cheese
INSERT INTO Products (ProductName, CategoryID) VALUES ('Cheddar Cheese', 3);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Cheddar Cheese', 3);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Cheddar Cheese', 3);

-- Ribeye
INSERT INTO Products (ProductName, CategoryID) VALUES ('Ribeye', 4);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Ribeye', 4);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Ribeye', 4);

-- Cookies
INSERT INTO Products (ProductName, CategoryID) VALUES ('Cookies', 5);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Cookies', 5);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Cookies', 5);

-- Dino Nuggets
INSERT INTO Products (ProductName, CategoryID) VALUES ('Dino Nuggets', 7);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Dino Nuggets', 7);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Dino Nuggets', 7);

-- Orange Juice
INSERT INTO Products (ProductName, CategoryID) VALUES ('Orange Juice', 8);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Orange Juice', 8);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Orange Juice', 8);

-- Potato Chips
INSERT INTO Products (ProductName, CategoryID) VALUES ('Potato Chips', 9);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Potato Chips', 9);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Potato Chips', 9);

-- Ketchup
INSERT INTO Products (ProductName, CategoryID) VALUES ('Ketchup', 10);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Ketchup', 10);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Ketchup', 10);

-- Chickpeas
INSERT INTO Products (ProductName, CategoryID) VALUES ('Chickpeas', 6);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Chickpeas', 6);
INSERT INTO Products (ProductName, CategoryID) VALUES ('Chickpeas', 6);

UPDATE Products SET Photo = 'img/1.jpg' WHERE ProductID = 1;
UPDATE Products SET Photo = 'img/2.jpg' WHERE ProductID = 2;
UPDATE Products SET Photo = 'img/3.jpg' WHERE ProductID = 3;
UPDATE Products SET Photo = 'img/4.jpg' WHERE ProductID = 4;
UPDATE Products SET Photo = 'img/5.jpg' WHERE ProductID = 5;
UPDATE Products SET Photo = 'img/6.jpg' WHERE ProductID = 6;
UPDATE Products SET Photo = 'img/7.jpg' WHERE ProductID = 7;
UPDATE Products SET Photo = 'img/8.jpg' WHERE ProductID = 8;
UPDATE Products SET Photo = 'img/9.jpg' WHERE ProductID = 9;
UPDATE Products SET Photo = 'img/10.jpg' WHERE ProductID = 10;
UPDATE Products SET Photo = 'img/11.jpg' WHERE ProductID = 11;
UPDATE Products SET Photo = 'img/12.jpg' WHERE ProductID = 12;
UPDATE Products SET Photo = 'img/13.jpg' WHERE ProductID = 13;
UPDATE Products SET Photo = 'img/14.jpg' WHERE ProductID = 14;
UPDATE Products SET Photo = 'img/15.jpg' WHERE ProductID = 15;
UPDATE Products SET Photo = 'img/16.jpg' WHERE ProductID = 16;
UPDATE Products SET Photo = 'img/17.jpg' WHERE ProductID = 17;
UPDATE Products SET Photo = 'img/18.jpg' WHERE ProductID = 18;
UPDATE Products SET Photo = 'img/19.jpg' WHERE ProductID = 19;
UPDATE Products SET Photo = 'img/20.jpg' WHERE ProductID = 20;
UPDATE Products SET Photo = 'img/21.jpg' WHERE ProductID = 21;
UPDATE Products SET Photo = 'img/22.jpg' WHERE ProductID = 22;
UPDATE Products SET Photo = 'img/23.jpg' WHERE ProductID = 23;
UPDATE Products SET Photo = 'img/24.jpg' WHERE ProductID = 24;
UPDATE Products SET Photo = 'img/25.jpg' WHERE ProductID = 25;
UPDATE Products SET Photo = 'img/26.jpg' WHERE ProductID = 26;
UPDATE Products SET Photo = 'img/27.jpg' WHERE ProductID = 27;
UPDATE Products SET Photo = 'img/28.jpg' WHERE ProductID = 28;
UPDATE Products SET Photo = 'img/29.jpg' WHERE ProductID = 29;
UPDATE Products SET Photo = 'img/30.jpg' WHERE ProductID = 30;

-- Grocery Store 1
INSERT INTO Stores (StoreName, Location) VALUES ('Fresh Mart', '123 Main Street, Kelowna');

-- Grocery Store 2
INSERT INTO Stores (StoreName, Location) VALUES ('Green Basket', '456 Elm Avenue, Vernon');

-- Grocery Store 3
INSERT INTO Stores (StoreName, Location) VALUES ('Nature''s Harvest', '789 Oak Road, Richmond');


INSERT INTO ProductStores (ProductID, StoreID) VALUES (1, 1); -- Tomatoes sold at StoreID 1 (Store A)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (2, 2); -- Tomatoes sold at StoreID 2 (Store B)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (3, 3); -- Tomatoes sold at StoreID 3 (Store C)


INSERT INTO ProductStores (ProductID, StoreID) VALUES (4, 1); -- Bananas sold at StoreID 1 (Store A)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (5, 2); -- Bananas sold at StoreID 2 (Store B)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (6, 3); -- Bananas sold at StoreID 3 (Store C)

INSERT INTO ProductStores (ProductID, StoreID) VALUES (7, 1); -- Cheddar Cheese sold at StoreID 1 (Store A)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (8, 2); -- Cheddar Cheese sold at StoreID 2 (Store B)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (9, 3); -- Cheddar Cheese sold at StoreID 3 (Store C)

INSERT INTO ProductStores (ProductID, StoreID) VALUES (10, 1); -- Ribeye sold at StoreID 1 (Store A)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (11, 2); -- Ribeye sold at StoreID 2 (Store B)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (12, 3); -- Ribeye sold at StoreID 3 (Store C)

INSERT INTO ProductStores (ProductID, StoreID) VALUES (13, 1); -- Cookies sold at StoreID 1 (Store A)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (14, 2); -- Cookies sold at StoreID 2 (Store B)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (15, 3); -- Cookies sold at StoreID 3 (Store C)

INSERT INTO ProductStores (ProductID, StoreID) VALUES (16, 1); -- Dino Nuggets sold at StoreID 1 (Store A)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (17, 2); -- Dino Nuggets sold at StoreID 2 (Store B)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (18, 3); -- Dino Nuggets sold at StoreID 3 (Store C)

INSERT INTO ProductStores (ProductID, StoreID) VALUES (19, 1); -- Orange Juice sold at StoreID 1 (Store A)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (20, 2); -- Orange Juice sold at StoreID 2 (Store B)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (21, 3); -- Orange Juice sold at StoreID 3 (Store C)

INSERT INTO ProductStores (ProductID, StoreID) VALUES (22, 1); -- Potato Chips sold at StoreID 1 (Store A)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (23, 2); -- Potato Chips sold at StoreID 2 (Store B)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (24, 3); -- Potato Chips sold at StoreID 3 (Store C)

INSERT INTO ProductStores (ProductID, StoreID) VALUES (25, 1); -- Ketchup sold at StoreID 1 (Store A)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (26, 2); -- Ketchup sold at StoreID 2 (Store B)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (27, 3); -- Ketchup sold at StoreID 3 (Store C)

INSERT INTO ProductStores (ProductID, StoreID) VALUES (28, 1); -- Chickpeas sold at StoreID 1 (Store A)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (29, 2); -- Chickpeas sold at StoreID 2 (Store B)
INSERT INTO ProductStores (ProductID, StoreID) VALUES (30, 3); -- Chickpeas sold at StoreID 3 (Store C)

UPDATE Stores SET StorePhoto = 'img/31.jpg' WHERE StoreID = 1;
UPDATE Stores SET StorePhoto = 'img/32.jpg' WHERE StoreID = 2;
UPDATE Stores SET StorePhoto = 'img/33.jpg' WHERE StoreID = 3;

SET @startDate = CURDATE() - INTERVAL 3 MONTH;
SET @endDate = CURDATE();
SET @numProducts = (SELECT COUNT(*) FROM Products);
SET @numStores = (SELECT COUNT(*) FROM Stores);

SET @startDate = '2024-01-01';
SET @endDate = '2024-03-24';

SET @numProducts = (SELECT COUNT(*) FROM Products);
SET @numStores = (SELECT COUNT(*) FROM Stores);

INSERT INTO Prices (ProductID, StoreID, Price, PriceDate)
SELECT
    p.ProductID,
    s.StoreID,
    ROUND(RAND() * (20 - 5) + 5, 2) AS Price,
    DATE_ADD(@startDate, INTERVAL seq.seq DAY) AS PriceDate
FROM
    Products p
CROSS JOIN
    Stores s
JOIN
    (SELECT (t2.a + t1.a * 10 + t0.a * 100) AS seq
     FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS t0,
          (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS t1,
          (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS t2
    ) AS seq
WHERE
    DATE_ADD(@startDate, INTERVAL seq.seq DAY) BETWEEN @startDate AND @endDate;
