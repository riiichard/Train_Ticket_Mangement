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
	echo "<a href='findpassing.html' >Back</a>";
}

include 'connect.php';
$table=$_POST["selectedtable"];
$ticketnumber=$_POST["ticketnumber"];
$conn = OpenCon();

$s_ui="select * from Board_Ticket where Ticket_Number='$ticketnumber'";
$result = mysqli_query($conn,$s_ui) or die(mysqli_error($conn));

if(mysqli_num_rows($result)==0){
	echo "<script>;alert('The Ticket/Passenger Not Exists');history.back(-1);</script>;";
}else{
			$pass_sql="select * from Board_Ticket inner join $table using (Train_Trip_Number) where Board_Ticket.Ticket_Number='$ticketnumber'";
			myTable($conn,$pass_sql);
}
?>
