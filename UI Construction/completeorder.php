<?php

    include'connect.php';
    $ordernumber = $_POST['ordernumber'];
    $totalPaid = $_POST['totalPaid'];
    $paymentType = $_POST['paymenttype'];
    $loginName = $_POST['loginName'];


    $conn = OpenCon();
    $sql ="UPDATE `Placed_Order` 
    SET `Total_Paid`='$totalPaid',`Payment_Type`='$paymentType'
    WHERE `Order_Number`='$ordernumber'
    ";
    $processresult = $conn->query($sql);
    if($processresult)
    {
        echo "Success";
    }
    else
    {
    echo "Error";
    }



    echo "<form id=\"return_index\" action=\"index0.php\" method=\"post\">

    <input name=\"loginName\" type=\"hidden\" value=\"$loginName\">
    <input type=\"submit\" name=\"back_button\" id=\"button_back\" value=\"Back to Main Menu\"/>
     </form>"

?>