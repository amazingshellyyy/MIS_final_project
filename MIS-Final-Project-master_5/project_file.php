<?php
include_once 'dbconnect.php';
session_start();
ob_start();

$res = mysqli_query($db, "SELECT * FROM projects WHERE projectId=".$_GET['id']);
$projectRow = mysqli_fetch_array($res);

echo $projectRow[3];

if (!isset($_SESSION['user'])) {
		header("Location: index.php");
		exit;
}

$res = mysqli_query($db, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow = mysqli_fetch_array($res);

?>
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.0.js"></script>
</head>
<body>
	檔案上傳<br>
		<form action="project_file_upload.php" method="post" enctype="multipart/form-data">
		  <input type="file" name="files[]" id="file" data-multiple-caption="{count} files selected" multiple />
			<input type="hidden" name="project_Id" value="<?php echo $_GET['id']; ?>">
			<input type="hidden" name="user_Id" value="<?php echo $userRow[0]; ?>">
			<label for="file"></label><br>
			<input type="submit" value="Upload" disabled />
		</form>
    <input class="w3-input w3-border w3-padding" type="text" placeholder="搜尋" id="myInput" onkeyup="myFunction()">
    <table id="id01">
      <tr>
        <th>檔案名稱</th>
        <th>檔案類型</th>
        <th>檔案大小(KB)</th>
        <th>上傳者</th>
        <th>瀏覽</th>
        <th>刪除</th>
      </tr>
      <?php
      $query="SELECT * FROM tbl_uploads WHERE projectId=".$_GET['id'];
      $res=mysqli_query($db, $query);
      while($row=mysqli_fetch_array($res))
      {
        ?>
        <tr>
          <td><?php echo $row['file'] ?></td>
          <td><?php echo $row['type'] ?></td>
          <td><?php echo $row['size'] ?></td>
          <td>
            <?php
              $query = "SELECT userName FROM users WHERE userId=".$row['userId'];
              $userName = mysqli_fetch_array(mysqli_query($db, $query));
              echo $userName[0];
            ?>
          </td>
          <td><a href="uploads/<?php echo $row['file'] ?>" target="_blank">瀏覽檔案</a></td>
          <td><a href="project_file_delete.php?del=<?php echo $row['file'] ?>&id=<?php echo $row['id'] ?>&projectId=<?php echo $_GET['id']; ?>">刪除檔案</a></td>
        </tr>
        <?php
      }
      // if ($_POST['sort'] == 'name')
      // {
      //   $query .= " ORDER BY file";
      // }
      // elseif ($_POST['sort'] == 'type')
      // {
      //   $query .= " ORDER BY type";
      // }
      // elseif ($_POST['sort'] == 'size')
      // {
      //   $query .= " ORDER BY size";
      // }
      ?>
    </table>
		<script type="text/javascript">
		function myFunction() {
		  var input, filter, table, tr, td, i;
		  input = document.getElementById("myInput");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("id01");
		  tr = table.getElementsByTagName("tr");
		  for (i = 0; i < tr.length; i++) {
		    td = tr[i].getElementsByTagName("td")[0];
		    if (td) {
		      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
		        tr[i].style.display = "";
		      } else {
		        tr[i].style.display = "none";
		      }
		    }
		  }
		}

		$(document).ready(
			function(){
				$('input:submit').attr('disabled',true);
				$('input:file').change(
					function(){
						if ($(this).val()){
							$('input:submit').removeAttr('disabled');
						}
						else {
							$('input:submit').attr('disabled',true);
						}
					});
				});
		</script>
		<script src="js/custom-file-input.js"></script>
		<a href="project_home.php?id=<?php echo $_GET['id']; ?>">專案首頁</a>
</body>
</html>
<?php ob_end_flush(); ?>
