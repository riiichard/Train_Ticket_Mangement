<?php
include 'connect.php';
$ticketnumber=$_GET["ticketnum"];
$userID=$_GET["userid"];
$ordernumber=$_GET["ordernumber"];


$conn = OpenCon();

$s_ui="select * from One_Ordered_Ticket where Ticket_Number='$ticketnumber'";
$result = mysqli_query($conn,$s_ui) or die(mysqli_error($conn));

if(mysqli_num_rows($result)==0){
	echo "<script>;alert('The Ticket NOT Exists');history.back(-1);</script>;";
	}else{
		$delete_sql="delete from One_Ordered_Ticket where Ticket_Number='$ticketnumber'";
					$delete=mysqli_query($conn,$delete_sql);
					if($delete){
                        echo "<script language=\"JavaScript\">;alert(\"Successfully Delete A Ticket\");location.href=\"revieworder.php?loginName=".$userID."&ordernumber=".$ordernumber."\";</script>;";
					}else {
						 echo '<script language="JavaScript"> alert("Ticket-Deleting Failed")</script>';
					}
	}

?>
