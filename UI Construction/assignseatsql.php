<?php
include 'connect.php';
$ticket=$_POST["ticketnumber"];
$carriage=$_POST["carriage"];
$seat=$_POST["seat"];
$conn = OpenCon();

$s_already="select * from Assigned_Seat where Ticket_Number='$ticket'";
$result = mysqli_query($conn,$s_already) or die(mysqli_error($conn));
$row = $result->fetch_assoc();
$oldseat = $row['Seat_No'];

if($oldseat!=0){
	echo "<script>;alert('The Passenger Already Has a Seat.');history.back(-1);</script>;";
	}else{
		$sql = "select * from Assigned_Seat,Board_Ticket where Assigned_Seat.Ticket_Number=Board_Ticket.Ticket_Number AND Assigned_Seat.Carriage_No='$carriage' AND Assigned_Seat.Seat_No='$seat' AND Board_Ticket.Train_Trip_Number IN (select Train_Trip_Number from Board_Ticket where Ticket_Number='$ticket')";
		$assignedresult = mysqli_query($conn,$sql) or die(mysqli_error($conn));
		if(mysqli_num_rows($assignedresult)>0){
			echo "<script>;alert('The Seat Already Assigned.');history.back(-1);</script>;";
		}else{
			$s_class="select Class from One_Ordered_Ticket where Ticket_Number='$ticket'";
			$classresult = mysqli_query($conn,$s_class) or die(mysqli_error($conn));
			$row = mysqli_fetch_array($classresult);
			if($row["Class"]=="Business"){
				if($carriage!=1){
					echo "<script>;alert('Not a Business Carriage');history.back(-1);</script>;";
				}else{
					$insert_sql="UPDATE `Assigned_Seat` SET `Carriage_No`=$carriage,`Seat_No`=$seat WHERE `Ticket_Number`=$ticket";
					$insert=mysqli_query($conn,$insert_sql);
					if($insert){
								echo '<script language="JavaScript">;alert("Successfully Assigned A Seat");location.href="userorder.html";</script>;';
					}else {
						 echo '<script language="JavaScript"> alert("Seat-Assigning Failed");history.back(-1);</script>';
					}
				}
			}else if($row["Class"]=="Economy Plus"){
				if($carriage!=2 && $carriage!=3){
					echo "<script>;alert('Not a Economy Plus Carriage');history.back(-1);</script>;";
				}else{
					$insert_sql="UPDATE `Assigned_Seat` SET `Carriage_No`=$carriage,`Seat_No`=$seat WHERE `Ticket_Number`=$ticket";
					$insert=mysqli_query($conn,$insert_sql);
					if($insert){
								echo '<script language="JavaScript">;alert("Successfully Assigned A Seat");location.href="userorder.html";</script>;';
					}else {
						 echo '<script language="JavaScript"> alert("Seat-Assigning Failed");history.back(-1);</script>';
					}
				}
			} else if($row["Class"]=="Economy"){
				if($carriage!=4 && $carriage!=5 && $carriage!=6){
					echo "<script>;alert('Not a Economy Carriage');history.back(-1);</script>;";
				}else{
					$insert_sql="UPDATE `Assigned_Seat` SET `Carriage_No`=$carriage,`Seat_No`=$seat WHERE `Ticket_Number`=$ticket";
					$insert=mysqli_query($conn,$insert_sql);
					if($insert){
								echo '<script language="JavaScript">;alert("Successfully Assigned A Seat");location.href="userorder.html";</script>;';
					}else {
						 echo '<script language="JavaScript"> alert("Seat-Assigning Failed");history.back(-1);</script>';
					}
				}
			}
		}
	}
?>
