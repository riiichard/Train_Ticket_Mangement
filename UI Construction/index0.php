<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>InquiryTickets</title>
</head>

<style type="text/css">
#inquiryTickets_frame {
	width: 339.9px;
	height: 500px;
	padding: 13px;
	position: absolute;
	left: 50%;
	top: 50%;
	margin-left: -200px;
	margin-top: -250px;
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
#inquiryTrain {
	float: right;
	color:rgba(255,255,255,1);
	font-family: "Times New Roman";
}
.text_field {
	height: 42px;
	width: 300px;
	border-radius: 10px;
	border: 1;
	vertical-align: middle;
	font-size: 20px;
	font-family: "Times New Roman";
}
#departuredate {
	height: 42px;
	width: 300px;
	border-radius: 10px;
	border: 1;
	vertical-align: middle;
	font-size: 20px;
	font-family: "Times New Roman";
}
#but_inquirytickets {
	width: 300px;
	height: 42px;
	background-color: rgba(255,102,51,1);
	border-radius: 6px;
	border: 0;
	color: rgba(255,255,255,1);
	font-size: 20px;
	font-family: "Times New Roman";
}
#logon {
	vertical-align: middle;
	padding-top: 70px;
}
.item {
	width: 300px;
	height: 42px;
	margin: 40px auto;
	position: relative;
}
.usedemo {
	width: 300px;
	height: 20px;
	margin: 0px auto;
	text-align: center;
}
.pwdemo {
	width: 300px;
	height: 20px;
	margin: 0px auto;
	text-align: center;
}
.pw1demo {
	width: 300px;
	height: 20px;
	margin: 0px auto;
	text-align: center;
}
.emaildemo {
	width: 300px;
	height: 20px;
	margin: 0px auto;
	text-align: center;
}
.demo {
	width: 300px;
	text-align: left;
	font-size: 18px;
	line-height: 12px;
	position: relative;
	float: left;
	height: 20px;
	font-family: "Times New Roman";
	margin-top: 10px;
}
</style>

<body style=" background-image:url(login_UnionStation.jpg); background-size:100%; background-repeat:no-repeat;">


<div  class="inquiryTickets" id="inquiryTickets_frame">
     <a id="return_index"; href="homepage.html" >Back Home</a>

	 </br>
    </br>

     <?php



if( isset($_POST['loginName']) )
{
     $userID = $_POST['loginName'];
} else {
  $userID = $_GET['loginName'];

}
	

			

      echo "<div class=\"item\">
           <div id=\"search_tickets\">
           <input id = but_inquirytickets type=\"button\" onclick=\"window.location.href='inquirytickets.php?loginName=".$userID."'\" name=\"loginName\" value=\"Inquiry Ticket\"/>
           </div>
	  </div>";
	  echo "<div class=\"item\">
           <div id=\"search_tickets\">
           <input id = but_inquirytickets type=\"button\" onclick=\"window.location.href='userorder.php?loginName=".$userID."'\" name=\"loginName\" value=\"Review Order\"/>
           </div>
      </div>";
      ?>



</div>

</body>
</html>