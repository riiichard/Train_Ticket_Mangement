-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 06, 2020 at 07:24 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trainSystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `Adult`
--

CREATE TABLE `Adult` (
  `Government_ID_Type` char(40) NOT NULL,
  `ID_Number` char(20) NOT NULL,
  `First_Name` char(20) DEFAULT NULL,
  `Last_Name` char(20) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `Phone_Number` char(20) DEFAULT NULL,
  `Address` char(40) DEFAULT NULL,
  `Special_ID_Type` char(40) DEFAULT NULL,
  `Special_ID_Number` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Adult`
--

INSERT INTO `Adult` (`Government_ID_Type`, `ID_Number`, `First_Name`, `Last_Name`, `Age`, `Phone_Number`, `Address`, `Special_ID_Type`, `Special_ID_Number`) VALUES
('Driver Licence', '23524324', 'Alen', 'Dong', 32, '7785554444', '2205 Lower Mall', 'None', 'None'),
('Driver Licence', '33333333', 'Ludy', 'Allen', 34, '99999999', 'sdfdsf', 'None', 'None'),
('Driver Licence', '789789', 'Old', 'John', 88, '778456123', '2205 Lower Mall', 'None', '456456');

-- --------------------------------------------------------

--
-- Table structure for table `Adults_Discount`
--

CREATE TABLE `Adults_Discount` (
  `Special_ID_Type` char(20) NOT NULL,
  `Discount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Adults_Discount`
--

INSERT INTO `Adults_Discount` (`Special_ID_Type`, `Discount`) VALUES
('Disability', 0.7),
('Group Discount', 0.9),
('None', 1),
('Other', 0.8),
('Student Card', 0.8);

-- --------------------------------------------------------

--
-- Table structure for table `Assigned_Seat`
--

CREATE TABLE `Assigned_Seat` (
  `Ticket_Number` int(11) NOT NULL,
  `Carriage_No` int(11) NOT NULL,
  `Seat_No` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Assigned_Seat`
--

INSERT INTO `Assigned_Seat` (`Ticket_Number`, `Carriage_No`, `Seat_No`) VALUES
(173713, 3, 14),
(186677, 1, 0),
(202930, 1, 0),
(247762, 6, 0),
(299480, 1, 0),
(442847, 1, 0),
(513056, 1, 0),
(637105, 3, 0),
(760678, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Board_Ticket`
--

CREATE TABLE `Board_Ticket` (
  `Ticket_Number` int(11) NOT NULL,
  `Train_Trip_Number` char(20) NOT NULL,
  `Departure_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Board_Ticket`
--

INSERT INTO `Board_Ticket` (`Ticket_Number`, `Train_Trip_Number`, `Departure_Date`) VALUES
(186677, 'O001', '2020-04-12'),
(299480, 'T001', '2020-04-07'),
(247762, 'T001', '2020-04-08'),
(513056, 'T001', '2020-04-09'),
(637105, 'T001', '2020-04-09'),
(173713, 'V001', '2020-04-07'),
(202930, 'V001', '2020-04-09'),
(442847, 'V002', '2020-04-12'),
(760678, 'V002', '2020-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `Carriage_Class`
--

CREATE TABLE `Carriage_Class` (
  `Carriage_No` int(11) NOT NULL,
  `Class` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Carriage_Class`
--

INSERT INTO `Carriage_Class` (`Carriage_No`, `Class`) VALUES
(1, 'Business'),
(2, 'Economy Plus'),
(3, 'Economy Plus'),
(4, 'Economy'),
(5, 'Economy'),
(6, 'Economy');

-- --------------------------------------------------------

--
-- Table structure for table `Children_Senior_Discount`
--

CREATE TABLE `Children_Senior_Discount` (
  `Age` int(11) NOT NULL,
  `Discount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Children_Senior_Discount`
--

INSERT INTO `Children_Senior_Discount` (`Age`, `Discount`) VALUES
(0, 0),
(1, 0),
(2, 0),
(3, 0),
(4, 0.5),
(5, 0.5),
(6, 0.5),
(7, 0.5),
(8, 0.5),
(9, 0.5),
(10, 0.5),
(11, 0.5),
(12, 0.5),
(13, 0.7),
(14, 0.7),
(15, 0.7),
(16, 0.7),
(17, 0.7),
(18, 0.7),
(65, 0.5),
(66, 0.5),
(67, 0.5),
(68, 0.5),
(69, 0.5),
(70, 0.5),
(71, 0.5),
(72, 0.5),
(73, 0.5),
(74, 0.5),
(75, 0.5),
(76, 0.5),
(77, 0.5),
(78, 0.5),
(79, 0.5),
(80, 0.5),
(81, 0.5),
(82, 0.5),
(83, 0.5),
(84, 0.5),
(85, 0.5),
(86, 0.5),
(87, 0.5),
(88, 0.5),
(89, 0.5),
(90, 0.5),
(91, 0.5),
(92, 0.5),
(93, 0.5),
(94, 0.5),
(95, 0.5),
(96, 0.5),
(97, 0.5),
(98, 0.5),
(99, 0.5),
(100, 0.5);

-- --------------------------------------------------------

--
-- Table structure for table `Guarded_Child`
--

CREATE TABLE `Guarded_Child` (
  `Child_ID_Type` char(40) NOT NULL,
  `Child_ID_Number` char(20) NOT NULL,
  `First_Name` char(20) DEFAULT NULL,
  `Last_Name` char(20) DEFAULT NULL,
  `Child_Age` int(11) DEFAULT NULL,
  `Adult_ID_Type` char(40) DEFAULT NULL,
  `Adult_ID_Number` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Guarded_Child`
--

INSERT INTO `Guarded_Child` (`Child_ID_Type`, `Child_ID_Number`, `First_Name`, `Last_Name`, `Child_Age`, `Adult_ID_Type`, `Adult_ID_Number`) VALUES
('Health Card', '123123', 'Little', 'Don', 8, 'Driver Licence', '33333333'),
('Health Card', '3424234', 'Little', 'Tom', 12, 'Driver Licence', '23524324');

-- --------------------------------------------------------

--
-- Table structure for table `One_Ordered_Ticket`
--

CREATE TABLE `One_Ordered_Ticket` (
  `Ticket_Number` int(11) NOT NULL,
  `Government_ID_Type` char(40) NOT NULL,
  `ID_Number` char(20) NOT NULL,
  `Order_Number` int(11) NOT NULL,
  `Class` char(20) DEFAULT NULL,
  `Ticket_Price` double DEFAULT NULL,
  `Price_After_Discount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `One_Ordered_Ticket`
--

INSERT INTO `One_Ordered_Ticket` (`Ticket_Number`, `Government_ID_Type`, `ID_Number`, `Order_Number`, `Class`, `Ticket_Price`, `Price_After_Discount`) VALUES
(173713, 'Driver Licence', '23524324', 26730648, 'Economy Plus', 120, 180),
(186677, 'Driver Licence', '23524324', 41207401, 'Economy', 30, 30),
(202930, 'Driver Licence', '33333333', 66991588, 'Economy', 450, 450),
(247762, 'Driver Licence', '789789', 86419578, 'Business', 120, 120),
(299480, 'Driver Licence', '23524324', 66991588, 'Economy', 450, 450),
(442847, 'Driver Licence', '23524324', 27916522, 'Economy', 100, 100),
(513056, 'Health Card', '123123', 66991588, 'Economy', 330, 165),
(637105, 'Health Card', '3424234', 26730648, 'Economy Plus', 120, 90),
(760678, 'Driver Licence', '23524324', 78558137, 'Economy Plus', 100, 150);

-- --------------------------------------------------------

--
-- Table structure for table `Passenger`
--

CREATE TABLE `Passenger` (
  `Government_ID_Type` char(40) NOT NULL,
  `ID_Number` char(20) NOT NULL,
  `First_Name` char(20) DEFAULT NULL,
  `Last_Name` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Passenger`
--

INSERT INTO `Passenger` (`Government_ID_Type`, `ID_Number`, `First_Name`, `Last_Name`) VALUES
('Driver Licence', '23524324', 'Alen', 'Dong'),
('Driver Licence', '33333333', 'Ludy', 'Allen'),
('Driver Licence', '789789', 'Old', 'John'),
('Health Card', '123123', 'Little', 'Don'),
('Health Card', '3424234', 'Little', 'Tom');

-- --------------------------------------------------------

--
-- Table structure for table `Placed_Order`
--

CREATE TABLE `Placed_Order` (
  `Order_Number` int(11) NOT NULL,
  `User_ID` char(20) NOT NULL,
  `Total_Paid` double DEFAULT NULL,
  `Payment_Type` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Placed_Order`
--

INSERT INTO `Placed_Order` (`Order_Number`, `User_ID`, `Total_Paid`, `Payment_Type`) VALUES
(26730648, '9366', 270, 'Credit Card'),
(27916522, '9366', 100, 'Credit Card'),
(41207401, '9366', 30, 'Credit Card'),
(66991588, '9366', 1065, 'Credit Card'),
(78558137, '9366', 150, 'Credit Card'),
(86419578, '9366', 120, 'Credit Card');

-- --------------------------------------------------------

--
-- Table structure for table `Ticket_Schedule`
--

CREATE TABLE `Ticket_Schedule` (
  `Ticket_Number` int(11) NOT NULL,
  `Departure_City` char(20) DEFAULT NULL,
  `Departure_Station` char(40) DEFAULT NULL,
  `Arrival_City` char(20) DEFAULT NULL,
  `Arrival_Station` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Ticket_Schedule`
--

INSERT INTO `Ticket_Schedule` (`Ticket_Number`, `Departure_City`, `Departure_Station`, `Arrival_City`, `Arrival_Station`) VALUES
(173713, 'Vancouver', 'Pacific Central Station', 'Edmonton', 'Edmonton Train Station'),
(186677, 'Ottawa', 'Ottawa Central Station', 'Toronto', 'Central Union Station'),
(202930, 'Vancouver', 'Pacific Central Station', 'Toronto', 'Central Union Station'),
(247762, 'Edmonton', 'Edmonton Train Station', 'Vancouver', 'Pacific Central Station'),
(299480, 'Toronto', 'Central Union Station', 'Vancouver', 'Pacific Central Station'),
(442847, 'Vancouver', 'Pacific Central Station', 'Calgary', 'Calgary Train Station'),
(513056, 'Toronto', 'Central Union Station', 'Edmonton', 'Edmonton Train Station'),
(637105, 'Edmonton', 'Edmonton Train Station', 'Vancouver', 'Pacific Central Station'),
(760678, 'Vancouver', 'Pacific Central Station', 'Calgary', 'Calgary Train Station');

-- --------------------------------------------------------

--
-- Table structure for table `Train_Staff`
--

CREATE TABLE `Train_Staff` (
  `ID` int(11) NOT NULL,
  `NAME` char(20) NOT NULL,
  `Password` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Train_Staff`
--

INSERT INTO `Train_Staff` (`ID`, `NAME`, `Password`) VALUES
(1000, 'Isha Mehta', '11111111'),
(2547, 'Alex Deacon', '22222222'),
(3357, 'Angela Machado', '33333333'),
(4768, 'Armin Talaie', '44444444'),
(5134, 'Jason Nguyen', '55555555');

-- --------------------------------------------------------

--
-- Table structure for table `Train_Station`
--

CREATE TABLE `Train_Station` (
  `City` char(20) NOT NULL,
  `Station` char(40) NOT NULL,
  `Distance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Train_Station`
--

INSERT INTO `Train_Station` (`City`, `Station`, `Distance`) VALUES
('Calgary', 'Calgary Train Station', 1000),
('Edmonton', 'Edmonton Train Station', 1200),
('Ottawa', 'Ottawa Central Station', 4800),
('Toronto', 'Central Union Station', 4500),
('Toronto', 'Toronto Pearson International Airport', 4400),
('Vancouver', 'Pacific Central Station', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Train_Trip`
--

CREATE TABLE `Train_Trip` (
  `Train_Trip_Number` char(20) NOT NULL,
  `Departure_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Train_Trip`
--

INSERT INTO `Train_Trip` (`Train_Trip_Number`, `Departure_Date`) VALUES
('E001', '2020-04-13'),
('O001', '2020-04-12'),
('T001', '2020-04-06'),
('T001', '2020-04-07'),
('T001', '2020-04-08'),
('T001', '2020-04-09'),
('T001', '2020-04-10'),
('T002', '2020-04-11'),
('V001', '2020-04-05'),
('V001', '2020-04-06'),
('V001', '2020-04-07'),
('V001', '2020-04-08'),
('V001', '2020-04-09'),
('V002', '2020-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `Train_Trips_Arrival_Schedule`
--

CREATE TABLE `Train_Trips_Arrival_Schedule` (
  `Train_Trip_Number` char(20) NOT NULL,
  `Arrival_City` char(20) NOT NULL,
  `Arrival_Station` char(40) NOT NULL,
  `Arrival_Time` time DEFAULT NULL,
  `Arrival_Extra_Day` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Train_Trips_Arrival_Schedule`
--

INSERT INTO `Train_Trips_Arrival_Schedule` (`Train_Trip_Number`, `Arrival_City`, `Arrival_Station`, `Arrival_Time`, `Arrival_Extra_Day`) VALUES
('E001', 'Calgary', 'Calgary Train Station', '12:00:00', 0),
('E001', 'Vancouver', 'Pacific Central Station', '14:00:00', 1),
('O001', 'Toronto', 'Central Union Station', '14:00:00', 1),
('T001', 'Edmonton', 'Edmonton Train Station', '21:00:00', 2),
('T001', 'Toronto', 'Toronto Pearson International Airport', '20:00:00', 0),
('T001', 'Vancouver', 'Pacific Central Station', '03:00:00', 4),
('T002', 'Ottawa', 'Ottawa Central Station', '09:00:00', 1),
('V001', 'Edmonton', 'Edmonton Train Station', '12:00:00', 1),
('V001', 'Toronto', 'Central Union Station', '10:30:00', 3),
('V001', 'Toronto', 'Toronto Pearson International Airport', '09:00:00', 3),
('V002', 'Calgary', 'Calgary Train Station', '08:50:00', 1),
('V002', 'Edmonton', 'Edmonton Train Station', '14:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Train_Trips_Departure_Schedule`
--

CREATE TABLE `Train_Trips_Departure_Schedule` (
  `Train_Trip_Number` char(20) NOT NULL,
  `Departure_City` char(20) NOT NULL,
  `Departure_Station` char(40) NOT NULL,
  `Departure_Time` time DEFAULT NULL,
  `Departure_Extra_Day` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Train_Trips_Departure_Schedule`
--

INSERT INTO `Train_Trips_Departure_Schedule` (`Train_Trip_Number`, `Departure_City`, `Departure_Station`, `Departure_Time`, `Departure_Extra_Day`) VALUES
('E001', 'Calgary', 'Calgary Train Station', '12:20:00', 0),
('E001', 'Edmonton', 'Edmonton Train Station', '08:50:00', 0),
('O001', 'Ottawa', 'Ottawa Central Station', '08:50:00', 0),
('T001', 'Edmonton', 'Edmonton Train Station', '21:10:00', 2),
('T001', 'Toronto', 'Central Union Station', '18:00:00', 0),
('T001', 'Toronto', 'Toronto Pearson International Airport', '20:10:00', 0),
('T002', 'Toronto', 'Central Union Station', '08:50:00', 0),
('V001', 'Edmonton', 'Edmonton Train Station', '12:10:00', 1),
('V001', 'Toronto', 'Toronto Pearson International Airport', '09:10:00', 3),
('V001', 'Vancouver', 'Pacific Central Station', '09:00:00', 0),
('V002', 'Calgary', 'Calgary Train Station', '09:00:00', 1),
('V002', 'Vancouver', 'Pacific Central Station', '12:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `WebUser`
--

CREATE TABLE `WebUser` (
  `User_ID` char(20) NOT NULL,
  `PASSWORD` char(20) NOT NULL,
  `Email_Address` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `WebUser`
--

INSERT INTO `WebUser` (`User_ID`, `PASSWORD`, `Email_Address`) VALUES
('9366', 'xiaozei', 'asjkdha@gmail.com'),
('hrj0420', '123456', 'hrj@ubc.ca'),
('richard', '1400042414', 'richard@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Adult`
--
ALTER TABLE `Adult`
  ADD PRIMARY KEY (`Government_ID_Type`,`ID_Number`),
  ADD KEY `Special_ID_Type` (`Special_ID_Type`);

--
-- Indexes for table `Adults_Discount`
--
ALTER TABLE `Adults_Discount`
  ADD PRIMARY KEY (`Special_ID_Type`);

--
-- Indexes for table `Assigned_Seat`
--
ALTER TABLE `Assigned_Seat`
  ADD PRIMARY KEY (`Ticket_Number`,`Carriage_No`,`Seat_No`),
  ADD KEY `Carriage_No` (`Carriage_No`);

--
-- Indexes for table `Board_Ticket`
--
ALTER TABLE `Board_Ticket`
  ADD PRIMARY KEY (`Ticket_Number`),
  ADD KEY `Train_Trip_Number` (`Train_Trip_Number`,`Departure_Date`);

--
-- Indexes for table `Carriage_Class`
--
ALTER TABLE `Carriage_Class`
  ADD PRIMARY KEY (`Carriage_No`);

--
-- Indexes for table `Children_Senior_Discount`
--
ALTER TABLE `Children_Senior_Discount`
  ADD PRIMARY KEY (`Age`);

--
-- Indexes for table `Guarded_Child`
--
ALTER TABLE `Guarded_Child`
  ADD PRIMARY KEY (`Child_ID_Type`,`Child_ID_Number`),
  ADD KEY `Adult_ID_Type` (`Adult_ID_Type`,`Adult_ID_Number`);

--
-- Indexes for table `One_Ordered_Ticket`
--
ALTER TABLE `One_Ordered_Ticket`
  ADD PRIMARY KEY (`Ticket_Number`,`Government_ID_Type`,`ID_Number`,`Order_Number`),
  ADD KEY `Government_ID_Type` (`Government_ID_Type`,`ID_Number`),
  ADD KEY `Order_Number` (`Order_Number`);

--
-- Indexes for table `Passenger`
--
ALTER TABLE `Passenger`
  ADD PRIMARY KEY (`Government_ID_Type`,`ID_Number`);

--
-- Indexes for table `Placed_Order`
--
ALTER TABLE `Placed_Order`
  ADD PRIMARY KEY (`Order_Number`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `Ticket_Schedule`
--
ALTER TABLE `Ticket_Schedule`
  ADD PRIMARY KEY (`Ticket_Number`),
  ADD KEY `Departure_City` (`Departure_City`,`Departure_Station`),
  ADD KEY `Arrival_City` (`Arrival_City`,`Arrival_Station`);

--
-- Indexes for table `Train_Staff`
--
ALTER TABLE `Train_Staff`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Train_Station`
--
ALTER TABLE `Train_Station`
  ADD PRIMARY KEY (`City`,`Station`);

--
-- Indexes for table `Train_Trip`
--
ALTER TABLE `Train_Trip`
  ADD PRIMARY KEY (`Train_Trip_Number`,`Departure_Date`);

--
-- Indexes for table `Train_Trips_Arrival_Schedule`
--
ALTER TABLE `Train_Trips_Arrival_Schedule`
  ADD PRIMARY KEY (`Train_Trip_Number`,`Arrival_City`,`Arrival_Station`),
  ADD KEY `Arrival_City` (`Arrival_City`,`Arrival_Station`);

--
-- Indexes for table `Train_Trips_Departure_Schedule`
--
ALTER TABLE `Train_Trips_Departure_Schedule`
  ADD PRIMARY KEY (`Train_Trip_Number`,`Departure_City`,`Departure_Station`),
  ADD KEY `Departure_City` (`Departure_City`,`Departure_Station`);

--
-- Indexes for table `WebUser`
--
ALTER TABLE `WebUser`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `Email_Address` (`Email_Address`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Adult`
--
ALTER TABLE `Adult`
  ADD CONSTRAINT `adult_ibfk_1` FOREIGN KEY (`Special_ID_Type`) REFERENCES `Adults_Discount` (`Special_ID_Type`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `Assigned_Seat`
--
ALTER TABLE `Assigned_Seat`
  ADD CONSTRAINT `assigned_seat_ibfk_1` FOREIGN KEY (`Ticket_Number`) REFERENCES `Ticket_Schedule` (`Ticket_Number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assigned_seat_ibfk_2` FOREIGN KEY (`Carriage_No`) REFERENCES `Carriage_Class` (`Carriage_No`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Board_Ticket`
--
ALTER TABLE `Board_Ticket`
  ADD CONSTRAINT `board_ticket_ibfk_1` FOREIGN KEY (`Ticket_Number`) REFERENCES `Ticket_Schedule` (`Ticket_Number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `board_ticket_ibfk_2` FOREIGN KEY (`Train_Trip_Number`,`Departure_Date`) REFERENCES `Train_Trip` (`Train_Trip_Number`, `Departure_Date`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Guarded_Child`
--
ALTER TABLE `Guarded_Child`
  ADD CONSTRAINT `guarded_child_ibfk_1` FOREIGN KEY (`Adult_ID_Type`,`Adult_ID_Number`) REFERENCES `Adult` (`Government_ID_Type`, `ID_Number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `One_Ordered_Ticket`
--
ALTER TABLE `One_Ordered_Ticket`
  ADD CONSTRAINT `one_ordered_ticket_ibfk_1` FOREIGN KEY (`Government_ID_Type`,`ID_Number`) REFERENCES `Passenger` (`Government_ID_Type`, `ID_Number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `one_ordered_ticket_ibfk_2` FOREIGN KEY (`Order_Number`) REFERENCES `Placed_Order` (`Order_Number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Placed_Order`
--
ALTER TABLE `Placed_Order`
  ADD CONSTRAINT `placed_order_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `WebUser` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Ticket_Schedule`
--
ALTER TABLE `Ticket_Schedule`
  ADD CONSTRAINT `ticket_schedule_ibfk_1` FOREIGN KEY (`Departure_City`,`Departure_Station`) REFERENCES `Train_Station` (`City`, `Station`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_schedule_ibfk_2` FOREIGN KEY (`Arrival_City`,`Arrival_Station`) REFERENCES `Train_Station` (`City`, `Station`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_schedule_ibfk_3` FOREIGN KEY (`Ticket_Number`) REFERENCES `One_Ordered_Ticket` (`Ticket_Number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Train_Trips_Arrival_Schedule`
--
ALTER TABLE `Train_Trips_Arrival_Schedule`
  ADD CONSTRAINT `train_trips_arrival_schedule_ibfk_1` FOREIGN KEY (`Train_Trip_Number`) REFERENCES `Train_Trip` (`Train_Trip_Number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `train_trips_arrival_schedule_ibfk_2` FOREIGN KEY (`Arrival_City`,`Arrival_Station`) REFERENCES `Train_Station` (`City`, `Station`) ON UPDATE CASCADE;

--
-- Constraints for table `Train_Trips_Departure_Schedule`
--
ALTER TABLE `Train_Trips_Departure_Schedule`
  ADD CONSTRAINT `train_trips_departure_schedule_ibfk_1` FOREIGN KEY (`Train_Trip_Number`) REFERENCES `Train_Trip` (`Train_Trip_Number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `train_trips_departure_schedule_ibfk_2` FOREIGN KEY (`Departure_City`,`Departure_Station`) REFERENCES `Train_Station` (`City`, `Station`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
