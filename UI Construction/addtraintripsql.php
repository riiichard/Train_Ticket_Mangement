<?php
include 'connect.php';
$traintripnumber=$_POST["traintripnumber"];
$departuredate=$_POST["departuredate"];
$conn = OpenCon();

$s_ui="select * from Train_Trip where Train_Trip_Number='$traintripnumber' AND Departure_Date='$departuredate'";
$result = mysqli_query($conn,$s_ui) or die(mysqli_error($conn));

if(mysqli_num_rows($result)>0){
	echo "<script>;alert('The Trip Already Exists');history.back(-1);</script>;";
	}else{
		$insert_sql="insert into Train_Trip values ('$traintripnumber','$departuredate')";
					$insert=mysqli_query($conn,$insert_sql);
					if($insert){
								echo '<script language="JavaScript">;alert("Successfully Added New Train Trip");location.href="staffpage.php";</script>;';
					}else {
						 echo '<script language="JavaScript"> alert("Train-Trip-Adding Failed")</script>';
					}
	}
?>
