-- CREATE
CREATE TABLE Carriage_Class(
    Carriage_No INTEGER PRIMARY KEY,
    Class CHAR(40)
);
CREATE TABLE Train_Station(
    City CHAR(20),
    Station CHAR(40),
    Distance INTEGER,
    PRIMARY KEY(City, Station)
);
CREATE TABLE Train_Trip(
    Train_Trip_Number CHAR(20),
    Departure_Date DATE,
    PRIMARY KEY (Train_Trip_Number, Departure_Date)
);
CREATE TABLE Train_Staff(
    ID INTEGER PRIMARY KEY,
    NAME CHAR(20) NOT NULL,
    Password CHAR(40) NOT NULL
);
CREATE TABLE Passenger(
    Government_ID_Type CHAR(40),
    ID_Number CHAR(20),
    First_Name CHAR(20),
    Last_Name CHAR(20),
    PRIMARY KEY(Government_ID_Type, ID_Number)
);
CREATE TABLE WebUser(
    User_ID CHAR(20) PRIMARY KEY,
    PASSWORD CHAR(20) NOT NULL,
    Email_Address CHAR(40) UNIQUE NOT NULL
);
CREATE TABLE Adults_Discount(
    Special_ID_Type CHAR(20) PRIMARY KEY,
    Discount DOUBLE
);
CREATE TABLE Children_Senior_Discount(
    Age INTEGER PRIMARY KEY,
    Discount DOUBLE
);
CREATE TABLE Train_Trips_Departure_Schedule(
    Train_Trip_Number CHAR(20),
    Departure_City CHAR(20),
    Departure_Station CHAR(40),
    Departure_Time TIME,
    Departure_Extra_Day INTEGER,
    PRIMARY KEY(
        Train_Trip_Number,
        Departure_City,
        Departure_Station
    ),
    FOREIGN KEY(Train_Trip_Number) REFERENCES Train_Trip(Train_Trip_Number) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(
        Departure_City,
        Departure_Station
    ) REFERENCES Train_Station(City, Station) ON UPDATE CASCADE
);
CREATE TABLE Train_Trips_Arrival_Schedule(
    Train_Trip_Number CHAR(20),
    Arrival_City CHAR(20),
    Arrival_Station CHAR(40),
    Arrival_Time TIME,
    Arrival_Extra_Day INTEGER,
    PRIMARY KEY(
        Train_Trip_Number,
        Arrival_City,
        Arrival_Station
    ),
    FOREIGN KEY(Train_Trip_Number) REFERENCES Train_Trip(Train_Trip_Number) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(Arrival_City, Arrival_Station) REFERENCES Train_Station(City, Station) ON UPDATE CASCADE
);
CREATE TABLE Adult(
    Government_ID_Type CHAR(40),
    ID_Number CHAR(20),
    First_Name CHAR(20),
    Last_Name CHAR(20),
    Age INTEGER,
    Phone_Number CHAR(20),
    Address CHAR(40),
    Special_ID_Type CHAR(40),
    Special_ID_Number CHAR(20),
    PRIMARY KEY(Government_ID_Type, ID_Number),
    FOREIGN KEY(Special_ID_Type) REFERENCES Adults_Discount(Special_ID_Type) ON DELETE NO ACTION ON UPDATE CASCADE
);
CREATE TABLE Guarded_Child(
    Child_ID_Type CHAR(40),
    Child_ID_Number CHAR(20),
    First_Name CHAR(20),
    Last_Name CHAR(20),
    Child_Age INTEGER,
    Adult_ID_Type CHAR(40),
    Adult_ID_Number CHAR(20),
    PRIMARY KEY(Child_ID_Type, Child_ID_Number),
    FOREIGN KEY(Adult_ID_Type, Adult_ID_Number) REFERENCES Adult(Government_ID_Type, ID_Number) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE Placed_Order(
    Order_Number INTEGER PRIMARY KEY,
    User_ID CHAR(20) NOT NULL,
    Total_Paid DOUBLE,
    Payment_Type CHAR(40),
    FOREIGN KEY(User_ID) REFERENCES WebUser(User_ID) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE One_Ordered_Ticket(
    Ticket_Number INTEGER,
    Government_ID_Type CHAR(40),
    ID_Number CHAR(20),
    Order_Number INTEGER,
    Class CHAR(20),
    Ticket_Price DOUBLE,
    Price_After_Discount DOUBLE,
    PRIMARY KEY(
        Ticket_Number,
        Government_ID_Type,
        ID_Number,
        Order_Number
    ),
    FOREIGN KEY(Government_ID_Type, ID_Number) REFERENCES Passenger(Government_ID_Type, ID_Number) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(Order_Number) REFERENCES Placed_Order(Order_Number) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE Ticket_Schedule(
    Ticket_Number INTEGER PRIMARY KEY,
    Departure_City CHAR(20),
    Departure_Station CHAR(40),
    Arrival_City CHAR(20),
    Arrival_Station CHAR(40),
    FOREIGN KEY(
        Departure_City,
        Departure_Station
    ) REFERENCES Train_Station(City, Station) ON UPDATE CASCADE,
    FOREIGN KEY(Arrival_City, Arrival_Station) REFERENCES Train_Station(City, Station) ON UPDATE CASCADE,
    FOREIGN KEY(Ticket_Number) REFERENCES One_Ordered_Ticket(Ticket_Number) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE Assigned_Seat(
    Ticket_Number INTEGER,
    Carriage_No INTEGER,
    Seat_No INTEGER,
    PRIMARY KEY(
        Ticket_Number,
        Carriage_No,
        Seat_No
    ),
    FOREIGN KEY(Ticket_Number) REFERENCES Ticket_Schedule(Ticket_Number) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(Carriage_No) REFERENCES Carriage_Class(Carriage_No) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE Board_Ticket(
    Ticket_Number INTEGER PRIMARY KEY,
    Train_Trip_Number CHAR(20) NOT NULL,
    Departure_Date DATE,
    FOREIGN KEY(Ticket_Number) REFERENCES Ticket_Schedule(Ticket_Number) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(Train_Trip_Number,Departure_Date) REFERENCES Train_Trip(Train_Trip_Number,Departure_Date) ON DELETE CASCADE ON UPDATE CASCADE
);



-- INSERT
INSERT INTO `Train_Staff`(`ID`, `NAME`, `Password`) VALUES (1000, 'Isha Mehta', '11111111');
INSERT INTO `Train_Staff`(`ID`, `NAME`, `Password`) VALUES (2547, 'Alex Deacon', '22222222');
INSERT INTO `Train_Staff`(`ID`, `NAME`, `Password`) VALUES (3357, 'Angela Machado', '33333333');
INSERT INTO `Train_Staff`(`ID`, `NAME`, `Password`) VALUES (4768, 'Armin Talaie', '44444444');
INSERT INTO `Train_Staff`(`ID`, `NAME`, `Password`) VALUES (5134, 'Jason Nguyen', '55555555');


INSERT INTO `Train_Trip`(`Train_Trip_Number`, `Departure_Date`) VALUES ('V001','2020-04-05');
INSERT INTO `Train_Trip`(`Train_Trip_Number`, `Departure_Date`) VALUES ('V001','2020-04-06');
INSERT INTO `Train_Trip`(`Train_Trip_Number`, `Departure_Date`) VALUES ('V001','2020-04-07');
INSERT INTO `Train_Trip`(`Train_Trip_Number`, `Departure_Date`) VALUES ('V001','2020-04-08');
INSERT INTO `Train_Trip`(`Train_Trip_Number`, `Departure_Date`) VALUES ('V001','2020-04-09');
INSERT INTO `Train_Trip`(`Train_Trip_Number`, `Departure_Date`) VALUES ('T001','2020-04-06');
INSERT INTO `Train_Trip`(`Train_Trip_Number`, `Departure_Date`) VALUES ('T001','2020-04-07');
INSERT INTO `Train_Trip`(`Train_Trip_Number`, `Departure_Date`) VALUES ('T001','2020-04-08');
INSERT INTO `Train_Trip`(`Train_Trip_Number`, `Departure_Date`) VALUES ('T001','2020-04-09');
INSERT INTO `Train_Trip`(`Train_Trip_Number`, `Departure_Date`) VALUES ('T001','2020-04-10');

INSERT INTO `Train_Station`(`City`, `Station`,`Distance`) VALUES ('Vancouver','Pacific Central Station',0);
INSERT INTO `Train_Station`(`City`, `Station`,`Distance`) VALUES ('Calgary','Calgary Train Station',1000);
INSERT INTO `Train_Station`(`City`, `Station`,`Distance`) VALUES ('Edmonton','Edmonton Train Station',1200);
INSERT INTO `Train_Station` (`City`, `Station`, `Distance`) VALUES ('Ottawa', 'Ottawa Central Station', 4800);
INSERT INTO `Train_Station`(`City`, `Station`,`Distance`) VALUES ('Toronto','Toronto Pearson International Airport',4400);
INSERT INTO `Train_Station`(`City`, `Station`,`Distance`) VALUES ('Toronto','Central Union Station',4500);



INSERT INTO `Train_Trips_Departure_Schedule`(`Train_Trip_Number`, `Departure_City`, `Departure_Station`, `Departure_Time`, `Departure_Extra_Day`)
VALUES ('V001','Vancouver','Pacific Central Station','9:00:00',0);

INSERT INTO `Train_Trips_Departure_Schedule`(`Train_Trip_Number`, `Departure_City`, `Departure_Station`, `Departure_Time`, `Departure_Extra_Day`)
VALUES ('V001','Edmonton','Edmonton Train Station','12:10:00',1);

INSERT INTO `Train_Trips_Departure_Schedule`(`Train_Trip_Number`, `Departure_City`, `Departure_Station`, `Departure_Time`, `Departure_Extra_Day`)
VALUES ('V001','Toronto','Toronto Pearson International Airport','09:10:00',3);

INSERT INTO `Train_Trips_Departure_Schedule`(`Train_Trip_Number`, `Departure_City`, `Departure_Station`, `Departure_Time`, `Departure_Extra_Day`)
VALUES ('T001','Toronto','Central Union Station','18:00:00',0);

INSERT INTO `Train_Trips_Departure_Schedule`(`Train_Trip_Number`, `Departure_City`, `Departure_Station`, `Departure_Time`, `Departure_Extra_Day`)
VALUES ('T001','Edmonton','Edmonton Train Station','21:10:00',2);

INSERT INTO `Train_Trips_Departure_Schedule`(`Train_Trip_Number`, `Departure_City`, `Departure_Station`, `Departure_Time`, `Departure_Extra_Day`)
VALUES ('T001','Toronto','Toronto Pearson International Airport','20:10:00',0);

INSERT INTO `Train_Trips_Arrival_Schedule`(`Train_Trip_Number`, `Arrival_City`, `Arrival_Station`, `Arrival_Time`, `Arrival_Extra_Day`)
VALUES ('V001','Edmonton','Edmonton Train Station','12:00:00',1);

INSERT INTO `Train_Trips_Arrival_Schedule`(`Train_Trip_Number`, `Arrival_City`, `Arrival_Station`, `Arrival_Time`, `Arrival_Extra_Day`)
VALUES ('V001','Toronto','Toronto Pearson International Airport','09:00:00',3);

INSERT INTO `Train_Trips_Arrival_Schedule`(`Train_Trip_Number`, `Arrival_City`, `Arrival_Station`, `Arrival_Time`, `Arrival_Extra_Day`)
VALUES ('V001','Toronto','Central Union Station','10:30:00',3);

INSERT INTO `Train_Trips_Arrival_Schedule`(`Train_Trip_Number`, `Arrival_City`, `Arrival_Station`, `Arrival_Time`, `Arrival_Extra_Day`)
VALUES ('T001','Toronto','Toronto Pearson International Airport','20:00:00',0);

INSERT INTO `Train_Trips_Arrival_Schedule`(`Train_Trip_Number`, `Arrival_City`, `Arrival_Station`, `Arrival_Time`, `Arrival_Extra_Day`)
VALUES ('T001','Edmonton','Edmonton Train Station','21:00:00',2);

INSERT INTO `Train_Trips_Arrival_Schedule`(`Train_Trip_Number`, `Arrival_City`, `Arrival_Station`, `Arrival_Time`, `Arrival_Extra_Day`)
VALUES ('T001','Vancouver','Pacific Central Station','03:00:00',4);




-- INSERT Carriage_Class
INSERT INTO `Carriage_Class` (`Carriage_No`, `Class`) VALUES ('1', 'Business');
INSERT INTO `Carriage_Class` (`Carriage_No`, `Class`) VALUES ('2', 'Economy Plus');
INSERT INTO `Carriage_Class` (`Carriage_No`, `Class`) VALUES ('3', 'Economy Plus');
INSERT INTO `Carriage_Class` (`Carriage_No`, `Class`) VALUES ('4', 'Economy');
INSERT INTO `Carriage_Class` (`Carriage_No`, `Class`) VALUES ('5', 'Economy');
INSERT INTO `Carriage_Class` (`Carriage_No`, `Class`) VALUES ('6', 'Economy');



-- INSERT WebUser
INSERT INTO `WebUser`(`User_ID`, `PASSWORD`, `Email_Address`) VALUES ('richard','1400042414','richard@gmail.com');
INSERT INTO `WebUser`(`User_ID`, `PASSWORD`, `Email_Address`) VALUES ('hrj0420','123456','hrj@ubc.ca');



-- INSERT Adult_Discount
INSERT INTO Adults_Discount(`Special_ID_Type`, `Discount`) VALUES ('None','1');
INSERT INTO Adults_Discount(`Special_ID_Type`, `Discount`) VALUES ('Student Card','0.8');
INSERT INTO Adults_Discount(`Special_ID_Type`, `Discount`) VALUES ('Disability','0.7');
INSERT INTO Adults_Discount(`Special_ID_Type`, `Discount`) VALUES ('Group Discount','0.9');
INSERT INTO Adults_Discount(`Special_ID_Type`, `Discount`) VALUES ('Other','0.8');

-- INSERT Children_Senior_Discount
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (0,0);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (1,0);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (2,0);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (3,0);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (4,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (5,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (6,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (7,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (8,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (9,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (10,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (11,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (12,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (13,0.7);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (14,0.7);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (15,0.7);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (16,0.7);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (17,0.7);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (18,0.7);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (65,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (66,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (67,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (68,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (69,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (70,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (71,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (72,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (73,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (74,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (75,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (76,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (77,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (78,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (79,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (80,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (81,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (82,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (83,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (84,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (85,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (86,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (87,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (88,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (89,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (90,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (91,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (92,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (93,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (94,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (95,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (96,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (97,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (98,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (99,0.5);
INSERT INTO `Children_Senior_Discount` (Age, Discount) values (100,0.5);
