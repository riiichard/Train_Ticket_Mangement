<?php
function myTable($obConn,$sql,$userID,$ordernumber){
    $rsResult = mysqli_query($obConn, $sql)
    or die(mysqli_error($obConn));
    if(mysqli_num_rows($rsResult)>0){
        //We start with header. >>>Here we retrieve the field names<<<
        echo "<table width=\"70%\" border=\"0\"
        cellspacing=\"2\"
        cellpadding=\"0\"><tr align=\"center\" bgcolor=\"#CCCCCC\">";
        /* $i = 0;


        while ($i < mysqli_num_fields($rsResult)){
            $field = mysqli_fetch_field_direct($rsResult, $i);
            $fieldName=$field->name;
            echo "<td><strong>$fieldName</strong></td>";
            $i = $i + 1;
        }
            echo "</tr>"; */

        echo"<tr><th>Ticket Number</th><th>Train Trip Number</th><th>Departure Date</th><th>Departure Time</th><th>Departure City</th><th>Departure Station</th><th>Arrival Date</th><th>Arrival Time</th><th>Arrival City</th><th>Arrival Station</th><th>Ticket Cost</th><th>Delete Ticket</th></tr>";

            //>>>Field names retrieved<<<


            //We dump info
            $bolWhite=true;
            $FormName = 0;
            $totalPrice = 0;

            while ($row = mysqli_fetch_assoc($rsResult)) {
                echo $bolWhite ? "<tr bgcolor=\"#CCCCCC\">" :
                "<tr bgcolor=\"#FFF\">";
                $bolWhite=!$bolWhite;
                // foreach($row as $data) {
                //     echo "<td>$data</td>";
                // }
                $ordernumber = $row['Order_Number'];
                $startDepartDate=$row['Departure_Date'];
                $dpextraday=$row['Departure_Extra_Day'];
                $avextraday=$row['Arrival_Extra_Day'];
                $dpdatestr=$startDepartDate." +".(string)$dpextraday."days";
                $dpdate = date("Y-m-d",strtotime($dpdatestr));
                $avdatestr=$startDepartDate." +".(string)$avextraday."days";
                $avdate = date("Y-m-d",strtotime($avdatestr));
                $TTNumber=$row['Train_Trip_Number'];
                $dpCity=$row['Departure_City'];
                $dpStation=$row['Departure_Station'];
                $avCity=$row['Arrival_City'];
                $avStation=$row['Arrival_Station'];
                $ticketPrice=$row['Price_After_Discount'];
                $totalPrice = $totalPrice+$ticketPrice;
                $passengerName = $row['First_Name'].' '.$row['Last_Name'];

                echo "<td>" . $row['Ticket_Number'] . "</td>";
								echo "<td>" . $passengerName . "</td>";
                echo "<td>" . $dpdate . "</td>";
                echo "<td>" . $row['Departure_Time'] . "</td>";
                echo "<td>" . $row['Departure_City'] . "</td>";
                echo "<td>" . $row['Departure_Station'] . "</td>";
                echo "<td>" . $avdate . "</td>";
                echo "<td>" . $row['Arrival_Time'] . "</td>";
                echo "<td>" . $row['Arrival_City'] . "</td>";
                echo "<td>" . $row['Arrival_Station'] . "</td>";
                echo "<td>" . $ticketPrice . "</td>";
                echo "<td><a href=\"deleteticket.php?ticketnum=".$row['Ticket_Number']."&userid=".$userID."&ordernumber=".$row['Order_Number']."\">Cancel Ticket</a></td>";
                echo "</tr>";
                $FormName = $FormName++;
            }
            echo"</table>";
            


            echo "Total Amount: ";
            echo $totalPrice;

          

          echo "<form id=\"completeOrder\" action=\"completeorder.php\" method=\"post\">
            <input name=\"ordernumber\" type=\"hidden\" value=\"$ordernumber\">
            <input name=\"loginName\" type=\"hidden\" value=\"$userID\">
            <input name=\"totalPaid\" type=\"hidden\" value=\"$totalPrice\">
            <select name=\"paymenttype\">
              <option value=\"Credit Card\">Credit Card</option>
              <option value=\"Debit Card\">Debit Card</option>
              <option value=\"Gift Card\">Gift Card</option>
              <option value=\"Cash at Counter\">Cash at Counter</option>
            </select>
            <input type=\"submit\" name=\"completeOrder\" id=\"button_complete\" value=\"Confirm Order\"/>
             </form>";
        } else {
          echo "no result";
          $sqldeleteemptyorder="DELETE FROM Placed_Order where Order_Number='$ordernumber'";
          $delete=mysqli_query($obConn,$sqldeleteemptyorder);
					if($delete){
            echo "Successfully Deleted Empty Order";
				} else {
          echo "error";
        }
    }
  }
    ?>

    <?php

    include'connect.php';

    if( isset($_POST['ordernumber']) )
{
     $ordernumber = $_POST['ordernumber'];
} else {
  $ordernumber = $_GET['ordernumber'];

}

if( isset($_POST['loginName']) )
{
     $userID = $_POST['loginName'];
} else {
  $userID = $_GET['loginName'];

}
    $conn = OpenCon();
    $sql = "SELECT OT.Order_Number,PA.First_Name,PA.Last_Name,OT.Price_After_Discount,BT.Train_Trip_Number, TS.Ticket_Number, BT.Departure_Date,TS.Departure_City, TTDS.Departure_Station, TTDS.Departure_Time,TTDS.Departure_Extra_Day,TTAS.Arrival_City, TTAS.Arrival_Station, TTAS.Arrival_Time,TTAS.Arrival_Extra_Day
    FROM One_Ordered_Ticket AS OT
    JOIN Passenger AS PA ON OT.Government_ID_Type=PA.Government_ID_Type AND OT.ID_Number=PA.ID_Number
		JOIN Board_Ticket AS BT ON BT.Ticket_Number=OT.Ticket_Number
		JOIN Train_Trip AS TT ON TT.Departure_Date=BT.Departure_Date AND TT.Train_Trip_Number=BT.Train_Trip_Number
		JOIN Ticket_Schedule AS TS ON TS.Ticket_Number=OT.Ticket_Number
		JOIN Train_Trips_Arrival_Schedule AS TTAS ON TTAS.Arrival_City=TS.Arrival_City AND TTAS.Arrival_Station=TS.Arrival_Station AND TT.Train_Trip_Number=TTAS.Train_Trip_Number
    JOIN Train_Trips_Departure_Schedule AS TTDS ON TTDS.Departure_City=TS.Departure_City AND TTDS.Departure_Station=TS.Departure_Station AND TT.Train_Trip_Number=TTDS.Train_Trip_Number
    -- JOIN Train_Trips_Departure_Schedule AS TTDS ON TTDS.Train_Trip_Number=TT.Train_Trip_Number
    WHERE OT.Order_Number ='$ordernumber'
		ORDER BY OT.Order_Number
          ";
    myTable($conn,$sql,$userID,$ordernumber);

    echo "<form id=\"buyMoreTicket\" action=\"inquiryTickets.php\" method=\"post\">
    <input name=\"loginName\" type=\"hidden\" value=\"$userID\">
    <input type=\"submit\" name=\"back_to_Inquiry\" id=\"button_back\" value=\"Buy More Ticket\"/>
     </form>";

    ?>
