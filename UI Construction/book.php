<div  class="bookTickets" id="bookTickets_frame">
     <!-- <a id="return_index"; href="findtrain.php" >Back Home</a> -->
     <?php
         $userID = $_POST['loginName'];

     $departureCity = $_POST['Departure_City'];
     $arrivalCity= $_POST['Arrival_City'];
     $dpdate = $_POST['Departure_Date'];

     echo "<form id=\"buyMoreTicket\" action=\"inquiryTickets.php\" method=\"post\">
    <input name=\"loginName\" type=\"hidden\" value=\"$userID\">
    <input type=\"submit\" name=\"back_to_Inquiry\" id=\"button_back\" value=\"Back to Ticket Inquiry\"/>
     </form>";
     ?>




	 </br>
    </br>
        <label>Select Existing Passenger</label>

     <?php
    include 'connect.php';

    $conn = OpenCon();
    $result = $conn->query("SELECT DISTINCT Passenger.Government_ID_Type, Passenger.ID_Number, First_Name, Last_Name
                            FROM Passenger
                            JOIN One_Ordered_Ticket AS OOT ON OOT.Government_ID_Type=Passenger.Government_ID_Type AND OOT.ID_Number=Passenger.ID_Number
                            JOIN Placed_Order AS PO ON PO.Order_Number=OOT.Order_Number
                            WHERE PO.User_ID='$userID'
                            ");
    echo "<form id=\"passengerInfo\" action=\"shoppingCart.php\" method=\"post\">";
    echo "<select name='existingPassengerID'>";
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            unset($name);
            $name = $row['First_Name'].' '.$row['Last_Name'];
            $combinedID=$row['Government_ID_Type'].'|'.$row['ID_Number'];
            echo '<option value="'.$combinedID.'">'.$name.'</option>';
        }
    echo "</select>";
    } else {
        echo "0 results";
    }
    $TrainTripNumber = $_POST['Train_Trip_Number'];
    $departureCity = $_POST['Departure_City'];
    $departureStation = $_POST['Departure_Station'];
    $dpdate = $_POST['Departure_Date'];
    $avdate = $_POST['Arrival_Date'];
    $startDepartureDate = $_POST['Start_Departure_Date'];
    $arrivalCity= $_POST['Arrival_City'];
    $arrivalStation= $_POST['Arrival_Station'];
    $ticketPrice= $_POST['Ticket_Price'];

    ?>







    <input type="radio" name="seatclass" value="Economy" checked/> Economy
    <input type="radio" name="seatclass" value="Economy Plus" /> Economy Plus
    <input type="radio" name="seatclass" value="Business" /> Business

    <input name="Train_Trip_Number" type="hidden" value="<?php echo $TrainTripNumber; ?>"/>
    <input name="Start_Departure_Date" type="hidden" value="<?php echo $startDepartureDate; ?>">
    <input name="Departure_Date" type="hidden" value="<?php echo $dpdate; ?>">
    <input name="Departure_City" type="hidden" value="<?php echo $departureCity; ?>">
    <input name="Departure_Station" type="hidden" value="<?php echo $departureStation; ?>">
    <input name="Arrival_Date" type="hidden" value="<?php echo $avdate; ?>">
    <input name="Arrival_City" type="hidden" value="<?php echo $arrivalCity; ?>">
    <input name="Arrival_Station" type="hidden" value="<?php echo $arrivalStation; ?>">
    <input name="Ticket_Price" type="hidden" value="<?php echo $ticketPrice; ?>">
    <input name="loginName" type="hidden" value="<?php echo $userID; ?>">
    <input type="submit" name="passenger_button" id="but_existingpassenger" value="Book For Existing Passenger"/>
    </form>

	</br>
    </br>

    <form id="passengerInfo" action="shoppingCart.php" method="post">
	 </br>
    </br>
    <label>Create New Passenger</label><br>

    <label for="firstName">First Name:</label>
    <input name="firstName" type="text" required><br>
    <label for="lastName">Last Name:</label>
    <input name="lastName" type="text" required><br>

    <label for="idtype">Government ID Type:</label>
<select name="idtype">
  <option value="Driver Licence">Driver Licence</option>
  <option value="Passport">Passport</option>
  <option value="Health Card">Health Card</option>
  <option value="Government ID Card">Government ID Card</option>
</select><br>
    <label for="idnumber">ID Number:</label>
    <input name="idnumber" type="text" required><br>

    <label for="age">Age:</label>
    <input name="age" type="number" min="0" max="100" required><br>
    <label for="phonenumber">Phone Number:</label>
    <input name="phonenumber" type="text"><br>

    <label for="address">Address:</label>
    <textarea name="address" rows="4" cols="30"></textarea><br>

    <label for="sidtype">Special ID (IF AVAILABLE):</label>
<select name="sidtype">
  <option value="">None</option>
  <option value="Student Card">Student Card</option>
  <option value="Disability">Disability</option>
  <option value="Discount Group">Group Discount</option>
  <option value="Other">Other</option>
</select><br>
    <label for="sidnumber">SID Number:</label>
    <input name="sidnumber" type="text" value="None"><br>

    <label for="isChild">Is this Passenger a Child?:</label>
    <input name="isChild" type="checkbox" value="1"><br>

    <label for="idtype">Parent Government ID Type:</label>
<select name="parentidtype">
  <option value="Driver Licence">Driver Licence</option>
  <option value="Passport">Passport</option>
  <option value="Health Card">Health Card</option>
  <option value="Government ID Card">Government ID Card</option>
</select><br>
    <label for="parentidnumber">Parent ID Number:</label>
    <input name="parentidnumber" type="text"><br>





    <?php
        $TrainTripNumber = $_POST['Train_Trip_Number'];
        $departureCity = $_POST['Departure_City'];
        $departureStation = $_POST['Departure_Station'];
        $dpdate = $_POST['Departure_Date'];
        $avdate = $_POST['Arrival_Date'];
        $startDepartureDate = $_POST['Start_Departure_Date'];
        $arrivalCity= $_POST['Arrival_City'];
        $arrivalStation= $_POST['Arrival_Station'];
        $ticketPrice= $_POST['Ticket_Price'];
    ?>
    <input name="Train_Trip_Number" type="hidden" value="<?php echo $TrainTripNumber; ?>"/>
    <input name="Start_Departure_Date" type="hidden" value="<?php echo $startDepartureDate; ?>">
    <input name="Departure_Date" type="hidden" value="<?php echo $dpdate; ?>">
    <input name="Departure_City" type="hidden" value="<?php echo $departureCity; ?>">
    <input name="Departure_Station" type="hidden" value="<?php echo $departureStation; ?>">
    <input name="Arrival_Date" type="hidden" value="<?php echo $avdate; ?>">
    <input name="Arrival_City" type="hidden" value="<?php echo $arrivalCity; ?>">
    <input name="Arrival_Station" type="hidden" value="<?php echo $arrivalStation; ?>">
    <input name="Ticket_Price" type="hidden" value="<?php echo $ticketPrice; ?>">
    <input name="loginName" type="hidden" value="<?php echo $userID; ?>">

    <input type="radio" name="seatclass" value="Economy" checked/> Economy
    <input type="radio" name="seatclass" value="Economy Plus" /> Economy Plus
    <input type="radio" name="seatclass" value="Business" /> Business




      <div class="item">
           <div id="selectPassenger">
           <input type="submit" name="newpassenger" id="but_newpassenger" value="Book For New Passenger"/>
           <input type="reset">
           </div>
      </div>


  </form>

</div>