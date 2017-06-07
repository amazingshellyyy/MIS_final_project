<?php
	require_once 'dbconnect.php';
	$sel = $_GET["sel"];
	if($sel==1){ //新增
		$result = array('id' =>"0" ,'title'=>"",'date'=>$_GET["date"] );
	}
	else{ //修改
		$id = $_GET["id"];
		$sql = "SELECT * from events where id=$id"; //id寫死 id從前面傳
		$result=mysqli_fetch_assoc(mysqli_query($db,$sql));
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="editEvent.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
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
				<form method="POST" action="editEventFunction.php">
				<div class="blank">
					<div class="title bl">Eventname</div>
					<input class="bl" type="text" name="title" value=<?php echo $result["title"]?>>
				</div>
				<div class="blank">
				<div class="title bl">Place</div>
					<input class="bl"  type="text" name="palce" value=<?php //no place?>>
					
				</div>
				
				<div>
					<div class="title bl">活動時間</div>
					<div  class="bll" for="from">從</div>
					<!-- datepicker 塞值不知怎麼塞直接給input text value是錯的 -->
					<input class="bl"  type="text" id="from" name="from" value=<?php echo $result["date"] //有開始沒結束?>>
					<div  class="bll" for="to">到</div>
					<input class="bl"  type="text" id="to" name="to">
					
				</div>
				<div class="blank">
					<div class="title bl" >參與人員</div>
					<input  class="bl" type="" value=<?php //哪裡撈QQ?>>
					
				</div>
				<div class="blank">
					<div class="title bl" >tagColor</div>
					<div class="colortag"></div>
					<div class="colortag"></div>
					<div class="colortag"></div>
					<div class="colortag"></div>
					<div class="colortag"></div>
					<div class="colortag"></div>
					
				</div>
				<input type="hidden" name="sel" value=<?php echo $sel; ?>>
				<input type="hidden" name="id" value=<?php echo $result["id"]; ?>>
				<input type="submit" name="" value="儲存">
				</form>
				
</body>
</html>

