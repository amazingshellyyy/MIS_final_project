
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
<html>
<head>
  <title></title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="titatoggle-dist.css" rel="stylesheet">
  <link rel="stylesheet" href="bar_P.css">


  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type='text/javascript' src='https://code.jquery.com/jquery-1.9.1.min.js'></script>





  <style>body,html{margin: 0 !important; height: 100% !important;}</style>
</head>
<body>
  <!-- childbar -->
  <div>
    <ul class="nav_area2">
      <div style="position:absolute;left:10px;top:0px;">
        <a href="home.php"><img src="assets/images/logo-04.png" class="logoimg"></a>
        <li class="button2" style="border-bottom:none;">&nbsp</li>
        <?php
        if (isset($_GET['id'])) {?>
          <li class="button2"><a href="project_home.php?id=<?php echo $_GET['id']; ?>">專案首頁</a></li>
          <li class="button2"><a href="project_mission.php?id=<?php echo $_GET['id']; ?>">任務區</a></li>
          <li class="button2"><a href="project_calendar.php?id=<?php echo $_GET['id']; ?>">專案行事曆</a></li>
          <li class="button2"><a href="project_message.php?id=<?php echo $_GET['id']; ?>">討論區</a></li>
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
      </div>
      <button class="c-hamburger c-hamburger--htra" onclick="openNav()">
        <span >&#9776;</span>
      </button>
    </ul>
  </div>

  <div class="w3-overlay"  id="myOverlay" style="cursor:pointer;display:none;" ></div>
  <!-- mainbar -->
  <div class="w3-animate-right" id="mwt_mwt_slider_scroll" style="display:none;">

    <div id="mwt_slider_content" >
      <div >


        <div class="user">
          <div style="top:20px;position:relative;height:82px;left:10px;">
            <div class="circle"></div>
            <div style="margin-left:10px;height:80px;float:left;position:relative;">
              <div class="userName"><?php echo $userRow[1]; ?></div>
              <div class="userCoin">$<?php echo $userRow[9]; ?></div>
            </div>
            <a href="personaldata.php"><img class="edit" src="assets/images/editicon.png" ></a>
          </div>
          <a href="logout.php?logout"><img class="logout" src="assets/images/logout.png" ></a>


        </div>

        <hr class="line3"></hr>
      </div>
      <div  class="nav_area" id="accordion">
        <div class="button">
          <!-- <img class="icon" src="assets/images/Picon/Piconw-home.png"> -->
          <a href="project_home.php?id=<?php echo $_GET['id']; ?>">專案首頁</a>
        </div>
        <div class="button">
          <!-- <img class="icon" src="assets/images/Picon/Piconw-pj.png"> -->
          <a data-toggle="collapse" href="#collapse2">我的專案</a>

          <div id="collapse2" class="panel-collapse collapse">
            <!-- <div class="panel-body"> -->
            <ul>
              <li class="button3"><a href="#" >進行中</a></li>
              <?php
              for($i = 0; $i < count($projectNameRow); $i++){
                echo "<li class='button4'><a href=\"project_home.php?id=$projectIdRow[$i]\">$projectNameRow[$i]</a><br>";
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
          <!-- <img class="icon" src="assets/images/Picon/Piconw-pjc.png"> -->
          <a href="project_creating.php">創建專案</a>
        </div>
        <div class="button">
          <!-- <img class="icon" src="assets/images/Picon/Piconw-cale.png"> -->
          <a href="personal_calendar.php">個人行事曆</a>
        </div>
        <div class="button">
          <!-- <img class="icon" src="assets/images/Picon/Piconw-file.png"> -->
          <a href="/cart/file_manager.php">檔案總管</a>
        </div>
        <div class="button">
          <!-- <img class="icon" src="assets/images/Picon/Piconw-home.png"> -->
          <a href="/cart/search_file.php">分享市集</a>
        </div>
      </div>


    </div>
  </div>
  <!-- animation click main bar -->
  <script>
  function openNav() {
    if(document.getElementById("mwt_mwt_slider_scroll").style.display=="none"){
      document.getElementById("mwt_mwt_slider_scroll").style.display = "block";
    }
    else{
      document.getElementById("mwt_mwt_slider_scroll").style.display = "none";
    }

    if(document.getElementById("myOverlay").style.display=="none"){
      document.getElementById("myOverlay").style.display = "block";
    }
    else{
      document.getElementById("myOverlay").style.display = "none";
    }
  }

  </script>

  <!-- animation hamburger btn    -->
  <script type="text/javascript">(function() {

    "use strict";

    var toggles = document.querySelectorAll(".c-hamburger");

    for (var i = toggles.length - 1; i >= 0; i--) {
      var toggle = toggles[i];
      toggleHandler(toggle);
    };

    function toggleHandler(toggle) {
      toggle.addEventListener( "click", function(e) {
        e.preventDefault();
        (this.classList.contains("is-active") === true) ? this.classList.remove("is-active") : this.classList.add("is-active");
      });
    }

  })();</script>



</body>
</html>
