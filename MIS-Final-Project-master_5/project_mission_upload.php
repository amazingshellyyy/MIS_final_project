<?php
session_start();
require_once 'dbconnect.php';

$res = mysqli_query($db, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow = mysqli_fetch_array($res);

$res = mysqli_query($db, "SELECT MAX(projectId) FROM projects");
$projectId = mysqli_fetch_array($res);




for ($p = 0; $p <= $_POST['y'] ; $p++) {

  $project_stage_name = $_POST["project_stage_name$p"];
  $project_stage_name = strip_tags($_POST["project_stage_name$p"]);
  $project_stage_name = htmlspecialchars($project_stage_name);

  $project_stage_start = $_POST["project_stage_start$p"];

  $project_stage_end = $_POST["project_stage_end$p"];

  $query_stage = "INSERT INTO projects_stage(projectId,project_stageStart,project_stageEnd,project_stageName)
                       VALUES('$projectId[0]','$project_stage_start','$project_stage_end','$project_stage_name')";
  $res_stage = mysqli_query($db, $query_stage);

  $res = mysqli_query($db, "SELECT MAX(projects_stageId) FROM projects_stage");
  $projects_stageId = mysqli_fetch_array($res);

  for ($i = 0; $i <= $_POST['x'] ; $i++) {
        if (isset($_POST["missionName$p$i"])) {

            $missionName = $_POST["missionName$p$i"];
           //  $missionName = strip_tags($_POST["missionName$i"]);
           //  $missionName = htmlspecialchars(${"missionName".$i});

            $missionMembers = $_POST["missionMembers$p$i"];

            $missionDate = $_POST["missionDate$p$i"];

            $missionContent = $_POST["missionContent$p$i"];

            $missionFile = 1;

            $stageId = $projects_stageId[0];

            $query_mission = "INSERT INTO projects_stage_missions(projects_stageId,missionName,missionMembers,missionDate,missionContent,file_upload)
                                   VALUES('$stageId','$missionName','$missionMembers','$missionDate','$missionContent','$missionFile')";
            $res_mission = mysqli_query($db, $query_mission);

            unset($missionName);
            unset($missionMembers);
            unset($missionDate);
            unset($missionContent);
            unset($missionFile);
        }
  }
  unset($project_stage_name);
  unset($project_stage_start);
  unset($project_stage_end);
  unset($projects_stageId);

}
echo "<script>
alert('成功');
window.location.href='project_home.php?id=$projectId[0]';
</script>";
 ?>
