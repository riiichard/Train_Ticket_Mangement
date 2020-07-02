<?php
include 'connect.php';
$userid=$_POST["userid"];
$password=$_POST["password"];
$password1=$_POST["password1"];
$emailaddress=$_POST["emailaddress"];
$conn = OpenCon();

// date_default_timezone_set('PRC');
// $time=date('Y-m-d H:i:s');
$useridSQL="select * from WebUser where User_ID='$userid'";
$resultSet=mysqli_query($conn,$useridSQL) or die(mysqli_error($conn));

if(mysqli_num_rows($resultSet)>0)
{
	echo "<script language='JavaScript'>;alert('The User ID already exists. Choose a new ID.');history.back(-1);</script>;";
}
else{
	// if(strlen($password)<6 && strlen($password1)<6){
	// 	echo "<script language='JavaScript'>;alert('Password is too short');history.back(-1);</script>;";
	// }else{
		if($password != $password1){
			echo "<script language='JavaScript'>;alert('Password and Comfirm Password not consistent');history.back(-1);</script>;";
		}else{
			      $insert_sql="insert into WebUser values ('$userid','$password','$emailaddress')";
                  $insert=mysqli_query($conn,$insert_sql);
                  if($insert){
	                    	echo '<script language="JavaScript">;alert("Successfully Registered");location.href="login.html";</script>;';
	                }else {
	                   echo '<script language="JavaScript"> alert("Register Failed")</script>';
		              }
		}
}
?>
