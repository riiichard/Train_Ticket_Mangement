<?php
function myTable($obConn,$sql){
	$orderResult = mysqli_query($obConn, $sql) or die(mysqli_error($obConn));
	if(mysqli_num_rows($orderResult)>0){
		//We start with header. >>>Here we retrieve the field names<<<
		echo "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"0\"><tr align=\"center\" bgcolor=\"#CCCCCC\">";
		$i = 0;
		while ($i < mysqli_num_fields($orderResult)){
		$columns = mysqli_fetch_field_direct($orderResult, $i);
		$colName=$columns->name;
		echo "<td><strong>$colName</strong></td>";
		$i = $i + 1;
		}
		echo "</tr>";
		//>>>Field names retrieved<<<
		//We dump info
		$bolWhite=true;
		while ($row = mysqli_fetch_assoc($orderResult)) {
		echo $bolWhite ? "<tr bgcolor=\"#CCCCCC\">" : "<tr bgcolor=\"#FFF\">";
		$bolWhite=!$bolWhite;
		foreach($row as $data) {
		echo "<td>$data</td>";
		}
		echo "</tr>";
		}
		echo "</table>";
	}
	echo "<a href='findviatrip.html' >Back</a>";
}

include 'connect.php';
$conn = OpenCon();
$pass_sql="select WebUser.User_ID
from WebUser
where not exists
				(select distinct Train_Trip.Train_Trip_Number
				 from Train_Trip where not exists
																 (select distinct Board_Ticket.Train_Trip_Number
																  from Placed_Order,One_Ordered_Ticket,Board_Ticket
																	where WebUser.User_ID=Placed_Order.User_ID AND
																				Placed_Order.Order_Number=One_Ordered_Ticket.Order_Number AND
																				One_Ordered_Ticket.Ticket_Number=Board_Ticket.Ticket_Number AND
																				Board_Ticket.Train_Trip_Number=Train_Trip.Train_Trip_Number))";
myTable($conn,$pass_sql);

?>
