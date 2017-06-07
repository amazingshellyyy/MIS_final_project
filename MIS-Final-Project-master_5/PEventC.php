<?php
session_start();
require_once 'dbconnect.php';
require_once 'bar_P.php';
$sel = $_GET["sel"];
	if($sel==1){ //新增
		$result = array('id' =>"0" ,'title'=>"",'date'=>$_GET["date"] );
	}
	else{ //修改
		$id = $_GET["id"];
		$sql = "SELECT * from events where id=$id"; //id寫死 id從前面傳
		$result=mysqli_fetch_assoc(mysqli_query($db,$sql));
	}

	$res = mysqli_query($db, "SELECT * FROM events WHERE id=".$id);
	$eventsRow = mysqli_fetch_array($res);
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="/resources/demos/style.css">
		<link rel="stylesheet" href="titatoggle-dist.css">
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
		<link rel="stylesheet" href="assets/css/EventC.css">

		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src='https://code.jquery.com/jquery-1.9.1.min.js'></script>
		<script src="//code.jquery.com/jquery-1.9.1.js"></script>
		<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

		<script>
			$(function() {
				$( "#from" ).datepicker({
					defaultDate: "+1w",
					changeMonth: true,
					changeYear: true,
      dateFormat: 'yy-mm-dd', //sql不支援原本的format
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
      	$( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
  });
				$( "#to" ).datepicker({
					defaultDate: "+1w",
					changeMonth: true,
					changeYear: true,
      dateFormat: 'yy-mm-dd', //sql不支援原本的format
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
      	$( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
  });
			});
		</script>




	</head>
	<body>
		<div class="content">
			<div class="head">
				<img src="assets/images/Picon/Picon-event.png" class="icon">
				<h2 class="title">專案事件</h2>
				<img src="assets/images/tablepic.png" class="tablepic">
			</div>
			<table class="EventSet">
				<tbody>
					<form method="POST" action="editEventFunction.php">
						<tr class="PS-1">
							<td class="PS1-1">事件名稱</td>
							<td class="PS1-2"><input type="text" name="title" value=<?php echo $eventsRow[1];?>></td>

						</tr>
						<tr class="PS-1">
							<td class="PS1-1">地點</td>
							<td class="PS1-2" ><input type="text" name="place" value=<?php echo $eventsRow[8];?>></td>

							</tr>

							<tr class="PS-1">
								<td class="PS1-1">活動時間</td>
								<td class="PS1-2">

									<!-- <div  class="EventTime" for="from">從</div> -->
									<!-- datepicker 塞值不知怎麼塞直接給input text value是錯的 -->
									<input class="EventTime"  type="text" id="from" name="from" value=<?php echo $eventsRow[2];//有開始沒結束?>>
									<!-- <div  class="EventTime" for="to">到</div>
									<input class="EventTime"  type="text" id="to" name="to" value=<> -->
								</td>
							</tr>
							<tr class="PS-1">
								<td class="PS1-1">參與人員</td>
								<td class="PS1-2">
									<input  class="bl" type="text" id="members" name="members" value=<?php echo $eventsRow[9];?>>
								</td>
							</tr>
							<tr class="PS-1">
								<td class="PS1-1" >tagColor</td>
								<td class="PS1-2">
									<button class="colortag colortagA"></button>
									<button class="colortag colortagB"></button>
									<button class="colortag colortagC"></button>
									<button class="colortag colortagD"></button>
									<button class="colortag colortagE"></button>
									<button class="colortag colortagF"></button>
								</td>
							</tr>
							<input type="hidden" name="sel" value=<?php echo $sel; ?>>
							<input type="hidden" name="events_id" value=<?php echo $eventsRow[0]; ?>>
							<input type="hidden" name="projects_id" value=<?php echo $id; ?>>


						</tbody>
					</table>
					<button  type="submit" name="btn-revise"  class="set">儲存<img src="assets/images/Picon/icon-confirm.png" class="icon2"></button>
					<button id="memberbutton2"  type="button" class="set">取消<img src="assets/images/Picon/icon-cancel.png" class="icon2"></button>
				</form>
			</div>
		</body>
		</html>
