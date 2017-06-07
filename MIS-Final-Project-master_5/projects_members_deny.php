<?php
  session_start();
  require_once 'dbconnect.php';

  $res = mysqli_query($db, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
  $userRow = mysqli_fetch_array($res);
  $projectId = $_GET['id'];

  if (empty($userRow[9])) {
    $userRow[9] = $projectId;
  }else{
    $userRow[9] = $userRow[9].",".$projectId;//<--這邊有問題
  }

  $query = "UPDATE users SET
           user_projectId_invited = '$userRow[9]' WHERE userId =".$_SESSION['user'];
  $res = mysqli_query($db, $query);

  $res_2 = mysqli_query($db, "SELECT projectMembersId FROM projects WHERE projectId=".$_GET['id']);
  $projectMembersRow = mysqli_fetch_array($res_2);

  echo $projectMembersRow[0];
  $project_membersRow = explode(",",$projectMembersRow[0]);
  print_r($project_membersRow);
  $key = array_search($_SESSION['user'],$project_membersRow);
  echo $key;
  unset($project_membersRow[$key]);
  $project_members = implode(",",$project_membersRow);

  $query = "UPDATE projects SET
           projectMembersId = '$project_members' WHERE projectId =".$projectId;
  $res_2 = mysqli_query($db, $query);


  if($res&&$res_2){
    echo "<script>
    alert('刪除成功！');
    window.location.href='home.php';
    </script>";

  }else{
    echo "<script>
    alert('刪除失敗！');
    window.location.href='home.php';
    </script>";
  }
 ?>
