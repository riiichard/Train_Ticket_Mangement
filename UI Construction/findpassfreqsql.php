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
	echo "<a href='findpassfreq.html' >Back</a>";
}

include 'connect.php';
$maxormin=$_POST["maxormin"];
$selected=$_POST["selected"];
$incount=[];
for ($i = 0; $i < sizeof($selected); $i++) {
	if($selected[$i]=="Passenger.First_Name"){
		$value="counted.First_Name";
	}else if ($selected[$i]=="Passenger.Last_Name") {
		$value="counted.Last_Name";
	}else if ($selected[$i]=="Passenger.Government_ID_Type") {
		$value="counted.Government_ID_Type";
	}else if ($selected[$i]=="Passenger.ID_Number") {
		$value="counted.ID_Number";
	}else if ($selected[$i]=="One_Ordered_Ticket.Ticket_Number") {
		$value="counted.Number_of_Trips";
	}
	array_push($incount,$value);
}
for ($i = 0; $i < sizeof($selected); $i++) {
	if ($selected[$i]=="One_Ordered_Ticket.Ticket_Number") {
		array_pop($selected);
	}
}

$selectedcol=implode(",",$selected);
$colincount=implode(",",$incount);
$conn = OpenCon();
if ($maxormin=='max') {
	$pass_sql="select $colincount
						 from (select $selectedcol, count(*) as Number_of_Trips
									 from Passenger,One_Ordered_Ticket,Board_Ticket
									 where Passenger.Government_ID_Type=One_Ordered_Ticket.Government_ID_Type AND Passenger.ID_Number=One_Ordered_Ticket.ID_Number
												 AND One_Ordered_Ticket.Ticket_Number=Board_Ticket.Ticket_Number
									 group by Passenger.Government_ID_Type,Passenger.ID_Number
									 order by Passenger.First_Name) as counted
						 where (counted.Number_of_Trips >= all (select counted.Number_of_Trips from (select $selectedcol, count(*) as Number_of_Trips
									 from Passenger,One_Ordered_Ticket,Board_Ticket
									 where Passenger.Government_ID_Type=One_Ordered_Ticket.Government_ID_Type AND Passenger.ID_Number=One_Ordered_Ticket.ID_Number
												 AND One_Ordered_Ticket.Ticket_Number=Board_Ticket.Ticket_Number
									 group by Passenger.Government_ID_Type,Passenger.ID_Number
									 order by Passenger.First_Name) as counted))";
}else if ($maxormin=='min') {
	$pass_sql="select $colincount
						 from (select $selectedcol, count(*) as Number_of_Trips
									 from Passenger,One_Ordered_Ticket,Board_Ticket
									 where Passenger.Government_ID_Type=One_Ordered_Ticket.Government_ID_Type AND Passenger.ID_Number=One_Ordered_Ticket.ID_Number
												 AND One_Ordered_Ticket.Ticket_Number=Board_Ticket.Ticket_Number
									 group by Passenger.Government_ID_Type,Passenger.ID_Number
									 order by Passenger.First_Name) as counted
						 where (counted.Number_of_Trips <= all (select counted.Number_of_Trips from (select $selectedcol, count(*) as Number_of_Trips
									 from Passenger,One_Ordered_Ticket,Board_Ticket
									 where Passenger.Government_ID_Type=One_Ordered_Ticket.Government_ID_Type AND Passenger.ID_Number=One_Ordered_Ticket.ID_Number
												 AND One_Ordered_Ticket.Ticket_Number=Board_Ticket.Ticket_Number
									 group by Passenger.Government_ID_Type,Passenger.ID_Number
									 order by Passenger.First_Name) as counted))";
}else if ($maxormin=='all') {
	$pass_sql="select $selectedcol, count(*) as Number_of_Trips
				from Passenger,One_Ordered_Ticket,Board_Ticket
				where Passenger.Government_ID_Type=One_Ordered_Ticket.Government_ID_Type AND Passenger.ID_Number=One_Ordered_Ticket.ID_Number
							AND One_Ordered_Ticket.Ticket_Number=Board_Ticket.Ticket_Number
				group by Passenger.Government_ID_Type,Passenger.ID_Number
				order by Passenger.First_Name";
}
myTable($conn,$pass_sql);

// "select $selectedcol, count(*) as Number_of_Trips
// 					 from Passenger,One_Ordered_Ticket,Board_Ticket
// 					 where Passenger.Government_ID_Type=One_Ordered_Ticket.Government_ID_Type AND Passenger.ID_Number=One_Ordered_Ticket.ID_Number
// 								 AND One_Ordered_Ticket.Ticket_Number=Board_Ticket.Ticket_Number
// 					 group by Passenger.Government_ID_Type,Passenger.ID_Number
// 					 having count(*)>1
// 					 order by Passenger.First_Name"


// "select $colincount,min(counted.Number_of_Trips)
// 					 from (select $selectedcol, count(*) as Number_of_Trips
// 								 from Passenger,One_Ordered_Ticket,Board_Ticket
// 								 where Passenger.Government_ID_Type=One_Ordered_Ticket.Government_ID_Type AND Passenger.ID_Number=One_Ordered_Ticket.ID_Number
// 											 AND One_Ordered_Ticket.Ticket_Number=Board_Ticket.Ticket_Number
// 								 group by Passenger.Government_ID_Type,Passenger.ID_Number
// 								 order by Passenger.First_Name) as counted
// 					 group by $colincount"


?>
