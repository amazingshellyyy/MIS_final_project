<?php
include_once('dbconnect.php');
session_start();
if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		$sql = "DELETE FROM projects_stage WHERE projectId = '$id'";
		$res = mysqli_query($db, $sql) or die("Failed".mysqli_error());
    $sql = "DELETE FROM projects WHERE projectId = '$id'";
    $res = mysqli_query($db, $sql) or die("Failed".mysqli_error());
		if($res){
            echo "<script>
            alert('刪除成功！');
						window.location.href='home.php';
            </script>";

		} else
		{
            echo "<script>
            alert('刪除失敗！');
						window.location.href='home.php';
            </script>";
		}
	}
?>
