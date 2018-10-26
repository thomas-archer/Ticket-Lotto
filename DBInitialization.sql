CREATE TABLE Sellers(
	SellerID VARCHAR(5) PRIMARY KEY,
	SellerName VARCHAR(25),
	Email VARCHAR(25) UNIQUE,
    	Hpassword VARCHAR(25),
	Phone VARCHAR(10));
		
CREATE TABLE SellerEvents(
	EventID VARCHAR(5) PRIMARY KEY,
        SellerID VARCHAR(5),
	EventDate DATE,
    	Price  DECIMAL(10,2),
    	NumTickets INT,
	City VARCHAR(25),
	Street VARCHAR(25),
	Zip VARCHAR(5),
    	State VARCHAR(2),
    	EventDesc MEDIUMTEXT,
    	URL VARCHAR(2083),
	FOREIGN KEY(SellerID) REFERENCES Sellers(SellerID));
    
CREATE TABLE Buyers(
	BuyerID VARCHAR(5) PRIMARY KEY,
	BuyerName VARCHAR(25),
	Email VARCHAR(25) UNIQUE,
    	Hpassword VARCHAR(25),
    	City VARCHAR(25),
	Street VARCHAR(25),
	Zip VARCHAR(5),
    	State VARCHAR(2),
	Phone VARCHAR(10));
    
CREATE TABLE TicketRequests(
    	BuyerID VARCHAR(5),
    	EventID VARCHAR(5),
    	TicketStatus VARCHAR(10),
    	FOREIGN KEY(BuyerID) REFERENCES Buyers(BuyerID),
    	FOREIGN KEY(EventID) REFERENCES SellerEvents(EventID),
    	PRIMARY KEY (BuyerID, EventID));
