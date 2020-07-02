<?php
include 'connect.php';
$staffid=$_POST["staffid"];
$staffname=$_POST["staffname"];
$password=$_POST["password"];
session_start();
$_SESSION['staffid'] = $staffid;
$_SESSION['staffname'] = $staffname;
$conn = OpenCon();

$s_sid="select * from Train_Staff where ID='$staffid'";
$s_sna="select * from Train_Staff where ID='$staffid'";
$s_spw="select * from Train_Staff where ID='$staffid'";

$result = mysqli_query($conn,$s_sid) or die(mysqli_error($conn));
$row = mysqli_fetch_array(mysqli_query($conn,$s_spw));

if(mysqli_num_rows($result)==0){
	echo "<script>;alert('Staff not exists');history.back(-1);</script>;";
	}else{
		if($row['ID']==$staffid && $row['NAME']==$staffname && $row['Password']==$password)
        {
			setcookie('uname',$staffid,time()+3600);
            echo "<script>;alert('staff logged in');location.href='staffpage.php';</script>;";
        }else{
	      echo "<script>;alert('Invalid staffid/name/password combination');history.back(-1);</script>;";
	          }
	}

?>
