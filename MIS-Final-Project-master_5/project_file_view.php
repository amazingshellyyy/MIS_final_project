<?php
include_once 'dbconnect.php';
$res = mysqli_query($db, "SELECT * FROM projects WHERE projectId=".$_GET['id']);
$projectRow = mysqli_fetch_array($res);

echo $projectRow[3];
?>
<!DOCTYPE html>
<html>
<head>
  <script src="http://www.w3schools.com/lib/w3data.js"></script>
</head>
<body>
    <br>
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
    <a href="project_home.php?id=<?php echo $_GET['id']; ?>">專案首頁</a><br>
    <a href="project_file.php?id=<?php echo $_GET['id']; ?>">回上傳檔案頁面</a>
</body>
<script>
w3Http("customers.php", function () {
  if (this.readyState == 4 && this.status == 200) {
    var myObject = JSON.parse(this.responseText);
    w3DisplayData("id01", myObject);
  }
});

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
</script>
</html>
