<?php

include'connect.php';
$conn = OpenCon();
if(isset($_POST["newpassenger"]))
{
   echo "A new Passenger!";
   echo "</br>";

   echo $firstName = $_POST['firstName'].'';

   echo $lastName = $_POST['lastName'];
   echo "</br>";
   $newidtype = $_POST['idtype'];
   $newidnumber = $_POST['idnumber'];
   $age = $_POST['age'];
   $phonenumber = $_POST['phonenumber'];
   $address = $_POST['address'];
   $sidtype = $_POST['sidtype'];
   $sidnumber = $_POST['sidnumber'];
   if(isset($_POST['isChild']))
    {
    $parentidtype=$_POST['parentidtype'];
    $parentidnumber=$_POST['parentidnumber'];
    $sqlChild="INSERT INTO `Guarded_Child`(`Child_ID_Type`, `Child_ID_Number`, `First_Name`, `Last_Name`, `Child_Age`, `Adult_ID_Type`, `Adult_ID_Number`) 
    VALUES ('$newidtype','$newidnumber','$firstName','$lastName','$age','$parentidtype','$parentidnumber')
    ";
    $insertChildResult = $conn->query($sqlChild);
    if($insertChildResult)
    {
    echo "Insert Child Success </br>";
    
    }
    else
    {
    echo "Insert Child Error </br>";
    
    }
    } else {
        $sqlAdult="INSERT INTO `Adult`(`Government_ID_Type`, `ID_Number`, `First_Name`, `Last_Name`, `Age`, `Phone_Number`, `Address`, `Special_ID_Type`, `Special_ID_Number`) 
        VALUES ('$newidtype','$newidnumber','$firstName','$lastName','$age','$phonenumber','$address','None','$sidnumber')
        ";
        $insertAdultResult = $conn->query($sqlAdult);
        if($insertAdultResult)
        {
        echo "Insert Adult Success </br>";
        }
        else
        {
        echo "Insert Adult Error </br>";
        }
    }

    $sqlPassenger="INSERT INTO `Passenger`(`Government_ID_Type`, `ID_Number`, `First_Name`, `Last_Name`) 
                    VALUES ('$newidtype','$newidnumber','$firstName','$lastName')
        ";  
        $insertPassengerResult = $conn->query($sqlPassenger);
        if($insertPassengerResult)
        {
        echo "Insert Passenger Success </br>";
        }
        else
        {
        echo "Insert Passenger Error </br>";
        }
        $IDtype = $newidtype;
    $IDnumber = $newidnumber;
} else {

    $passengerID = $_POST['existingPassengerID'];
    $parts = explode("|", $passengerID);
    $IDtype = $parts[0];
    $IDnumber = $parts[1];
    //$userID = $_POST['userID'];
    
}
$userID = $_POST['loginName'];
$TrainTripNumber = $_POST['Train_Trip_Number'];
$departureCity = $_POST['Departure_City'];
$departureStation = $_POST['Departure_Station'];
$dpdate = $_POST['Departure_Date'];
$avdate = $_POST['Arrival_Date'];
$startDepartureDate = $_POST['Start_Departure_Date'];
$arrivalCity= $_POST['Arrival_City'];
$arrivalStation= $_POST['Arrival_Station'];
$ticketPrice= $_POST['Ticket_Price'];
$seatclass= $_POST['seatclass'];


$sql1 = "SELECT `Order_Number` FROM `Placed_Order` WHERE User_ID='$userID' AND Payment_Type='NOT PAID'";
$result = $conn->query($sql1);
if (mysqli_num_rows($result) > 0) {
    $row = $result->fetch_assoc();
    $ordernumber = $row['Order_Number'];
    echo "Existing Order:";
    echo "$ordernumber </br>";
} else {
    $ordernumber = rand(10000000,99999999);
    $sql2 = "INSERT INTO `Placed_Order`(`Order_Number`, `User_ID`, `Total_Paid`, `Payment_Type`) VALUES ('$ordernumber','$userID',NULL,'NOT PAID')";
    $conn->query($sql2);
    echo "New Order:";
    echo "$ordernumber </br>";
}
$ticketnumber = rand(100000,999999);
echo "Ticket Number:";
echo "$ticketnumber </br>";
echo "Train Trip Number:";
echo "$TrainTripNumber </br>";
echo "Start Departure Date:";
echo "$startDepartureDate </br>";

$sqlAgeAdult = "SELECT `Age`,`Special_ID_Type`,`Special_ID_Number` FROM `Adult` WHERE Government_ID_Type='$IDtype' AND ID_Number='$IDnumber'";
$resultAgeAdult = $conn->query($sqlAgeAdult);
if (mysqli_num_rows($resultAgeAdult)>0) {
    $row = $resultAgeAdult->fetch_assoc();
    $age=$row['Age'];
    $spid=$row['Special_ID_Type'];
    $sqlspecialID = "SELECT `Discount` FROM `Adults_Discount` WHERE Special_ID_Type='$spid'";
    $resultspecialdiscount = $conn->query($sqlspecialID);
    $row2 = $resultspecialdiscount->fetch_assoc();
    $specialdiscount=$row2['Discount'];



    $sqlagediscount = "SELECT `Discount` FROM `Children_Senior_Discount` WHERE Age='$age'";
    $resultagediscount = $conn->query($sqlagediscount);
    if (mysqli_num_rows($resultagediscount)>0) {
    $row3 = $resultagediscount->fetch_assoc();
    $agediscount=$row3['Discount'];
    } else {
        $agediscount=1;
    }

    echo 'Adult Total Discount:';
    echo $totaldiscount = $specialdiscount*$agediscount;
    echo "</br>";
} else {
    $sqlAgeChild = "SELECT `Child_Age` FROM `Guarded_Child` WHERE Child_ID_Type='$IDtype' AND Child_ID_Number='$IDnumber'";
    $resultAgeChild = $conn->query($sqlAgeChild);
    if (mysqli_num_rows($resultAgeChild)>0){
        $row = $resultAgeChild->fetch_assoc();

        $age=$row['Child_Age'];
    }
    $sqlagediscount = "SELECT `Discount` FROM `Children_Senior_Discount` WHERE Age='$age'";
    $resultagediscount = $conn->query($sqlagediscount);
    if (mysqli_num_rows($resultagediscount)>0) {
    $row3 = $resultagediscount->fetch_assoc();
    echo 'Child Total Discount:';
    echo $agediscount=$row3['Discount'];
    echo "</br>";
    } else {
        $agediscount=1;
    }

    $totaldiscount = $agediscount;

}


if ($seatclass=="Economy"){
    $seatPremium=1;
    $carriageNumber=1;
} else if ($seatclass=="Economy Plus"){
    $seatPremium=1.5;
    $carriageNumber=rand(2,3);
} else {
    $seatPremium=2;
    $carriageNumber=rand(4,6);
}
echo 'Seat Surcharge Multiplier: ';
echo $seatPremium;
echo "</br>";

echo 'Total Ticket Charge: ';
echo $ticketpriceafterdiscount = $totaldiscount * $ticketPrice * $seatPremium;
echo "</br>";

$sql5 = "INSERT INTO `One_Ordered_Ticket`(`Ticket_Number`, `Government_ID_Type`, `ID_Number`, `Order_Number`,`Class`,`Ticket_Price`, `Price_After_Discount`) 
        VALUES ('$ticketnumber','$IDtype','$IDnumber','$ordernumber','$seatclass','$ticketPrice','$ticketpriceafterdiscount')
";
$result5 = $conn->query($sql5);
if($result5)
{
echo "25%</br>";
}
else
{
echo "Error";
}


$sql3 = "INSERT INTO `Ticket_Schedule`(`Ticket_Number`, `Departure_City`, `Departure_Station`, `Arrival_City`, `Arrival_Station`) 
         VALUES ('$ticketnumber','$departureCity','$departureStation','$arrivalCity','$arrivalStation')
         ";
$result3 = $conn->query($sql3);
if($result3)
{
echo "50%</br>";

}
else
{
echo "Error";

}

$sql4 = "INSERT INTO `Board_Ticket`(`Ticket_Number`, `Train_Trip_Number`, `Departure_Date`) 
VALUES ('$ticketnumber','$TrainTripNumber','$startDepartureDate')
";
$result4 = $conn->query($sql4);
if($result4)
{
echo "75%</br>";
}
else
{
echo "Error";
}

$sql5 = "INSERT INTO `Assigned_Seat`(`Ticket_Number`, `Carriage_No`, `Seat_No`) 
VALUES ('$ticketnumber','$carriageNumber','0')
";
$result5 = $conn->query($sql5);
if($result5)
{
echo "100% </br> Success";
}
else
{
echo "Error";
}


echo "<form id=\"buyMoreTicket\" action=\"inquiryTickets.php\" method=\"post\">
    <input name=\"loginName\" type=\"hidden\" value=\"$userID\">
    <input type=\"submit\" name=\"back_to_Inquiry\" id=\"button_back\" value=\"Buy More Ticket\"/>
     </form>";

/* echo "<form id=\"modifyOrder\" action=\"modifyOrder.php\" method=\"post\">
     <input name=\"loginName\" type=\"hidden\" value=\"$userID\">
     <input type=\"submit\" name=\"modifyOrder\" id=\"button_modify\" value=\"Modify Order\"/>
      </form>"; */

echo "<form id=\"Review and Pay\" action=\"revieworder.php\" method=\"post\">
      <input name=\"loginName\" type=\"hidden\" value=\"$userID\">
      <input name=\"ordernumber\" type=\"hidden\" value=\"$ordernumber\">
      <input type=\"submit\" name=\"reviewOrder\" id=\"button_review\" value=\"Review and Pay Order\"/>
       </form>";
       ?>