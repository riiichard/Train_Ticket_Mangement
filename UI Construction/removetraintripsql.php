<?php
include 'connect.php';
$traintripnumber=$_POST["traintripnumber"];
$departuredate=$_POST["departuredate"];
$conn = OpenCon();

$s_ui="select * from Train_Trip where Train_Trip_Number='$traintripnumber' AND Departure_Date='$departuredate'";
$result = mysqli_query($conn,$s_ui) or die(mysqli_error($conn));

if(mysqli_num_rows($result)==0){
	echo "<script>;alert('The Trip NOT Exists');history.back(-1);</script>;";
	}else{
		$delete_sql="delete from Train_Trip where Train_Trip_Number='$traintripnumber' AND Departure_Date='$departuredate'";
					$delete=mysqli_query($conn,$delete_sql);
					if($delete){
								echo '<script language="JavaScript">;alert("Successfully Delete A Train Trip");location.href="staffpage.php";</script>;';
					}else {
						 echo '<script language="JavaScript"> alert("Train-Trip-Deleting Failed")</script>';
					}
	}
?>
