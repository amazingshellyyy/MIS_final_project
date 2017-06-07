<?php
	session_start();
	require_once 'dbconnect.php';

	 if (isset($_GET['id'])) {
		 $res = mysqli_query($db, "SELECT * FROM projects WHERE projectId=".$_GET['id']);
		 $projectRow = mysqli_fetch_array($res);
	 }

	$res = mysqli_query($db, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow = mysqli_fetch_array($res);

	$sel = $_GET['sel']; //=0 delete =1 create
	$today=date("Y-m-d");

	if($sel==1){
		$date = $_GET['date'];

		$title = $_GET['data']; //=1 event title
/****************************************/
		if (isset($_GET['id'])) {
			$sql ="INSERT INTO events(title,date,created,userId,projectId)
						VALUES('$title','$date','$today','$userRow[0]','$projectRow[0]')";

			$postSource = "專案行事曆";
			$postText = "$userRow[1]在<a href=\"project_home.php?id=$projectRow[0]\">$projectRow[3]</a>新增了一項事件";
		  $post_sql ="INSERT INTO post(postSource,postText,postUserId,postProjectId,postInvolvedMembers)
						      VALUES('$postSource','$postText','$userRow[0]','$projectRow[0]','$projectRow[2]')";
			mysqli_query($db,$post_sql);						
		}else{
			$sql ="INSERT INTO events(title,date,created,userId)
						VALUES('$title','$date','$today','$userRow[0]')";

		} //userid projectid 寫死 從前面傳進來
/*******************************************/
		mysqli_query($db,$sql)or die ("無法新增".mysqli_error()); //執行sql語法
		if (isset($_GET['id'])) {
			echo "<script>
			window.location.href='project_calendar.php?id=$projectRow[0]';
			</script>";
		}else{
			echo "<script>
			window.location.href='personal_calendar.php';
			</script>";
	}
	}
	else{
		$eventID = $_GET['data']; //=0 id
		$sql = "DELETE FROM events WHERE id=$eventID";
		mysqli_query($db,$sql)or die ("無法刪除".mysql_error()); //執行sql語法
		if (isset($_GET['id'])) {
			echo "<script>
			window.location.href='project_calendar.php?id=$projectRow[0]';
			</script>";
		}else{
			echo "<script>
			window.location.href='personal_calendar.php';
			</script>";
	}
	}

?>
