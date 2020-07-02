<?php
include 'connect.php';
$currentnumber=$_POST["currentnumber"];
$currentdate=$_POST["currentdate"];
$newnumber=$_POST["newnumber"];
$newdate=$_POST["newdate"];
$conn = OpenCon();

$s_ui="select * from Train_Trip where Train_Trip_Number='$currentnumber' AND Departure_Date='$currentdate'";
$result = mysqli_query($conn,$s_ui) or die(mysqli_error($conn));

if(mysqli_num_rows($result)==0){
	echo "<script>;alert('Current Train Trip NOT Exists');history.back(-1);</script>;";
	}else{
		$update_sql="update Train_Trip set Train_Trip_Number='$newnumber', Departure_Date='$newdate' where Train_Trip_Number='$currentnumber' AND Departure_Date='$currentdate'";
					$update=mysqli_query($conn,$update_sql);
					if($update){
								echo '<script language="JavaScript">;alert("Successfully Update A Train Trip");location.href="staffpage.php";</script>;';
					}else {
						 echo '<script language="JavaScript"> alert("Train-Trip-Updating Failed")</script>';
					}
	}
?>
