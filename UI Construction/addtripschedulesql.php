<?php
include 'connect.php';
$schedule=$_POST["schedule"];
$number=$_POST["traintripnumber"];
$city=$_POST["city"];
$station=$_POST["station"];
$time=$_POST["time"];
$extraday=$_POST["extraday"];
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

			if(mysqli_num_rows($result)>0){
				echo "<script>;alert('The Schedule Already Exists');history.back(-1);</script>;";
				}else{
					$insert_sql = "insert into Train_Trips_Departure_Schedule values ('$number','$city','$station','$time','$extraday')";
					$insert = mysqli_query($conn,$insert_sql)  or die(mysqli_error($conn));
					if($insert){
								echo '<script language="JavaScript">;alert("Successfully Added Departure Schedule");location.href="staffpage.php";</script>;';
					}else {
						 echo '<script language="JavaScript"> alert("Departure-Schedule-Adding Failed")</script>';
					}
			}
		} else if($schedule=='arrival'){
			$s_ui="select * from Train_Trips_Arrival_Schedule where Train_Trip_Number='$number' AND Arrival_City='$city' AND Arrival_Station='$station'";

			$result = mysqli_query($conn,$s_ui) or die(mysqli_error($conn));

			if(mysqli_num_rows($result)>0){
				echo "<script>;alert('The Schedule Already Exists');history.back(-1);</script>;";
				}else{
					$insert_sql = "insert into Train_Trips_Arrival_Schedule values ('$number','$city','$station','$time','$extraday')";
					$insert = mysqli_query($conn,$insert_sql)  or die(mysqli_error($conn));
					if($insert){
								echo '<script language="JavaScript">;alert("Successfully Added Arrival Schedule");location.href="staffpage.php";</script>;';
					}else {
						 echo '<script language="JavaScript"> alert("Arrival-Schedule-Adding Failed")</script>';
					}
			}
		}
}
?>
