<?php
include 'connect.php';
$userid=$_POST["userid"];
$conn = OpenCon();

$s_ui="select * from WebUser where User_ID='$userid'";

$result = mysqli_query($conn,$s_ui) or die(mysqli_error($conn));

if(mysqli_num_rows($result)==0){
	echo "<script>;alert('The User Not Exists');history.back(-1);</script>;";
	}else{
		$sql = "delete from WebUser where User_ID = '$userid'";
		$query = mysqli_query($conn,$sql)  or die(mysqli_error($conn));
		$orderresult = mysqli_query($conn,"select * from WebUser where User_ID='$userid'") or die(mysqli_error($conn));
		if (mysqli_num_rows($orderresult)==0) {
			$ordersql = "delete from Placed_Order where User_ID = '$userid'";
			$orderquery = mysqli_query($conn,$sql)  or die(mysqli_error($conn));
		}
		echo "<script>;alert('user is sucessfully removed');location.href='staffpage.php';</script>;";
	}
?>
