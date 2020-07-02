-- ALL SQL QUERIES USED
-- loginsql.php
** Dynamic SELECTION **
select * from WebUser where $loginvia='$userinfo';

-- registersql.php
select * from WebUser where User_ID='$userid';
insert into WebUser values ('$userid','$password','$emailaddress');

-- staffloginsql.php
select * from Train_Staff where ID='$staffid';
select * from Train_Staff where ID='$staffid';
select * from Train_Staff where ID='$staffid';

-- removeusersql.php
** DELETE with significant CASCADE **
select * from WebUser where User_ID='$userid';
delete from WebUser where User_ID = '$userid'
delete from Placed_Order where User_ID = '$userid';

-- addtraintripsql.php
select * from Train_Trip where Train_Trip_Number='$traintripnumber' AND Departure_Date='$departuredate';
insert into Train_Trip values ('$traintripnumber','$departuredate');

-- removetraintripsql.php
select * from Train_Trip where Train_Trip_Number='$traintripnumber' AND Departure_Date='$departuredate';
delete from Train_Trip where Train_Trip_Number='$traintripnumber' AND Departure_Date='$departuredate';

-- altertraintripsql.php
select * from Train_Trip where Train_Trip_Number='$currentnumber' AND Departure_Date='$currentdate';
update Train_Trip set Train_Trip_Number='$newnumber', Departure_Date='$newdate' where Train_Trip_Number='$currentnumber' AND Departure_Date='$currentdate';

-- addtripschedulesql.php
** INSERT **
select * from Train_Trip where Train_Trip_Number='$number';
select * from Train_Station where City='$city' AND Station='$station';
select * from Train_Trips_Departure_Schedule where Train_Trip_Number='$number' AND Departure_City='$city' AND Departure_Station='$station';
insert into Train_Trips_Departure_Schedule values ('$number','$city','$station','$time','$extraday');
select * from Train_Trips_Arrival_Schedule where Train_Trip_Number='$number' AND Arrival_City='$city' AND Arrival_Station='$station';
insert into Train_Trips_Arrival_Schedule values ('$number','$city','$station','$time','$extraday');

-- removetripschedulesql.php
** DELETE **
select * from Train_Trip where Train_Trip_Number='$number';
select * from Train_Station where City='$city' AND Station='$station';
select * from Train_Trips_Departure_Schedule where Train_Trip_Number='$number' AND Departure_City='$city' AND Departure_Station='$station';
delete from Train_Trips_Departure_Schedule where Train_Trip_Number='$number' AND Departure_City='$city' AND Departure_Station='$station';
select * from Train_Trips_Arrival_Schedule where Train_Trip_Number='$number' AND Arrival_City='$city' AND Arrival_Station='$station';
delete from Train_Trips_Arrival_Schedule where Train_Trip_Number='$number' AND Arrival_City='$city' AND Arrival_Station='$station';

-- altertripschedulesql.php
** UPDATE **
select * from Train_Trip where Train_Trip_Number='$number';
select * from Train_Station where City='$city' AND Station='$station';
select * from Train_Trips_Departure_Schedule where Train_Trip_Number='$number' AND Departure_City='$city' AND Departure_Station='$station';
update Train_Trips_Departure_Schedule set Departure_Time='$time', Departure_Extra_Day='$extraday' where Train_Trip_Number='$number' AND Departure_City='$city' AND Departure_Station='$station';
select * from Train_Trips_Arrival_Schedule where Train_Trip_Number='$number' AND Arrival_City='$city' AND Arrival_Station='$station';
update Train_Trips_Arrival_Schedule set Arrival_Time='$time', Arrival_Extra_Day='$extraday' where Train_Trip_Number='$number' AND Arrival_City='$city' AND Arrival_Station='$station';

-- listordersql.php
** Dynamic PROJECTION **
select * from WebUser where User_ID='$userid';
select $selectedcol from Placed_Order, One_Ordered_Ticket, Passenger, Assigned_Seat, Board_Ticket where Placed_Order.User_ID='$userid' AND Placed_Order.Order_Number = One_Ordered_Ticket.Order_Number AND One_Ordered_Ticket.Government_ID_Type = Passenger.Government_ID_Type AND One_Ordered_Ticket.ID_Number = Passenger.ID_Number AND One_Ordered_Ticket.Ticket_Number = Assigned_Seat.Ticket_Number AND One_Ordered_Ticket.Ticket_Number = Board_Ticket.Ticket_Number;

-- findviaordersql.php
select * from Placed_Order where Order_Number='$ordernum';
select $selectedcol from One_Ordered_Ticket, Passenger, Assigned_Seat, Board_Ticket where One_Ordered_Ticket.Order_Number='$ordernum' AND One_Ordered_Ticket.Government_ID_Type = Passenger.Government_ID_Type AND One_Ordered_Ticket.ID_Number = Passenger.ID_Number AND One_Ordered_Ticket.Ticket_Number = Assigned_Seat.Ticket_Number AND One_Ordered_Ticket.Ticket_Number = Board_Ticket.Ticket_Number;

-- findviatripnumbersql.php
select * from Train_Trip where Train_Trip_Number='$tripnum' AND Departure_Date='$dedate';
select $selectedcol from Train_Trip, Board_Ticket, One_Ordered_Ticket, Passenger, Assigned_Seat where Train_Trip.Train_Trip_Number='$tripnum' AND Train_Trip.Departure_Date='$dedate' AND Train_Trip.Train_Trip_Number=Board_Ticket.Train_Trip_Number AND Board_Ticket.Ticket_Number=One_Ordered_Ticket.Ticket_Number AND One_Ordered_Ticket.Government_ID_Type = Passenger.Government_ID_Type AND One_Ordered_Ticket.ID_Number = Passenger.ID_Number AND One_Ordered_Ticket.Ticket_Number = Assigned_Seat.Ticket_Number AND One_Ordered_Ticket.Ticket_Number = Board_Ticket.Ticket_Number;

-- findviaclasssql.php
select * from Carriage_Class where Class='$class';
select $selectedcol from Assigned_Seat, Board_Ticket, One_Ordered_Ticket, Passenger where Assigned_Seat.Ticket_Number=Board_Ticket.Ticket_Number AND Assigned_Seat.Ticket_Number=One_Ordered_Ticket.Ticket_Number AND One_Ordered_Ticket.Government_ID_Type = Passenger.Government_ID_Type AND One_Ordered_Ticket.ID_Number = Passenger.ID_Number AND Assigned_Seat.Carriage_No IN (select Carriage_No from Carriage_Class where Class='$class');

-- findorderall.php
** DIVISION Query **
select WebUser.User_ID
from WebUser
where not exists
				(select distinct Train_Trip.Train_Trip_Number
				 from Train_Trip where not exists
																 (select distinct Board_Ticket.Train_Trip_Number
																  from Placed_Order,One_Ordered_Ticket,Board_Ticket
																	where WebUser.User_ID=Placed_Order.User_ID AND
																				Placed_Order.Order_Number=One_Ordered_Ticket.Order_Number AND
																				One_Ordered_Ticket.Ticket_Number=Board_Ticket.Ticket_Number AND
																				Board_Ticket.Train_Trip_Number=Train_Trip.Train_Trip_Number));

-- findpassfreqsql.php
** Nested Aggregation with group-by **
select $colincount
           from (select $selectedcol, count(*) as Number_of_Trips
                 from Passenger,One_Ordered_Ticket,Board_Ticket
                 where Passenger.Government_ID_Type=One_Ordered_Ticket.Government_ID_Type AND Passenger.ID_Number=One_Ordered_Ticket.ID_Number
                       AND One_Ordered_Ticket.Ticket_Number=Board_Ticket.Ticket_Number
                 group by Passenger.Government_ID_Type,Passenger.ID_Number
                 order by Passenger.First_Name) as counted
           where (counted.Number_of_Trips >= all (select counted.Number_of_Trips from (select $selectedcol, count(*) as Number_of_Trips
                 from Passenger,One_Ordered_Ticket,Board_Ticket
                 where Passenger.Government_ID_Type=One_Ordered_Ticket.Government_ID_Type AND Passenger.ID_Number=One_Ordered_Ticket.ID_Number
                       AND One_Ordered_Ticket.Ticket_Number=Board_Ticket.Ticket_Number
                 group by Passenger.Government_ID_Type,Passenger.ID_Number
                 order by Passenger.First_Name) as counted));
select $selectedcol, count(*) as Number_of_Trips
      from Passenger,One_Ordered_Ticket,Board_Ticket
      where Passenger.Government_ID_Type=One_Ordered_Ticket.Government_ID_Type AND Passenger.ID_Number=One_Ordered_Ticket.ID_Number
           AND One_Ordered_Ticket.Ticket_Number=Board_Ticket.Ticket_Number
      group by Passenger.Government_ID_Type,Passenger.ID_Number
      order by Passenger.First_Name;

-- assignseatsql.php
select * from Assigned_Seat where Ticket_Number='$ticket';
select * from Assigned_Seat,Board_Ticket where Assigned_Seat.Ticket_Number=Board_Ticket.Ticket_Number AND Assigned_Seat.Carriage_No='$carriage' AND Assigned_Seat.Seat_No='$seat' AND Board_Ticket.Train_Trip_Number IN (select Train_Trip_Number from Board_Ticket where Ticket_Number='$ticket');
select Class from One_Ordered_Ticket where Ticket_Number='$ticket';
insert into Assigned_Seat values ('$ticket','$carriage','$seat');

-- findpassingsql.php
** Dynamic Join Query **
select * from Board_Ticket where Ticket_Number='$ticketnumber';
select * from Board_Ticket inner join $table using (Train_Trip_Number) where Board_Ticket.Ticket_Number='$ticketnumber';


-- book.php

SELECT DISTINCT Passenger.Government_ID_Type, Passenger.ID_Number, First_Name, Last_Name
                            FROM Passenger
                            JOIN One_Ordered_Ticket AS OOT ON OOT.Government_ID_Type=Passenger.Government_ID_Type AND OOT.ID_Number=Passenger.ID_Number
                            JOIN Placed_Order AS PO ON PO.Order_Number=OOT.Order_Number
                            WHERE PO.User_ID='$userID'

-- cancelorder.php
select * from Placed_Order, One_Ordered_Ticket where Order_Number='$ordern'
delete from Placed_Order, One_Ordered_Ticket where Order_Number	='$ordern'
select * from Placed_Order, One_Ordered_Ticket where Order_Number	='$ordern'
delete from Placed_Order where Order_Number ='$ordern'

-- completeorder.php
UPDATE `Placed_Order` 
    SET `Total_Paid`='$totalPaid',`Payment_Type`='$paymentType'
    WHERE `Order_Number`='$ordernumber'


-- deletetickets.php
select * from One_Ordered_Ticket where Ticket_Number='$ticketnumber'
delete from One_Ordered_Ticket where Ticket_Number='$ticketnumber'



-- findTrain.php
SELECT Distance FROM Train_Station WHERE City='$dpCity' AND Station='$dpStation'
SELECT Distance FROM Train_Station WHERE City='$avCity' AND Station='$avStation'

SELECT DISTINCT TT.Train_Trip_Number, TT.Departure_Date,Departure_City,Departure_Station,Departure_Time,Departure_Extra_Day,Arrival_City, Arrival_Station, Arrival_Time,Arrival_Extra_Day
    FROM Train_Trip AS TT
    JOIN (
        SELECT Train_Trip_Number,Departure_City,Departure_Station,Departure_Time,Departure_Extra_Day,Arrival_City, Arrival_Station, Arrival_Time,Arrival_Extra_Day
        FROM Train_Trips_Arrival_Schedule AS TTAS JOIN Train_Trips_Departure_Schedule AS TTDS USING (Train_Trip_Number)
        WHERE (TTDS.Departure_Extra_Day < TTAS.Arrival_Extra_Day OR (TTDS.Departure_Extra_Day = TTAS.Arrival_Extra_Day AND Departure_Time<Arrival_Time)) AND
        Departure_City='$departureCity'
    ) AS TTG ON TTG.Train_Trip_Number=TT.Train_Trip_Number
    WHERE $condition
    ORDER BY Departure_Date,Arrival_Extra_Day,Arrival_Time

-- inquirytickets.php
SELECT DISTINCT City FROM Train_Station
SELECT DISTINCT City FROM Train_Station


-- orderdetail.php
SELECT OT.Order_Number,PA.First_Name,PA.Last_Name,OT.Price_After_Discount,BT.Train_Trip_Number, TS.Ticket_Number, BT.Departure_Date,TS.Departure_City, TTDS.Departure_Station, TTDS.Departure_Time,TTDS.Departure_Extra_Day,TTAS.Arrival_City, TTAS.Arrival_Station, TTAS.Arrival_Time,TTAS.Arrival_Extra_Day
    FROM One_Ordered_Ticket AS OT
    JOIN Passenger AS PA ON OT.Government_ID_Type=PA.Government_ID_Type AND OT.ID_Number=PA.ID_Number
		JOIN Board_Ticket AS BT ON BT.Ticket_Number=OT.Ticket_Number
		JOIN Train_Trip AS TT ON TT.Departure_Date=BT.Departure_Date AND TT.Train_Trip_Number=BT.Train_Trip_Number
		JOIN Ticket_Schedule AS TS ON TS.Ticket_Number=OT.Ticket_Number
		JOIN Train_Trips_Arrival_Schedule AS TTAS ON TTAS.Arrival_City=TS.Arrival_City AND TTAS.Arrival_Station=TS.Arrival_Station AND TT.Train_Trip_Number=TTAS.Train_Trip_Number
    JOIN Train_Trips_Departure_Schedule AS TTDS ON TTDS.Departure_City=TS.Departure_City AND TTDS.Departure_Station=TS.Departure_Station AND TT.Train_Trip_Number=TTDS.Train_Trip_Number
    WHERE OT.Order_Number ='$ordernumber'
		ORDER BY OT.Order_Number


-- shoppingCart.php
INSERT INTO `Guarded_Child`(`Child_ID_Type`, `Child_ID_Number`, `First_Name`, `Last_Name`, `Child_Age`, `Adult_ID_Type`, `Adult_ID_Number`) 
    VALUES ('$newidtype','$newidnumber','$firstName','$lastName','$age','$parentidtype','$parentidnumber')


INSERT INTO `Adult`(`Government_ID_Type`, `ID_Number`, `First_Name`, `Last_Name`, `Age`, `Phone_Number`, `Address`, `Special_ID_Type`, `Special_ID_Number`) 
        VALUES ('$newidtype','$newidnumber','$firstName','$lastName','$age','$phonenumber','$address','None','$sidnumber')


INSERT INTO `Passenger`(`Government_ID_Type`, `ID_Number`, `First_Name`, `Last_Name`) 
                    VALUES ('$newidtype','$newidnumber','$firstName','$lastName')
      


SELECT `Order_Number` FROM `Placed_Order` WHERE User_ID='$userID' AND Payment_Type='NOT PAID'

INSERT INTO `Placed_Order`(`Order_Number`, `User_ID`, `Total_Paid`, `Payment_Type`) VALUES ('$ordernumber','$userID',NULL,'NOT PAID')

SELECT `Age`,`Special_ID_Type`,`Special_ID_Number` FROM `Adult` WHERE Government_ID_Type='$IDtype' AND ID_Number='$IDnumber'

SELECT `Discount` FROM `Adults_Discount` WHERE Special_ID_Type='$spid'

SELECT `Discount` FROM `Children_Senior_Discount` WHERE Age='$age'

SELECT `Child_Age` FROM `Guarded_Child` WHERE Child_ID_Type='$IDtype' AND Child_ID_Number='$IDnumber'

SELECT `Discount` FROM `Children_Senior_Discount` WHERE Age='$age'

INSERT INTO `One_Ordered_Ticket`(`Ticket_Number`, `Government_ID_Type`, `ID_Number`, `Order_Number`,`Class`,`Ticket_Price`, `Price_After_Discount`) 
        VALUES ('$ticketnumber','$IDtype','$IDnumber','$ordernumber','$seatclass','$ticketPrice','$ticketpriceafterdiscount')

INSERT INTO `Ticket_Schedule`(`Ticket_Number`, `Departure_City`, `Departure_Station`, `Arrival_City`, `Arrival_Station`) 
         VALUES ('$ticketnumber','$departureCity','$departureStation','$arrivalCity','$arrivalStation')

INSERT INTO `Board_Ticket`(`Ticket_Number`, `Train_Trip_Number`, `Departure_Date`) 
VALUES ('$ticketnumber','$TrainTripNumber','$startDepartureDate')

INSERT INTO `Assigned_Seat`(`Ticket_Number`, `Carriage_No`, `Seat_No`) 
VALUES ('$ticketnumber','$carriageNumber','0')


--userorder.php

SELECT *
    FROM Placed_Order AS PO
    WHERE PO.User_ID ='$userid'
		ORDER BY PO.Order_Number


SELECT SUM(Total_Paid) AS TotalExpense
    FROM Placed_Order AS PO
    WHERE PO.User_ID ='$userid'    

