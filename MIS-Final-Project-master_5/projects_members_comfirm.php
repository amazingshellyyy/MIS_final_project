<?php
  session_start();
  require_once 'dbconnect.php';

  $res = mysqli_query($db, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
  $userRow = mysqli_fetch_array($res);

  $res = mysqli_query($db, "SELECT * FROM projects WHERE projectId=".$_GET['id']);
  $projectRow = mysqli_fetch_array($res);

  $projectId = $_GET['id'];


  if (empty($userRow[9])) {
    $userRow[9] = $projectId;
  }else{
    $userRow[9] = $userRow[9].",".$projectId;
  }

  $query = "UPDATE users SET
           user_projectId_invited = '$userRow[9]' WHERE userId =".$_SESSION['user'];
  $res = mysqli_query($db, $query);

  if($res){
    echo "<script>
    alert('加入成功！');
    window.location.href='home.php';
    </script>";

  }else{
    echo "<script>
    alert('加入失敗！');
    window.location.href='home.php';
    </script>";
  }
  function mysqli_result($res,$row=0,$col=0){
  $numrows = mysqli_num_rows($res);
  if ($numrows && $row <= ($numrows-1) && $row >=0){
      mysqli_data_seek($res,$row);
      $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
      if (isset($resrow[$col])){
          return $resrow[$col];
      }
  }
  return false;
  }
 ?>
