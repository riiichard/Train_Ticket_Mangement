<?php
function myTable($obConn,$sql,$userID){
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

        echo"<tr><th>Train Trip Number</th><th>Departure Date</th><th>Departure Time</th><th>Departure City</th><th>Departure Station</th><th>Arrival Date</th><th>Arrival Time</th><th>Arrival City</th><th>Arrival Station</th><th>Ticket Price</th><th>Book Ticket</th></tr>";
    
            //>>>Field names retrieved<<<


            //We dump info
            $bolWhite=true;
            $FormName = 0;

            while ($row = mysqli_fetch_assoc($rsResult)) {
                echo $bolWhite ? "<tr bgcolor=\"#CCCCCC\">" : 
                "<tr bgcolor=\"#FFF\">";
                $bolWhite=!$bolWhite; 
                // foreach($row as $data) {
                //     echo "<td>$data</td>";
                // }
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
                
                $sql2="SELECT Distance FROM Train_Station WHERE City='$dpCity' AND Station='$dpStation'";
                $sql3="SELECT Distance FROM Train_Station WHERE City='$avCity' AND Station='$avStation'";
                $dep_result = mysqli_query($obConn, $sql2);
                $row_dep = mysqli_fetch_assoc($dep_result);
                $dep_distance=$row_dep['Distance'];
                $arr_result = mysqli_query($obConn, $sql3);
                $arr_dep = mysqli_fetch_assoc($arr_result);
                $arr_distance=$arr_dep['Distance'];      
        
                $ticketPrice=abs($dep_distance-$arr_distance)/10;




                echo "<td>" . $row['Train_Trip_Number'] . "</td>";
                //echo "<td>" . $startDepartDate . "</td>";
                echo "<td>" . $dpdate . "</td>";
                echo "<td>" . $row['Departure_Time'] . "</td>";
                echo "<td>" . $row['Departure_City'] . "</td>";
                echo "<td>" . $row['Departure_Station'] . "</td>";
                echo "<td>" . $avdate . "</td>";
                echo "<td>" . $row['Arrival_Time'] . "</td>";
                echo "<td>" . $row['Arrival_City'] . "</td>";
                echo "<td>" . $row['Arrival_Station'] . "</td>";
                echo "<td>" . $ticketPrice . "</td>";
                echo "<td><form id= \"$FormName\" method=\"post\" action=\"book.php\">
                        <input name=\"Train_Trip_Number\" type=\"hidden\" value=\"$TTNumber\">
                        <input name=\"Start_Departure_Date\" type=\"hidden\" value=\"$startDepartDate\">
                        <input name=\"Departure_Date\" type=\"hidden\" value=\"$dpdate\">
                        <input name=\"Departure_City\" type=\"hidden\" value=\"$dpCity\">
                        <input name=\"Departure_Station\" type=\"hidden\" value=\"$dpStation\">
                        <input name=\"Arrival_Date\" type=\"hidden\" value=\"$avdate\">
                        <input name=\"Arrival_City\" type=\"hidden\" value=\"$avCity\">
                        <input name=\"Arrival_Station\" type=\"hidden\" value=\"$avStation\">
                        <input name=\"Ticket_Price\" type=\"hidden\" value=\"$ticketPrice\">
                        <input name=\"submit\" type=\"submit\" value=\"Book Tickets\">
                        <input name=\"loginName\" type=\"hidden\" value=\"$userID\">
                        </form></td></tr>";

                echo "</tr>";
                $FormName = $FormName++;
            }
            echo"</table>";
        }
    }
    ?>

    <?php

    include'connect.php';
    $userID = $_POST['loginName'];
    $departureCity = $_POST['DepartureCity'];
    $arrivalCity= $_POST['ArrivalCity'];
    $date=$_POST['departuredate'];
    if(isset($_POST['isarrival'])){
        $arrival =" AND Arrival_City='$arrivalCity'";
    } else {
        $arrival ="";
    }
    $conn = OpenCon();
    $datecondition = "DATEDIFF('$date',Departure_Date)".$_POST['datecondition']."TTG.Departure_Extra_Day";
    $condition = $datecondition.$arrival;

    //echo $datecondition;
    $sql = "SELECT DISTINCT TT.Train_Trip_Number, TT.Departure_Date,Departure_City,Departure_Station,Departure_Time,Departure_Extra_Day,Arrival_City, Arrival_Station, Arrival_Time,Arrival_Extra_Day
    FROM Train_Trip AS TT
    JOIN (
        SELECT Train_Trip_Number,Departure_City,Departure_Station,Departure_Time,Departure_Extra_Day,Arrival_City, Arrival_Station, Arrival_Time,Arrival_Extra_Day
        FROM Train_Trips_Arrival_Schedule AS TTAS JOIN Train_Trips_Departure_Schedule AS TTDS USING (Train_Trip_Number)
        WHERE (TTDS.Departure_Extra_Day < TTAS.Arrival_Extra_Day OR (TTDS.Departure_Extra_Day = TTAS.Arrival_Extra_Day AND Departure_Time<Arrival_Time)) AND
        Departure_City='$departureCity'
    ) AS TTG ON TTG.Train_Trip_Number=TT.Train_Trip_Number
    WHERE $condition
    ORDER BY Departure_Date,Arrival_Extra_Day,Arrival_Time
          ";

    myTable($conn,$sql,$userID);

    ?>
    