CREATE TABLE SellerEvents(
	EventID INT NOT NULL AUTO_INCREMENT,
	EventName VARCHAR(25),
	EventDate DATE,
	EventOrganization VARCHAR(30), 
	TicketDistDate DATE,
	Price DECIMAL(10,2),
	NumTickets INT,
	EventDesc VARCHAR(100),
	SellerEmail VARCHAR(25),
	EventURL VARCHAR(2083),
	PRIMARY KEY(EventID)
	);
	
CREATE TABLE TicketRequests(
    EventID INT,
    TicketStatus VARCHAR(10),
    BuyerName VARCHAR(25),
	BuyerEmail VARCHAR(25), 
    FOREIGN KEY(EventID) REFERENCES SellerEvents(EventID),
	PRIMARY KEY(EventID, BuyerEmail));
    
