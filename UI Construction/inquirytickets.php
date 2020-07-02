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
#but_searchtickets {
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

     <form id="inquiryTrain" action="findTrain.php" method="post">
	 </br>
    </br>
        <label>Departure City</label>

     <?php
	include 'connect.php';
	$conn = OpenCon();
	if( isset($_POST['loginName']) )
	{
		 $userid = $_POST['loginName'];
	} else {
	  $userid = $_GET['loginName'];
	
	}    
	
	$result = $conn->query("SELECT DISTINCT City FROM Train_Station");

    echo "<select name='DepartureCity'>";
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            unset($city);
            $city = $row['City'];
            echo '<option value="'.$city.'">'.$city.'</option>';
        }
    echo "</select>";
    } else {
        echo "0 results";
	}

	?>
	</br>
	</br>
	<label for="isarrival">Choose an Arrival City?:</label>
	<input name="isarrival" type="checkbox" value="1"><br>

		<label>Arrival City</label>
		<?php	

    $result2 = $conn->query("SELECT DISTINCT City FROM Train_Station");
    echo "<select name='ArrivalCity'>";
    if (mysqli_num_rows($result2) > 0) {
        while ($row = $result2->fetch_assoc()) {
            unset($city);
            $city = $row['City'];
            echo '<option value="'.$city.'">'.$city.'</option>';
        }
    echo "</select>";
    } else {
        echo "0 results";
	}
	

	?>
	<div>

	 		<label for="departuredate">Choose a date:</label>
			  <input type="date" id="departuredate" name="departuredate" min=
     <?php
         echo date('Y-m-d');
     ?> 
     max=
     <?php
         echo date("Y-m-d",strtotime("+2 week"));
     ?> 
	 >
	</div>


	<select name="datecondition">
  <option value=">=">Earlier Than Select Date</option>
  <option value="<=">Later Than Select Date</option>
  <option value="=">Exact Day</option>
</select><br>




    <input name="loginName" type="hidden" value="<?php echo $userid; ?>">

      <div class="item">
           <div id="search_tickets">
           <input type="submit" name="button" id="but_searchtickets" value="Search"/>
           </div>
      </div>


  </form>
<?php

  echo "<form id=\"return_index\" action=\"index0.php\" method=\"post\">

    <input name=\"loginName\" type=\"hidden\" value=\"$userid\">
    <input type=\"submit\" name=\"back_button\" id=\"button_back\" value=\"Back to Main Menu\"/>
	 </form>"
	 ?>

</div>
</body>
</html>