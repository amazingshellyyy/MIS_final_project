<?php
require_once 'dbconnect.php';
	session_start();
	$res = mysqli_query($db, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow = mysqli_fetch_array($res);

	$date = $_GET["date"];
	$userId = $_GET["userId"];

	$sql = "SELECT title,id,date,(SELECT COUNT(*) FROM events where date='$date' and userId=$userRow[0])as c from events where date='$date' and userId=$userRow[0]"; //id寫死 id從前面傳

	$result=mysqli_query($db,$sql);
	echo '<table class="cal">';
	while($row=mysqli_fetch_assoc($result)){

		echo'<tr><td><div class="mission" value="'.$row["id"].'/'.''.'">'.$row["title"].'</div></td></tr>';
	}
	echo '</table>';
?>
