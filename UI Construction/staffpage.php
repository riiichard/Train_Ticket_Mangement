<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>StaffLoginPage</title>
<style type="text/css">
#control_frame {
	width: 739.9px;
	height: 385px;
	padding: 13px;
	position: absolute;
	left: 50%;
	top: 50%;
	margin-left: -400px;
	margin-top: -200px;
	background-color: rgba(255,255,255,0.5);
	border-radius: 10px;
	text-align: center;
}
#return_index {
	position: relative;
	float: left;
	color:rgba(255,255,255,1);
	font-family: "Times New Roman";
}
#staffinfo{
	position: relative;
	float: right;
	color:rgba(255,255,255,1);
	font-family: "Times New Roman";
}
#but_userorder {
	position: relative;
	float: left;
	width: 200px;
	height: 42px;
	margin-left: 110px;
	margin-top: 50px;
	background-color: rgba(255,102,51,1);
	border-radius: 6px;
	border: 0;
	color: rgba(255,255,255,1);
	font-size: 20px;
	font-family: "Times New Roman";
	line-height: 42px;
}
#but_removeuser {
	position: relative;
	float: right;
	width: 200px;
	height: 42px;
	margin-right: 110px;
	margin-top: 50px;
	background-color: rgba(255,102,51,1);
	border-radius: 6px;
	border: 0;
	color: rgba(255,255,255,1);
	font-size: 20px;
	font-family: "Times New Roman";
	line-height: 42px;
}
#but_addtraintrip {
	position: relative;
	float: left;
	width: 200px;
	height: 42px;
	margin-left: 110px;
	margin-top: 25px;
	background-color: rgba(0,204,0,1);
	border-radius: 6px;
	border: 0;
	color: rgba(255,255,255,1);
	font-size: 20px;
	font-family: "Times New Roman";
	line-height: 42px;
}
#but_addtripschedule {
	position: relative;
	float: right;
	width: 200px;
	height: 42px;
	margin-right: 110px;
	margin-top: 25px;
	background-color: rgba(0,0,255,1);
	border-radius: 6px;
	border: 0;
	color: rgba(255,255,255,1);
	font-size: 20px;
	font-family: "Times New Roman";
	line-height: 42px;
}
#but_altertraintrip {
	position: relative;
	float: left;
	width: 200px;
	height: 42px;
	margin-left: 110px;
	margin-top: 25px;
	background-color: rgba(0,204,0,1);
	border-radius: 6px;
	border: 0;
	color: rgba(255,255,255,1);
	font-size: 20px;
	font-family: "Times New Roman";
	line-height: 42px;
}
#but_altertripschedule {
	position: relative;
	float: right;
	width: 200px;
	height: 42px;
	margin-right: 110px;
	margin-top: 25px;
	background-color: rgba(0,0,255,1);
	border-radius: 6px;
	border: 0;
	color: rgba(255,255,255,1);
	font-size: 20px;
	font-family: "Times New Roman";
	line-height: 42px;
}
#but_removetraintrip {
	position: relative;
	float: left;
	width: 200px;
	height: 42px;
	margin-left: 110px;
	margin-top: 25px;
	background-color: rgba(0,204,0,1);
	border-radius: 6px;
	border: 0;
	color: rgba(255,255,255,1);
	font-size: 20px;
	font-family: "Times New Roman";
	line-height: 42px;
}
#but_removetripschedule {
	position: relative;
	float: right;
	width: 200px;
	height: 42px;
	margin-right: 110px;
	margin-top: 25px;
	background-color: rgba(0,0,255,1);
	border-radius: 6px;
	border: 0;
	color: rgba(255,255,255,1);
	font-size: 20px;
	font-family: "Times New Roman";
	line-height: 42px;
}
#login {
	vertical-align: middle;
	padding-top: 20px;
}
a{text-decoration: none};
</style>

</head>

<body style=" background-image:url(login_UnionStation.jpg); background-size:100%; background-repeat:no-repeat;">
<div  class="control" id="control_frame">
     <a id="return_index"; href="homepage.html" >Back Home</a>
		 <form id="staff" action="staffloginsql.php" method="get">
			 <div class="item">
			 		 <div id="staff_info">
			 		 <a type="text" name="staffinfo" id="staffinfo" >
						 Staff ID:
						 <?php
						 session_start();
						 echo $_SESSION['staffid'];
						 ?>
						 Staff Name:
						 <?php
						 echo $_SESSION['staffname'];
						 ?>
					 </a>
			 		 </div>
			 </div>
		 </form>

     <form id="login" action="staffloginsql.php" method="post">

			 <div class="item">
			 		 <div id="userorder_control">
					 <a id="but_userorder"; type="button"; href="userorder.html";  >Check User Order</a>
			 		 </div>
			 </div>

			 <div class="item">
			 		 <div id="removeuser_control">
					 <a id="but_removeuser"; type="button"; href="removeuser.html" >Remove User</a>
			 		 </div>
			 </div>

			 <div class="item">
						<div id="addtraintrip_control">
						<a id="but_addtraintrip"; type="button"; href="addtraintrip.html" >Add Train Trip</a>
						</div>
			 </div>

			 <div class="item">
            <div id="addtrainstation_control">
						<a id="but_addtripschedule"; type="button"; href="addtripschedule.html" >Add Trip Schedule</a>
            </div>
       </div>

			 <div class="item">
            <div id="altertraintrip_control">
						<a id="but_altertraintrip"; type="button"; href="altertraintrip.html" >Alter Train Trip</a>
            </div>
       </div>

			 <div class="item">
            <div id="altertrainstation_control">
						<a id="but_altertripschedule"; type="button"; href="altertripschedule.html" >Alter Trip Schedule</a>
            </div>
       </div>

			 <div class="item">
            <div id="removetraintrip_control">
						<a id="but_removetraintrip"; type="button"; href="removetraintrip.html" >Remove Train Trip</a>
            </div>
       </div>

      <div class="item">
           <div id="removetrainstation_control">
					 <a id="but_removetripschedule"; type="button"; href="removetripschedule.html" >Remove Trip Schedule</a>
           </div>
      </div>
  </form>

</div>
</body>
</html>
