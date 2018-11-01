CREATE TABLE SellerEvents(
	EventID VARCHAR(5) PRIMARY KEY,
	EventName VARCHAR(25),
	EventDate DATE,
	TicketDistDate DATE,
	Price  DECIMAL(10,2),
	NumTickets INT,
	-- City VARCHAR(25), Exclude address for now?
	-- Street VARCHAR(25),
	-- Zip VARCHAR(5),
	-- 	State VARCHAR(2),
	EventDesc MEDIUMTEXT,
	SellerEmail VARCHAR(25),
	EventURL VARCHAR(2083));
    
	
CREATE TABLE TicketRequests(
    EventID VARCHAR(5),
    TicketStatus VARCHAR(10),
    BuyerName VARCHAR(25),
	BuyerEmail VARCHAR(25) 
    FOREIGN KEY(EventID) REFERENCES SellerEvents(EventID),
	PRIMARY KEY(EventID, BuyerEmail));
    
