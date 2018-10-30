CREATE TABLE SellerEvents(
	EventID VARCHAR(5) PRIMARY KEY,
	EventDate DATE,
	TicketDistDate DATE
    	Price  DECIMAL(10,2),
    	NumTickets INT,
	City VARCHAR(25),
	Street VARCHAR(25),
	Zip VARCHAR(5),
    	State VARCHAR(2),
    	EventDesc MEDIUMTEXT,
    	URL VARCHAR(2083),
    	SellerName VARCHAR(25),
    	SellerEmail VARCHAR(25));
    
	
CREATE TABLE TicketRequests(
    	EventID VARCHAR(5),
    	TicketStatus VARCHAR(10),
    	BuyerName VARCHAR(25),
	BuyerEmail VARCHAR(25) 
    	FOREIGN KEY(EventID) REFERENCES SellerEvents(EventID),
	PRIMARY KEY(EventID, BuyerEmail));
    
