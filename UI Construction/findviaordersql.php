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
	echo "<a href='findviaorder.html' >Back</a>";
}

include 'connect.php';
$ordernum=$_POST["ordernum"];
$selected=$_POST["selected"];
$selectedcol=implode(",",$selected);
$conn = OpenCon();

$s_on="select * from Placed_Order where Order_Number='$ordernum'";

$result = mysqli_query($conn,$s_on) or die(mysqli_error($conn));

if(mysqli_num_rows($result)==0){
	echo "<script>;alert('The Order Not Exists');history.back(-1);</script>;";
}else{
		$orderresult = mysqli_query($conn,"select * from One_Ordered_Ticket where Order_Number='$ordernum'") or die(mysqli_error($conn));
		if (mysqli_num_rows($orderresult)==0) {
			echo "<script>;alert('The Order Not Placed');history.back(-1);</script>;";
		}else{
			$order_sql="select $selectedcol from One_Ordered_Ticket, Passenger, Assigned_Seat, Board_Ticket where One_Ordered_Ticket.Order_Number='$ordernum' AND One_Ordered_Ticket.Government_ID_Type = Passenger.Government_ID_Type AND One_Ordered_Ticket.ID_Number = Passenger.ID_Number AND One_Ordered_Ticket.Ticket_Number = Assigned_Seat.Ticket_Number AND One_Ordered_Ticket.Ticket_Number = Board_Ticket.Ticket_Number";
			myTable($conn,$order_sql);
		}
}
?>
