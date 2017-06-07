<?php
include_once('dbconnect.php');

if(isset($_GET['Com_id']))
	{
    $Pro_id = $_GET['Pro_id'];
		$Com_id = $_GET['Com_id'];
		$sql = "DELETE FROM subcomment WHERE ComId = '$Com_id'";
		$res = mysqli_query($db, $sql) or die("Failed".mysqli_error());
		$sql = "DELETE FROM comment WHERE ComId = '$Com_id'";
		$res = mysqli_query($db, $sql) or die("Failed".mysqli_error());
		if($res){
            echo "<script>
            alert('刪除成功！');
						window.location.href='project_message.php?id=$Pro_id';
            </script>";

		} else
		{
            echo "<script>
            alert('刪除失敗！');
						window.location.href='project_message.php?id=$Pro_id';
            </script>";
		}
	}
?>
