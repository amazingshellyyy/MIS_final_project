<?php
 //此功能存在一個bug ： 資料庫必須內建好一個project之後才不會有錯誤產生。
ob_start();
session_start();
require_once 'dbconnect.php';
 //如果非登入狀態將導回首頁
if (!isset($_SESSION['user'])) {
 header("Location: index.php");
 exit;
}

$error = false;

if (isset($_POST['btn-project_create'])) {
     //排除不合規定之name及passwords
 $project_creatorId = $_POST['project_creatorId'];

 $project_name = strip_tags($_POST['project_name']);
 $project_name = htmlspecialchars($project_name);

 $project_class = strip_tags($_POST['project_class']);
 $project_class = htmlspecialchars($project_class);

 $project_teacher = strip_tags($_POST['project_teacher']);
 $project_teacher = htmlspecialchars($project_teacher);

 $project_creattime = $_POST['project_creattime'];

 $project_deadline = $_POST['project_deadline'];

 $project_Id = $_POST['project_Id'];

    //  $project_stage_name_1 = $_POST['project_stage_name_1'];
    //  $project_stage_name_1 = strip_tags($_POST['project_stage_name_1']);
    //  $project_stage_name_1 = htmlspecialchars($project_stage_name_1);
     //
    //  $project_stage_start_1 = $_POST['project_stage_start_1'];
    //  $project_stage_end_1 = $_POST['project_stage_end_1'];
     //
    //  $project_stage_name_2 = $_POST['project_stage_name_2'];
    //  $project_stage_name_2 = strip_tags($_POST['project_stage_name_2']);
    //  $project_stage_name_2 = htmlspecialchars($project_stage_name_2);
     //
    //  $project_stage_start_2 = $_POST['project_stage_start_2'];
    //  $project_stage_end_2 = $_POST['project_stage_end_2'];
     //
    //  $project_stage_name_3 = $_POST['project_stage_name_3'];
    //  $project_stage_name_3 = strip_tags($_POST['project_stage_name_3']);
    //  $project_stage_name_3 = htmlspecialchars($project_stage_name_3);
     //
    //  $project_stage_start_3 = $_POST['project_stage_start_3'];
    //  $project_stage_end_3 = $_POST['project_stage_end_3'];

 $project_member = $_POST['project_member'];
 $project_member = trim($project_member);

 if (empty($project_name)) {
     $error = true;
     $project_nameError = "請輸入專案名稱";
 }

 if (empty($project_class)) {
     $error = true;
     $project_classError = "請輸入課程(活動)名稱";
 }

 if (empty($project_teacher)){
     $error = true;
     $project_teacherError = "請輸入指導老師";
 }

 if (!$error) {
     $query = "INSERT INTO projects(projectCreatorId,projectMembersId,projectName,projectClassName,projectTeacher,projectCreatetime,projectDeadline)
     VALUES('$project_creatorId','$project_member','$project_name','$project_class','$project_teacher','$project_creattime','$project_deadline')";
     $res = mysqli_query($db, $query);

        //  $query_stage = "INSERT INTO projects_stage(projectId,project_stageStart,project_stageEnd,project_stageName)
        //                  VALUES('$project_Id','$project_stage_start_1','$project_stage_end_1','$project_stage_name_1')";
        //  $res_stage = mysqli_query($db, $query_stage);
         //
        //  $query_stage = "INSERT INTO projects_stage(projectId,project_stageStart,project_stageEnd,project_stageName)
        //                  VALUES('$project_Id','$project_stage_start_2','$project_stage_end_2','$project_stage_name_2')";
        //  $res_stage = mysqli_query($db, $query_stage);
         //
        //  $query_stage = "INSERT INTO projects_stage(projectId,project_stageStart,project_stageEnd,project_stageName)
        //                  VALUES('$project_Id','$project_stage_start_3','$project_stage_end_3','$project_stage_name_3')";
        //  $res_stage = mysqli_query($db, $query_stage);

     if ($res) {
         $errTyp = "success";
         $errMSG = "創建成功";
         unset($project_creatorId);
         unset($project_name);
         unset($project_class);
         unset($project_teacher);
         unset($project_creattime);
         unset($project_deadline);
         unset($project_Id);
         unset($project_stage_name_1);
         unset($project_stage_name_2);
         unset($project_stage_name_3);
         unset($project_stage_start_1);
         unset($project_stage_end_1);
         unset($project_stage_start_2);
         unset($project_stage_end_2);
         unset($project_stage_start_3);
         unset($project_stage_end_3);

     } else {
         $errTyp = "danger";
         $errMSG = "創建失敗";
     }
 }
 echo "<script>
 window.location.href='project_mission_creating.php';
</script>";
}

 //抓取登入之帳戶資料
$res = mysqli_query($db, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow = mysqli_fetch_array($res);

$query_projects = mysqli_query($db, "SELECT MAX(projectId) FROM projects WHERE projectCreatorId=".$_SESSION['user']);
$projectRow = mysqli_fetch_array($query_projects);



?>

<!DOCTYPE html>
<html>
<head>
    <title>創建專案</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/hover-min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="titatoggle-dist.css">
    <link rel="stylesheet" href="assets/css/bar_pc.css">
    <link rel="stylesheet" href="assets/css/PCreate.css">


    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <!--選取日期-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.5.2.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type='text/javascript' src='https://code.jquery.com/jquery-1.9.1.min.js'></script>
    <script type="text/javascript">
        $(function() {
        // 預設顯示第一個 Tab
        var _showTab = 0;
        var $defaultLi = $('ul.tabs li').eq(_showTab).addClass('active');
        $('.tab_content').eq($defaultLi.index()).siblings().hide();

        // 當 li 頁籤被點擊時...
        // 若要改成滑鼠移到 li 頁籤就切換時, 把 click 改成 mouseover
        $('ul.tabs li').mouseover(function() {
            // 找出 li 中的超連結 href(#id)
            var $this = $(this),
            _index = $this.index();
            // 把目前點擊到的 li 頁籤加上 .active
            // 並把兄弟元素中有 .active 的都移除 class
            $this.addClass('active').siblings('.active').removeClass('active');
            // 淡入相對應的內容並隱藏兄弟元素
            $('.tab_content').eq(_index).stop(false, true).fadeIn().siblings().hide();

            return false;
        }).find('a').focus(function() {
            this.blur();
        });
    });
</script>
<script type="text/javascript" src="assets/css/PSet.js"></script>
</head>
<body>
  <!-- childbar -->
  <div>
    <div class="nav_area2">

        <a href="home.php"><img src="assets/images/logo-04.png" class="logoimg"></a>

    </div>
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

<div id="tab0" class="content">
    <div class="head">
      <img src="assets/images/Picon/Piconb-pjc.png" class="icon">
      <h2 class="title">創建專案</h2>
      <img src="assets/images/tablepic.png" class="tablepic">
  </div>
  <table id="PSetting">
    <tbody>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" action="form-handler" autocomplete="off" id="project_create">
        <input type="hidden" name="project_creatorId" value="<?php echo $userRow[0]; ?>">
        <input type="hidden" name="project_Id" value="<?php echo $projectRow[0]+1; ?>">

        <tr class="PS-1">
            <td class="PS1-1">專案名稱</td>
            <td class="PS1-2">
                <input type="text" name="project_name" placeholder="請輸入專案名稱" maxlength="40" value="" />
                <?php if (isset($project_nameError)){echo $project_nameError.'<br>';} ?>
            </tr>

            <tr class="PS-1">
                <td class="PS1-1">課程名稱（或活動名稱）</td>
                <td class="PS1-2">
                    <input type="text" name="project_class" placeholder="請輸入課程(活動)名稱" maxlength="40" value="" />
                    <?php if (isset($project_classError)){echo $project_classError.'<br>';} ?>
                </tr>

                <tr class="PS-1">
                    <td class="PS1-1">參與人員</td>
                    <td class="PS1-2">
                        <input type="text" name="project_member" placeholder="請輸入組員信箱" value="" />
                    </tr>

                    <tr class="PS-1">
                        <td class="PS1-1">授課老師</td>
                        <td class="PS1-2">
                            <input type="text" name="project_teacher" placeholder="請輸入指導老師" maxlength="40" value="" />
                            <?php if (isset($project_teacherError)){echo $project_teacherError.'<br>';} ?>
                        </tr>

                        <input type="hidden" name="project_creattime" value="<?php echo date('Y/m/d', time())?>">

                        <tr class="PS-1">
                            <td class="PS1-1">到期期限</td>
                            <td class="PS1-2">
                                <input type="date" name="project_deadline" maxlength="40" value="" />
                            </tr>


                            <?php
                            if (isset($errMSG)) {
                             ?>
                             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
                                 <?php echo $errMSG; ?>
                                 <?php
                             }
                             ?>
                         </tbody>

                     </table>
                     <button class="creatbtn" type="submit" name="btn-project_create">創立<img src="assets/images/Picon/icon-create.png" class="icon2"></button>
                 </form>


             </div>
             <script type="text/javascript">
    $(".timeline").on("mouseenter mouseleave", function (event) { //挷定滑鼠進入及離開事件
      if (event.type == "mouseenter") {
        $(this).css({"overflow-x": "scroll"}); //滑鼠進入
    } else {
        $(this).scrollTop(0).css({"overflow-x": "hidden"}); //滑鼠離開
    }
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('input[name$="Date"]').datepicker({
            dateFormat: 'yy/mm/dd',
            beforeShow: function() {
                if ($(this).attr('maxDate')) {
                    var dateItem = $('#' + $(this).attr('maxDate'));
                    if (dateItem.val() !== "") {
                        $(this).datepicker('option', 'maxDate', dateItem.val());
                    }
                }
                if ($(this).attr('minDate')) {
                    var dateItem = $('#' + $(this).attr('minDate'));
                    if (dateItem.val() !== "") {
                        $(this).datepicker('option', 'minDate', dateItem.val());
                    }
                }
            }
        });
    });
</script>
</body>
</html>

<?php ob_end_flush(); ?>
