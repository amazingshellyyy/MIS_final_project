<?php
if(isset($_GET['id'])){
  $res = mysqli_query($db, "SELECT * FROM projects WHERE projectId=".$_GET['id']);
  $projectRow = mysqli_fetch_array($res);

  $res = mysqli_query($db, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
  $userRow = mysqli_fetch_array($res);
}
$res = mysqli_query($db, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow = mysqli_fetch_array($res);

$res = mysqli_query($db, "SELECT projectName FROM projects WHERE projectCreatorId=".$userRow[0]);
$projectNameRow = array();
for ($i = 0; $i < mysqli_num_rows($res); $i++) {
  $projectNameRow[] = mysqli_result($res,$i,0);
}

$res = mysqli_query($db, "SELECT projectId FROM projects WHERE projectCreatorId=".$userRow[0]);
$projectIdRow = array();
for ($i = 0; $i < mysqli_num_rows($res); $i++) {
  $projectIdRow[] = mysqli_result($res,$i,0);
}

$res = mysqli_query($db, "SELECT projectCreatorId FROM projects WHERE projectCreatorId=".$userRow[0]);
$projectCreatorIdRow = array();
for ($i = 0; $i < mysqli_num_rows($res); $i++) {
  $projectCreatorIdRow[] = mysqli_result($res,$i,0);
}


$res = mysqli_query($db, "SELECT projectName FROM projects WHERE (projectMembersId LIKE '%$userRow[2]%')");
$projectNameRow_members = array();
for ($i = 0; $i < mysqli_num_rows($res); $i++) {
  $projectNameRow_members[] = mysqli_result($res,$i,0);
}

$res = mysqli_query($db, "SELECT projectId FROM projects WHERE (projectMembersId LIKE '%$userRow[2]%')");
$projectIdRow_members = array();
for($i = 0; $i < mysqli_num_rows($res); $i++){
  $projectIdRow_members[] = mysqli_result($res,$i,0);
}

$res = mysqli_query($db, "SELECT postText FROM post WHERE (postInvolvedMembers LIKE '%$userRow[2]%') AND postUserId!=".$userRow[0]);
$postText = array();
for($i = 0; $i < mysqli_num_rows($res); $i++){
  $postText[] = mysqli_result($res,$i,0);
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
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Case</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type='text/javascript' src='https://code.jquery.com/jquery-1.9.1.min.js'></script>
    <link rel="stylesheet" href="bar.css">
   
</head>

<body>
    <!-- childbar -->
    <div>
        <ul class="nav_area2">
        <a href="home.php" class="logo" ><img src="assets/images/logo-04.png" width="150" ></a>
            
            <?php
              if (isset($_GET['id'])) {?>

                <li class="button2"><a href="project_mission.php?id=<?php echo $_GET['id']; ?>">任務區</a></li>
                <li class="button2"><a href="project_calender.php?id=<?php echo $_GET['id']; ?>">專案行事曆</a></li>
                <li class="button2"><a href="project_message.php?id=<?php echo $_GET['id']; ?>">留言板</a></li>
            <?php
            }
            if(isset($_GET['id'])){
              if ($userRow[0] == $projectRow[1]){
                ?>
                <li class="button2"><a href="project_setting.php?id=<?php echo $_GET['id']; ?>">專案設定</a></li>
                <li class="button2"><a href="project_delete.php?id=<?php echo $_GET['id']; ?>">刪除專案</a></li>
                <?php
              }
            }
            ?>
        </ul>
    </div>
    

    <!-- mainbar -->
    <div id="mwt_mwt_slider_scroll">

        <div id="mwt_slider_content">
            <div scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:100%;" allowTransparency="true">

                    <div class="circle circle1"></div>

                        <div  class="nav_area" id="accordion">
                            <div class="button">

                                <a data-toggle="collapse" href="#collapse2">我的專案</a>

                                <div id="collapse2" class="panel-collapse collapse">
                                    <!-- <div class="panel-body"> -->
                                        <ul>
                                            <li class="button3"><a href="" >進行中</a></li>
                                            <?php
                                            for($i = 0; $i < count($projectNameRow); $i++){
                                               echo "<li class='button3'><a href=\"project_home.php?id=$projectIdRow[$i]\">$projectNameRow[$i]</a><br>";
                                            }
                                            for($i = 0; $i < count($projectNameRow_members); $i++){
                                               echo "<a href=\"project_home.php?id=$projectIdRow_members[$i]\">$projectNameRow_members[$i]</a><br>";
                                               if (stristr($userRow[9],$projectIdRow_members[$i])==false) {
                                               ?>
                                               <form action="projects_members_comfirm.php?id=<?php echo $projectIdRow_members[$i]?>" method="post">
                                                 <input type="submit" name="projects_members_confirm" value="確認">
                                               </form>
                                               <form action="projects_members_deny.php?id=<?php echo $projectIdRow_members[$i]?>" method="post">
                                                 <input type="submit" name="projects_members_deny" value="拒絕">
                                               </form>
                                               <?php
                                              }
                                            }
                                             ?>
                                            <li class="button3"><a href="" >已完成</a></li>
                                        </ul>
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class="button">

                                <a href="#collapse6">個人行事曆</a>

                            </div>
                            <div class="button">

                                <a href="todolist.php">待辦清單</a>

                            </div>
                            <div class="button">

                                <a href="personaldata.php">個人設定</a>

                            </div>
                            <div class="button">

                                <a href="#collapse8">檔案總管</a>

                            </div>
                            <div class="button">

                                <a href="project_creating.php">創建專案</a>

                            </div>
                            <div class="button">

                                <a href="logout.php?logout">登出</a>

                            </div>
                        </div>

                    <hr class="line3"></hr>

            </div>
        </div>
    </div>

</body>

</html>
