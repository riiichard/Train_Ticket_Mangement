<?php
include 'connect.php';
$userid=$_POST["userid"];
$password=$_POST["password"];
$conn = OpenCon();

$s_ui="select * from WebUser where User_ID='$userid' OR Email_Address='$userid'";
$s_pw="select * from WebUser where User_ID='$userid' OR Email_Address='$userid'";

$result = mysqli_query($conn,$s_ui) or die(mysqli_error($conn));
$row = mysqli_fetch_array(mysqli_query($conn,$s_pw));

if(mysqli_num_rows($result)==0){
	echo "<script>;alert('Not Registered');history.back(-1);</script>;";
	}else{
		if(($row['User_ID']==$userid || $row['Email_Address']==$userid) && $row['PASSWORD']==$password)
        {
			setcookie('uname',$userid,time()+3600);
            echo "<script>;alert('logged in');location.href='index0.php?loginName=".$userid."';</script>;";
        }else{
	      echo "<script>;alert('Invalid userid/password combination');history.back(-1);</script>;";
	          }
	}
?>
