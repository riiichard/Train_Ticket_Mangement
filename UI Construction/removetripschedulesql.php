<?php
include 'connect.php';
$schedule=$_POST["schedule"];
$number=$_POST["traintripnumber"];
$city=$_POST["city"];
$station=$_POST["station"];
$conn = OpenCon();

$s_ui="select * from Train_Trip where Train_Trip_Number='$number'";
$result = mysqli_query($conn,$s_ui) or die(mysqli_error($conn));

$s_ts="select * from Train_Station where City='$city' AND Station='$station'";
$result1 = mysqli_query($conn,$s_ts) or die(mysqli_error($conn));

if(mysqli_num_rows($result)==0){
	echo "<script>;alert('The Trip NOT Exists');history.back(-1);</script>;";
}elseif (mysqli_num_rows($result1)==0) {
	echo "<script>;alert('The Station Not Exists in The City');history.back(-1);</script>;";
}else{
		if($schedule=='departure'){
			$s_ui="select * from Train_Trips_Departure_Schedule where Train_Trip_Number='$number' AND Departure_City='$city' AND Departure_Station='$station'";
			$result = mysqli_query($conn,$s_ui) or die(mysqli_error($conn));
			if(mysqli_num_rows($result)==0){
				echo "<script>;alert('The Schedule Not Exists');history.back(-1);</script>;";
				}else{
					$delete_sql = "delete from Train_Trips_Departure_Schedule where Train_Trip_Number='$number' AND Departure_City='$city' AND Departure_Station='$station'";
					$delete = mysqli_query($conn,$delete_sql)  or die(mysqli_error($conn));
					if($delete){
								echo '<script language="JavaScript">;alert("Successfully Deleted Departure Schedule");location.href="staffpage.php";</script>;';
					}else {
						 echo '<script language="JavaScript"> alert("Departure-Schedule-Deleting Failed")</script>';
					}
			}
		} else if($schedule=='arrival'){
			$s_ui="select * from Train_Trips_Arrival_Schedule where Train_Trip_Number='$number' AND Arrival_City='$city' AND Arrival_Station='$station'";
			$result = mysqli_query($conn,$s_ui) or die(mysqli_error($conn));
			if(mysqli_num_rows($result)==0){
				echo "<script>;alert('The Schedule Not Exists');history.back(-1);</script>;";
				}else{
					$delete_sql = "delete from Train_Trips_Arrival_Schedule where Train_Trip_Number='$number' AND Arrival_City='$city' AND Arrival_Station='$station'";
					$delete = mysqli_query($conn,$delete_sql)  or die(mysqli_error($conn));
					if($delete){
								echo '<script language="JavaScript">;alert("Successfully Deleted Arrival Schedule");location.href="staffpage.php";</script>;';
					}else {
						 echo '<script language="JavaScript"> alert("Arrival-Schedule-Deleting Failed")</script>';
					}
			}
		}
}
?>
