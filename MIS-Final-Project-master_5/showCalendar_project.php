<?php
	session_start();
	require_once 'dbconnect.php';

	$res = mysqli_query($db, "SELECT * FROM projects WHERE projectId=".$_GET['id']);
	$projectRow = mysqli_fetch_array($res);

	$res = mysqli_query($db, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow = mysqli_fetch_array($res);

	$month_leap=array("31","29","31","30","31","30","31","31","30","31","30","31"); //潤
	$month=array("31","28","31","30","31","30","31","31","30","31","30","31");
	$now_month=$_GET['month'];
	function get_chinese_weekday($datetime){ //拿這天是星期幾
	    $weekday  = date('w', strtotime($datetime));
	    $weeklist = array('0', '1', '2', '3', '4', '5', '6');
	    return $weeklist[$weekday];
	}

	$today=date("d");
	$today_Year=date("Y");
	$today_Month=date("m");

	echo'<table class="cal" border="1">';


	$slice = explode("-",$now_month);
	$Myear = $slice[0];
	$Mmonth = $slice[1];

 // 	if ((西元年分是400的倍數)或(西元年分是4的倍數但不是100的倍數)){
 //    		閏年
 // 	}else{
 //     	平年
 // 	}

 	if($Myear%400==0||($Myear%4==0&&$Myear%100!=0)){
 		$limit=$month_leap[$Mmonth-1];
 	}
 	else{
 		$limit=$month[$Mmonth-1];
 	}
	$count_date=1;
	$first_date_weekday=get_chinese_weekday($now_month.'-1');



	echo '<tr><td class="week" value="0">SUN</td><td class="week" value="0">MON</td><td class="week" value="0">TUE</td><td class="week" value="0">WED</td><td class="week" value="0">THU</td><td class="week" value="0">FRI</td><td class="week" value="0">SAT</td></tr><tr>';
	for ($i=0; $i <$first_date_weekday ; $i++) {
		echo '<td class="valid" value="0">
		<div class="date">&nbsp</div>
		<div class="mission">&nbsp</div></td>';
	}

	$next_row=$first_date_weekday;
	for($i=1;$i<=$limit;$i++){

		echo '<td class="valid" value="'.$i.'"><div class="date">'.$i.'</div>';

		$sql = "SELECT title,id,date,(SELECT COUNT(*) FROM events where date='$now_month-$i' and projectId='$projectRow[0]')as c from events where date='$now_month-$i' and projectId='$projectRow[0]'"; //id寫死從前面傳
		$result=mysqli_query($db,$sql);
		$eventCount=0;
		while($row=mysqli_fetch_assoc($result)){
			if($row["c"]>3&&$eventCount==2){
				$c = $row["c"]-2;
				echo'<div><a class="moreEvents" value="'.$i.'">more + '.$c.'</a></div>';
				break;
			}
			else{
				echo'<div class="mission" value="'.$row["id"].'/'.$i.'">'.$row["title"].'</div>';
			}
			$eventCount++;
		}

		echo '</td>';
		$next_row++;
		if($next_row>6){
			$next_row=0;
			echo '</tr><tr>';
		}
	}
	// for($i=$first_date_weekday;$i<7;$i++){
	// 	$mission=aaaaaa;
	// 	$id=111; //from db
	// 	echo '<td class="valid" value="'.$count_date.'"><div class="date">'.$count_date.'</div>
	// 			<div class="mission" value="'.$id.'/'.$count_date.'">'.$mission.'</div></td>';
	// 	$count_date++;

	// }
	// echo '</tr>';

	// echo '<tr>';
	// $next_row=0;
	// for($i=$count_date;$i<=$limit;$i++){
	// 	$mission=vbbbb;
	// 	$id=222; //from db
	// 	echo '<td class="valid" value="'.$count_date.'"><div class="date">'.$count_date.'</div>
	// 	<div class="mission" style="background-color:#ddd;overflow:hidden;" value="'.$id.'/'.$count_date.'"">'.$mission.'</div>
	// 			<div class="mission" style="background-color:#aaa;" value="'.$id.'/'.$count_date.'"">'.$mission.'</div>
	// 			<div class="mission" style="background-color:#eee;" value="'.$id.'/'.$count_date.'"">'.$mission.'</div></td>';
	// 	$count_date++;
	// 	$next_row++;
	// 	if($next_row>6){
	// 		$next_row=0;
	// 		echo '</tr><tr>';
	// 	}
	// }
	if($next_row!=0){
		for($j=$next_row;$j<7;$j++){	//補尾巴空格
			echo '<td class="valid" value="0">
				<div class="date">&nbsp</div>
				<div class="mission">&nbsp</div></td>';
		}
	}


	echo '</tr></table>';
?>
