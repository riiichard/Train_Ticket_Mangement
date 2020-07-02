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
		echo "<a href='listorder.html' >Back</a>";
	}
}

include 'connect.php';
$userid=$_POST["userid"];
$selected=$_POST["selected"];
$selectedcol=implode(",",$selected);
$conn = OpenCon();

$s_ui="select * from WebUser where User_ID='$userid'";

$result = mysqli_query($conn,$s_ui) or die(mysqli_error($conn));

if(mysqli_num_rows($result)==0){
	echo "<script>;alert('The User Not Exists');history.back(-1);</script>;";
}else{
		$orderresult = mysqli_query($conn,"select * from Placed_Order where User_ID='$userid'") or die(mysqli_error($conn));
		if (mysqli_num_rows($orderresult)==0) {
			echo "<script>;alert('The User Has No Orders Yet');history.back(-1);</script>;";
		}else{
			$order_sql="select $selectedcol from Placed_Order, One_Ordered_Ticket, Passenger, Assigned_Seat, Board_Ticket where Placed_Order.User_ID='$userid' AND Placed_Order.Order_Number = One_Ordered_Ticket.Order_Number AND One_Ordered_Ticket.Government_ID_Type = Passenger.Government_ID_Type AND One_Ordered_Ticket.ID_Number = Passenger.ID_Number AND One_Ordered_Ticket.Ticket_Number = Assigned_Seat.Ticket_Number AND One_Ordered_Ticket.Ticket_Number = Board_Ticket.Ticket_Number";
			myTable($conn,$order_sql);
		}
		//
}
?>
