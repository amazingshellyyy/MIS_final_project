<?php
ob_start();
session_start();
require_once 'dbconnect.php';
include("bar_P.php");
$res = mysqli_query($db, "SELECT * FROM projects WHERE projectId=".$_GET['id']);
$projectRow = mysqli_fetch_array($res);
 //如果非登入狀態將導回首頁
if (!isset($_SESSION['user'])) {
   header("Location: index.php");
   exit;
}
$error = false;
$res = mysqli_query($db, "SELECT projects_stageId FROM projects_stage WHERE projectId=".$_GET['id']);
$projects_stageId = array();
for ($i = 0; $i < mysqli_num_rows($res); $i++) {
 $projects_stageId[] = mysqli_result($res,$i,0);
}
if (isset($_POST['btn-project_create'])) {
     //排除不合規定之name及passwords
   $project_creatorId = $_POST['project_creatorId'];
   $project_name = strip_tags($_POST['project_name']);
   $project_name = htmlspecialchars($project_name);
   $project_class = strip_tags($_POST['project_class']);
   $project_class = htmlspecialchars($project_class);
   $project_teacher = strip_tags($_POST['project_teacher']);
   $project_teacher = htmlspecialchars($project_teacher);
   $project_deadline = $_POST['project_deadline'];
   $project_Id = $_GET['id'];
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
       $query = "UPDATE projects SET
       projectName = '$project_name',
       projectClassName = '$project_class',
       projectTeacher = '$project_teacher',
       projectDeadline = '$project_deadline' WHERE projectId =".$_GET['id'];
       $res_projects = mysqli_query($db, $query);
       $res_stage = mysqli_query($db, $query);
       if ($res_projects&&$res_stage) {
           $errTyp = "success";
           $errMSG = "更新成功";
           unset($project_creatorId);
           unset($project_name);
           unset($project_class);
           unset($project_teacher);
           unset($project_creattime);
           unset($project_deadline);
           unset($project_Id);
       } else {
           $errTyp = "danger";
           $errMSG = "更新失敗";
       }
   }
}
 //抓取登入之帳戶資料
$res = mysqli_query($db, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow = mysqli_fetch_array($res);
$query_projects = mysqli_query($db, "SELECT * FROM projects WHERE projectId=".$_GET['id']);
$projectRow = mysqli_fetch_array($query_projects);
$res = mysqli_query($db, "SELECT project_stageStart FROM projects_stage WHERE projectId=".$_GET['id']);
$project_stageStartRow = array();
for ($i = 0; $i < mysqli_num_rows($res); $i++) {
 $project_stageStartRow[] = mysqli_result($res,$i,0);
}
$res = mysqli_query($db, "SELECT project_stageEnd FROM projects_stage WHERE projectId=".$_GET['id']);
$project_stageEndRow = array();
for ($i = 0; $i < mysqli_num_rows($res); $i++) {
 $project_stageEndRow[] = mysqli_result($res,$i,0);
}
$res = mysqli_query($db, "SELECT project_stageName FROM projects_stage WHERE projectId=".$_GET['id']);
$project_stageNameRow = array();
for ($i = 0; $i < mysqli_num_rows($res); $i++) {
 $project_stageNameRow[] = mysqli_result($res,$i,0);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Project_Setting</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/hover-min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <!--選取日期-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.5.2.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/PSet.css">
    <script type="text/javascript" src="assets/css/PSet.js"></script>
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
</head>
<div id="tab0" class="content">
  <div class="head">
    <img src="assets/images/Picon/Picon-set.png" class="icon">
    <h2 class="title">專案設定</h2>
    <img src="assets/images/tablepic.png" class="tablepic">
</div>
<table id="PSetting">
 <tbody>
    <form method="post" action="project_setting.php?id=<?php echo $_GET['id']; ?>" action="form-handler" autocomplete="off" id="project_setting">
        <tr class="PS-1">
           <td class="PS1-1">專案名稱</td>
           <td class="PS1-2">
            <h5 id="setname1"><?php echo $projectRow[3]; ?></h5>
            <input id="setname2" style="display:none" type="text" name="project_name" placeholder="請輸入專案名稱" maxlength="40" value="<?php echo $projectRow[3]; ?>" /></td>
            <?php if (isset($project_nameError)){echo $project_nameError.'<br>';} ?>
        </tr>
        <tr class="PS-1">
           <td class="PS1-1">課程名稱（或活動名稱）</td>
           <td class="PS1-2">
            <h5 id="setclass1"><?php echo $projectRow[4]; ?></h5>
            <input id="setclass2" style="display:none" type="text" name="project_class" placeholder="請輸入課程(活動)名稱" maxlength="40" value="<?php echo $projectRow[4]; ?>" /></td>
            <?php if (isset($project_classError)){echo $project_classError.'<br>';} ?>
        </tr>
        <tr class="PS-1">
           <td class="PS1-1">授課老師</td>
           <td class="PS1-2">
            <h5 id="setteacher1"><?php echo $projectRow[5]; ?></h5>
            <input id="setteacher2" style="display:none" type="text" name="project_teacher" placeholder="請輸入指導老師" maxlength="40" value="<?php echo $projectRow[5]; ?>" />
        </td>
        <?php if (isset($project_teacherError)){echo $project_teacherError.'<br>';} ?>
    </tr>
    <tr class="PS-1">
       <td class="PS1-1">參與人員</td>
       <td class="PS1-2">
          <h5 id="setmember1">Tom,Tina</h5>
          <input id="setmember2" style="display:none" type="text" value = "Tom,Tina" name="參與人員">
      </td>
  </tr>
  <tr class="PS-1">
   <td class="PS1-1">到期期限</td>
   <td class="PS1-2">
    <h5 id="settime1"><?php echo $projectRow[7]; ?></h5>
    <input id="settime2" style="display:none" type="date" name="project_deadline" maxlength="40" value="<?php echo $projectRow[7]; ?>" /></td>
</tr>
</tbody>
</table>
<button id="setbutton1" type="button" class="set">修改<img src="assets/images/Picon/icon-edit.png" class="icon2"></button>
<button id="setbutton3" class="set" name="btn-project_create" style="display:none" type="submit">確認<img src="assets/images/Picon/icon-confirm.png" class="icon2"></button>
<button id="setbutton2" class="set" style="display:none" type="button">取消<img src="assets/images/Picon/icon-cancel.png" class="icon2"></button>

</div>

</form>


</div>


<script type="text/javascript">
$(".timeline").on("mouseenter mouseleave", function(event) { //挷定滑鼠進入及離開事件
    if (event.type == "mouseenter") {
        $(this).css({
            "overflow-x": "scroll"
        }); //滑鼠進入
    } else {
        $(this).scrollTop(0).css({
            "overflow-x": "hidden"
        }); //滑鼠離開
    }
});
</script>
<!--期間-->
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
