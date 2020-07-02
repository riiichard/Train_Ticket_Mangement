<?php
function myTable($obConn,$sql,$userid){
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

        echo"<tr><th>Order_Number</th><th>Order Total</th><th>Payment Type</th><th>Get Order Details</th></tr>";

            //>>>Field names retrieved<<<


            //We dump info
            $bolWhite=true;
            $FormName = 0;

            while ($row = mysqli_fetch_assoc($rsResult)) {
                echo $bolWhite ? "<tr bgcolor=\"#CCCCCC\">" :
                "<tr bgcolor=\"#FFF\">";
                $bolWhite=!$bolWhite;
                $ordernumber = $row['Order_Number'];
                // foreach($row as $data) {
                //     echo "<td>$data</td>";
                // }
                echo "<td>" . $ordernumber . "</td>";
                echo "<td>" . $row['Total_Paid'] . "</td>";
                echo "<td>" . $row['Payment_Type'] . "</td>";
                echo "<td><form id= \"$FormName\" method=\"post\" action=\"revieworder.php\">
                        <input name=\"ordernumber\" type=\"hidden\" value=\"$ordernumber\">
                        <input name=\"loginName\" type=\"hidden\" value=\"$userid\">
                        <input name=\"submit\" type=\"submit\" value=\"Order Details\">
                        </form></td></tr>";

                echo "</tr>";
                $FormName = $FormName++;
            }
            echo"</table>";
        } else {
					echo "no result";
                }
                
                
    }
    ?>


    <?php

    include'connect.php';

    
    if( isset($_POST['loginName']) )
    {
         $userid = $_POST['loginName'];
    } else {
      $userid = $_GET['loginName'];
    
    }    
    $conn = OpenCon();
    $sql = "SELECT *
    FROM Placed_Order AS PO
    WHERE PO.User_ID ='$userid'
		ORDER BY PO.Order_Number
          ";
    myTable($conn,$sql,$userid);
    ?>


    <form action="userorder.php" method="post">
    <input type="submit" name="sum" value="Total Expense" />
    <input name="loginName" type="hidden" value=<?php echo $userid; ?>>
    </form>

    <?php
    if( isset($_POST['loginName']) )
    {
         $userid = $_POST['loginName'];
    } else {
      $userid = $_GET['loginName'];
    
    }

    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['sum']))
    {
        sum($conn,$userid);
    }

    function sum($obConn,$userid){

    $aggsql = "SELECT SUM(Total_Paid) AS TotalExpense
    FROM Placed_Order AS PO
    WHERE PO.User_ID ='$userid'    
    ";

    $aggResult = mysqli_query($obConn, $aggsql)
    or die(mysqli_error($obConn));

    if(mysqli_num_rows($aggResult)>0){
        $row = mysqli_fetch_assoc($aggResult);
        echo $row['TotalExpense'];
    }

    
    
}
echo "<form id=\"return_index\" action=\"index0.php\" method=\"post\">

    <input name=\"loginName\" type=\"hidden\" value=\"$userid\">
    <input type=\"submit\" name=\"back_button\" id=\"button_back\" value=\"Back to Main Menu\"/>
     </form>";
?>
    