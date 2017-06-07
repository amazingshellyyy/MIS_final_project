<?php
	require_once 'dbconnect.php';

	$id = $_POST['events_id'];

	$res = mysqli_query($db, "SELECT * FROM events WHERE id=".$id);
	$eventsRow = mysqli_fetch_array($res);

if (isset($_POST['btn-revise'])) {


	$title = $_POST["title"];
	$place = $_POST["place"];
	$from = $_POST["from"];
	$events_id = $_POST["events_id"];
	$today = date("Y-m-d");
	if (isset($_POST['members'])) {
		$members = $_POST['members'];
	}
	$projects_id = $_POST['projects_id'];

	$query = "UPDATE events SET
	title = '$title',
	date = '$from',
	place = '$place',
	members = '$members' WHERE id =".$events_id;
	$res = mysqli_query($db, $query);

	if (isset($_POST['members'])) {
		echo "<script>
		window.location.href='project_calendar.php?id=$eventsRow[7]';
		</script>";
	}else{
		echo "<script>
		window.location.href='personal_calendar.php';
		</script>";
	}
}


?>
