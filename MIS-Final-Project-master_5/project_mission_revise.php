<?php
session_start();
require_once 'dbconnect.php';


$res = mysqli_query($db, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow = mysqli_fetch_array($res);

$res = mysqli_query($db, "SELECT * FROM projects WHERE projectId=".$_GET['id']);
$projectRow = mysqli_fetch_array($res);

$postSource = "修改任務區";

$postText = "$userRow[1]在<a href=\"project_home.php?id=$projectRow[0]\">$projectRow[3]</a>修改了任務區";

$sql_post = "INSERT INTO post(postSource,postText,postUserId,postProjectId,postInvolvedMembers)
          VALUES('$postSource','$postText','$userRow[0]','$projectRow[0]','$projectRow[2]')";

mysqli_query($db, $sql_post);


if(isset($_FILES["files"])){
  $errors= array();
  foreach($_FILES["files"]['tmp_name'] as $key => $tmp_name )
  {
    if ($_FILES["files"]['size'][$key]!==0) {
      $file_name = $_FILES["files"]['name'][$key];
      $file_size = $_FILES["files"]['size'][$key];
      $file_tmp = $_FILES["files"]['tmp_name'][$key];
      $file_type = $_FILES["files"]['type'][$key];
      $file_projectId = $projectRow[0];
      $file_userId = $userRow[0];
      $sepext = explode('.', strtolower($_FILES["files"]['name'][$key]));
      $type = end($sepext);       // gets extension

      if($file_size > 2097152)
      {
        $errors[]='檔案大小必須小於 2 MB';
      }

      // new file size in KB
      $new_size = $file_size/1024;

      $desired_dir="uploads";
      if(empty($errors)==true)
      {
        if(is_dir($desired_dir)==false)
        {
          // Create directory if it does not exist
          mkdir("$desired_dir", 0700);
        }
        // if the uploaded file does not exist
        if(file_exists("$desired_dir/".$file_name)==false)
        {
          // move file to folder
          move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
        } else
        {
          // rename the file if another one exist
          $count = 0;
          list($name, $ext) = explode('.', $file_name);
          while(file_exists("$desired_dir/".$file_name))
          {
            $count++;
            $file_name = $name. $count . '.' . $ext;
          }
          move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
        }
        $query="INSERT INTO tbl_uploads(file,type,size,projectId,userId)
                VALUES('$file_name','$type','$new_size','$file_projectId','$file_userId')";
        mysqli_query($db, $query);
      }
      # code...
    }
  }
}

for ($p = 0; $p < $_POST['y'] ; $p++) {
    $project_stage_name = $_POST["project_stage_name$p"];
    $project_stage_name = strip_tags($_POST["project_stage_name$p"]);
    $project_stage_name = htmlspecialchars($project_stage_name);

    $project_stage_start = $_POST["project_stage_start$p"];

    $project_stage_end = $_POST["project_stage_end$p"];

    $project_stageId = $_POST["project_stageId$p"];

    $query_stage = "UPDATE projects_stage SET
                    project_stageStart = '$project_stage_start',
                    project_stageEnd = '$project_stage_end',
                    project_stageName = '$project_stage_name' WHERE projects_stageId =".$project_stageId;
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

              $project_stage_missionId = $_POST["project_stage_missionId$p$i"];


              if(isset($_POST["missionFile$p$i"])){
                $missionFile = $_POST["missionFile$p$i"];
              }else{
                $missionFile = 1;
              }

              // if(isset($_FILES["files$p$i"])){
              //   $errors= array();
              //   foreach($_FILES["files$p$i"]['tmp_name'] as $key => $tmp_name )
              //   {
              //     if ($_FILES["files$p$i"]['size'][$key]!==0) {
              //       $file_name = $_FILES["files$p$i"]['name'][$key];
              //       $file_size = $_FILES["files$p$i"]['size'][$key];
              //       $file_tmp = $_FILES["files$p$i"]['tmp_name'][$key];
              //       $file_type = $_FILES["files$p$i"]['type'][$key];
              //       $file_projectId = $projectRow[0];
              //       $file_userId = $userRow[0];
              //       $sepext = explode('.', strtolower($_FILES["files$p$i"]['name'][$key]));
              //       $type = end($sepext);       // gets extension
              //
              //       if($file_size > 2097152)
              //       {
              //         $errors[]='檔案大小必須小於 2 MB';
              //       }
              //
              //       // new file size in KB
              //       $new_size = $file_size/1024;
              //
              //       $desired_dir="uploads";
              //       if(empty($errors)==true)
              //       {
              //         if(is_dir($desired_dir)==false)
              //         {
              //           // Create directory if it does not exist
              //           mkdir("$desired_dir", 0700);
              //         }
              //         // if the uploaded file does not exist
              //         if(file_exists("$desired_dir/".$file_name)==false)
              //         {
              //           // move file to folder
              //           move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
              //         } else
              //         {
              //           // rename the file if another one exist
              //           $count = 0;
              //           list($name, $ext) = explode('.', $file_name);
              //           while(file_exists("$desired_dir/".$file_name))
              //           {
              //             $count++;
              //             $file_name = $name. $count . '.' . $ext;
              //           }
              //           move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
              //         }
              //         $query="INSERT INTO tbl_uploads(file,type,size,projectId,userId,missionId)
              //                 VALUES('$file_name','$type','$new_size','$file_projectId','$file_userId','$project_stage_missionId')";
              //         mysqli_query($db, $query);
              //       }
              //       # code...
              //     }
              //   }
              // }



              $query_mission = "UPDATE projects_stage_missions SET
                                missionName = '$missionName',
                                missionMembers = '$missionMembers',
                                missionDate = '$missionDate',
                                missionContent = '$missionContent',
                                file_upload = '$missionFile' WHERE missionId = ".$project_stage_missionId;
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

  for ($p = 1; $p <= $_POST['y_new'] ; $p++) {

      $project_stage_name = $_POST["project_stage_name_new$p"];
      $project_stage_name = strip_tags($_POST["project_stage_name_new$p"]);
      $project_stage_name = htmlspecialchars($project_stage_name);

      $project_stage_start = $_POST["project_stage_start_new$p"];

      $project_stage_end = $_POST["project_stage_end_new$p"];

      $query_stage = "INSERT INTO projects_stage(projectId,project_stageStart,project_stageEnd,project_stageName)
                           VALUES('$projectId[0]','$project_stage_start','$project_stage_end','$project_stage_name')";
      $res_stage = mysqli_query($db, $query_stage);

      $res = mysqli_query($db, "SELECT MAX(projects_stageId) FROM projects_stage");
      $projects_stageId = mysqli_fetch_array($res);

      for ($i = 0; $i <= $_POST['x_new'] ; $i++) {
            if (isset($_POST["missionName_new$p$i"])) {

                $missionName = $_POST["missionName_new$p$i"];
               //  $missionName = strip_tags($_POST["missionName$i"]);
               //  $missionName = htmlspecialchars(${"missionName".$i});

                $missionMembers = $_POST["missionMembers_new$p$i"];

                $missionDate = $_POST["missionDate_new$p$i"];

                $missionContent = $_POST["missionContent_new$p$i"];

                if(isset($_POST["missionFile_new$p$i"])){
                  $missionFile = $_POST["missionFile_new$p$i"];
                }else{
                  $missionFile = 0;
                }


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

  for ($i = 1; $i <= $_POST['x_new'] ; $i++) {
    $p = 0;
        if (isset($_POST["missionName_new$p$i"])) {

            $missionName = $_POST["missionName_new$p$i"];
           //  $missionName = strip_tags($_POST["missionName$i"]);
           //  $missionName = htmlspecialchars(${"missionName".$i});

            $missionMembers = $_POST["missionMembers_new$p$i"];

            $missionDate = $_POST["missionDate_new$p$i"];

            $missionContent = $_POST["missionContent_new$p$i"];

            if(isset($_POST["missionFile_new$p$i"])){
              $missionFile = $_POST["missionFile_new$p$i"];
            }else{
              $missionFile = 0;
            }


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

$ppp = $_GET['id'];

echo "<script>
alert('成功');
window.location.href='project_mission.php?id=$ppp';
</script>";
 ?>
