<?php
include 'connect.php';
$userid=$_POST["userid"];
$conn = OpenCon();

$s_ui="select * from Placed_Order, One_Ordered_Ticket where Order_Number='$ordern'";

$result = mysqli_query($conn,$s_ui) or die(mysqli_error($conn));

if(mysqli_num_rows($result)==0){
	echo "<script>;alert('The Order Not Exists');history.back(-1);</script>;";
	}else{
		$sql = "delete from Placed_Order, One_Ordered_Ticket where Order_Number	='$ordern'";
		$query = mysqli_query($conn,$sql)  or die(mysqli_error($conn));
		$orderresult = mysqli_query($conn,"select * from Placed_Order, One_Ordered_Ticket where Order_Number	='$ordern'") or die(mysqli_error($conn));
		if (mysqli_num_rows($orderresult)==0) {
			$ordersql = "delete from Placed_Order where Order_Number ='$ordern'";
			$orderquery = mysqli_query($conn,$sql)  or die(mysqli_error($conn));
		}
		echo "<script>;
		alert('user is sucessfully removed');
		
		location.href='staffpage.php';</script>;";
	}
?>
