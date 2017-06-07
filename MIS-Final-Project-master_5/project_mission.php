<?php
session_start();
require_once 'dbconnect.php';
require_once 'bar_P.php';

$x = 0;

$y = 0;

$res = mysqli_query($db, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow = mysqli_fetch_array($res);

$res = mysqli_query($db, "SELECT projectId FROM projects WHERE projectId=".$_GET['id']);
$projectId = mysqli_fetch_array($res);

$res = mysqli_query($db, "SELECT min(projects_stageId) FROM projects_stage WHERE projectId =".$projectId[0]);
$Firstprojects_stageId = mysqli_fetch_array($res);

$res = mysqli_query($db, "SELECT COUNT(projects_stageId) FROM projects_stage WHERE projectId=".$projectId[0]);
$Countprojects_stageId = mysqli_fetch_array($res);

$res = mysqli_query($db, "SELECT project_stageName FROM projects_stage WHERE projectId=".$projectId[0]);
$project_stageName = array();
for ($i = 0; $i < mysqli_num_rows($res); $i++) {
  $project_stageName[] = mysqli_result($res,$i,0);
}

$res = mysqli_query($db, "SELECT project_stageStart FROM projects_stage WHERE projectId=".$projectId[0]);
$project_stageStart = array();
for ($i = 0; $i < mysqli_num_rows($res); $i++) {
  $project_stageStart[] = mysqli_result($res,$i,0);
}

$res = mysqli_query($db, "SELECT project_stageEnd FROM projects_stage WHERE projectId=".$projectId[0]);
$project_stageEnd = array();
for ($i = 0; $i < mysqli_num_rows($res); $i++) {
  $project_stageEnd[] = mysqli_result($res,$i,0);
}

for ($mc = 0; $mc < $Countprojects_stageId[0]; $mc ++) {
  $psd = $Firstprojects_stageId[0] + $mc;
  $res = mysqli_query($db, "SELECT COUNT(missionId) FROM projects_stage_missions WHERE projects_stageId=".$psd);
  $countms = mysqli_fetch_array($res);
  $temp = $countms[0];
  global $count;
  $count[$mc] = $temp;

}




echo $count[0];



?>

<!DOCTYPE html>
<html>
<head>
  <title>Project Index</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/hover-min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="assets/css/Pmission.css">

  <script src="assets/js/jquery-3.1.1.min.js"></script>
  <!--選取日期-->
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script>
  <script type="text/javascript" src="assets/js/PAssign.js"></script>
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

      <link rel="shortcut icon" href="favicon.ico">
      <link rel="stylesheet" type="text/css" href="assets/css/component.css" />
      <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
    </head>
    <body onload="loadValues();">
      <form method="post" action="project_mission_revise.php?id=<?php echo $projectId[0]; ?>" action="form-handler" enctype="multipart/form-data" autocomplete="off" id="stage_create">

          <?php for ($i = 0; $i < $Countprojects_stageId[0]; $i++) {   ?>

          <!-- interval setting -->
          <div class="Stage">
            <div class="StageHead">
              <div>
                <img class="titlepic" src="assets/images/stage.png">
                <h3 class="title-1">階段目標</h3>
              </div>

              <input type="text" name=<?php echo "project_stage_name$i"; ?> placeholder="區段名稱" maxlength="40" value=<?php echo $project_stageName[$i]; ?> />
              <div class="StageTime">
                <input id="query2StartDate" type="date" placeholder="開始日期" name=<?php echo "project_stage_start$i"; ?> maxDate="StageEndDate" value=<?php echo $project_stageStart[$i]; ?> />
                <img src="assets/images/arrow.png" class="arrowpng">
                <input id="query2EndDate" type="date"  placeholder="結束日期" name=<?php echo "project_stage_end$i"; ?> minDate="StageStartDate" value=<?php echo $project_stageEnd[$i]; ?> />
                <input type="text" style="display:none" name=<?php echo "project_stageId$i"; ?> value=<?php echo $Firstprojects_stageId[0] + $i; ?> />

              </div>
            </div>
            <div class="Assign">
              <table class="mission">
                <tbody id="test">
                  <tr class="PS-1" style="font-weight: 900;font-size: 18px;">
                    <td class="PS1-1">任務名稱</td>
                    <td class="PS1-2">參與人員</td>
                    <td class="PS1-3">時間</td>
                    <td class="PS1-4">內容</td>
                    <td id="PS1-5">狀態</td>
                    <td id="PS1-6">上傳檔案</td>
                    <td>刪除檔案</td>


                  </tr>

                  <?php for ($mc = 0; $mc < $count[$i] ; $mc ++) {
                    $project_stageId = $Firstprojects_stageId[0] + $i;


                    $res = mysqli_query($db, "SELECT missionName FROM projects_stage_missions WHERE projects_stageId=".$project_stageId);
                    $missionName = array();
                    for ($tt = 0; $tt < mysqli_num_rows($res); $tt++) {
                      $missionName[] = mysqli_result($res,$tt,0);
                    }

                    $res = mysqli_query($db, "SELECT missionMembers FROM projects_stage_missions WHERE projects_stageId=".$project_stageId);
                    $missionMembers = array();
                    for ($tt = 0; $tt < mysqli_num_rows($res); $tt++) {
                      $missionMembers[] = mysqli_result($res,$tt,0);
                    }

                    $res = mysqli_query($db, "SELECT missionDate FROM projects_stage_missions WHERE projects_stageId=".$project_stageId);
                    $missionDate = array();
                    for ($tt = 0; $tt < mysqli_num_rows($res); $tt++) {
                      $missionDate[] = mysqli_result($res,$tt,0);
                    }

                    $res = mysqli_query($db, "SELECT missionContent FROM projects_stage_missions WHERE projects_stageId=".$project_stageId);
                    $missionContent = array();
                    for ($tt = 0; $tt < mysqli_num_rows($res); $tt++) {
                      $missionContent[] = mysqli_result($res,$tt,0);
                    }

                    $res = mysqli_query($db, "SELECT missionId FROM projects_stage_missions WHERE projects_stageId=".$project_stageId);
                    $missionId = array();
                    for ($tt = 0; $tt < mysqli_num_rows($res); $tt++) {
                      $missionId[] = mysqli_result($res,$tt,0);
                    }

                    $res = mysqli_query($db, "SELECT file_upload FROM projects_stage_missions WHERE projects_stageId=".$project_stageId);
                    $mission_file = array();
                    for ($tt = 0; $tt < mysqli_num_rows($res); $tt++) {
                      $mission_file[] = mysqli_result($res,$tt,0);
                    }
                    ?>
                    <tr class="PS-1">
                      <td class="PS1-1">
                        <h4 class="show1"><?php echo $missionName[$mc]; ?></h4>
                        <input class="input1" style="display: none" class="input1" type="text" name=<?php echo "missionName$i$mc"; ?> value=<?php echo $missionName[$mc]; ?>>
                      </td>
                      <td class="PS1-2">
                        <h4 class="show2"><?php echo $missionMembers[$mc]; ?></h4>
                        <input class="input2" style="display: none" class="input1" type="text" value="<?php echo $missionMembers[$mc]; ?>" name=<?php echo "missionMembers$i$mc"; ?>>
                      </td>
                      <td class="PS1-3">
                        <h4 class="show3"><?php echo $missionDate[$mc]; ?></h4>
                        <input class="input3" style="display: none" class="input2" type="date" name=<?php echo "missionDate$i$mc"; ?> value=<?php echo $missionDate[$mc]; ?> id="bookdate" placeholder="2014-09-18">
                      </td>
                      <td class="PS1-4">
                        <h4 class="show4"><?php echo $missionContent[$mc];?></h4>
                        <textarea class="input4" style="display: none" class="input3" name=<?php echo "missionContent$i$mc"; ?> value=<?php echo $missionContent[$mc];?> class="form-control" rows="1"><?php echo $missionContent[$mc];?></textarea>
                      </td>
                      <td id="PS1-5">未完成</td>



                      <?php if ($mission_file[$mc]==1) {
                        ?>
                        <td id="PS1-6">
                          <input type="file" name='files[]' id="file-5" class="inputfile inputfile-4" data-multiple-caption="{count} files selected" multiple />
                          <label for="file-5">
                          <figure><img src="assets/images/upload.png"></figure>
                          <span>Upload</span>
                          </label>
                        </td>

                        <script src="assets/js/custom-file-input.js"></script>
                        <?php
                      } ?>
                      <td id="PS1-7"><button  class="deletebtn"><img src="assets/images/delete.png" class="deletepng"></button>
                        <?php
                        $query="SELECT * FROM tbl_uploads WHERE projectId=".$_GET['id'];
                        $res=mysqli_query($db, $query);
                        while($row=mysqli_fetch_array($res)){
                          ?><a href="project_file_delete.php?del=<?php echo $row['file'] ?>&id=<?php echo $row['id'] ?>&projectId=<?php echo $_GET['id']; ?>">刪除檔案</a><?php
                        }

                         ?>
                      </td>


                      <input type="text" style="display:none" name=<?php echo "project_stage_missionId$i$mc"; ?> value=<?php echo $missionId[$mc]; ?> />
                      <input type="text" style="display:none" name="x_new" id="x" />
                      <input type="text" style="display:none" name="y_new" id="y" />
                      <input type="text" style="display:none" name=<?php echo "project_stageId$i$mc"; ?> value=<?php echo $project_stageId; ?> />
                      <input type="text" style="display:none" name="x" value=<?php echo $count[$i]; ?> />
                      <input type="text" style="display:none" name="y" value=<?php echo $Countprojects_stageId[0]; ?> />
                    </tr>
                    <?php }; ?>

                  </tbody>
                </table>
                <button class="set" type = "button" id="btn1"><img src="assets/images/Picon/icon-edit.png" class="icon2">編輯</button>
                <button class="set" type = "button" id="btn2" style="display: none"><img src="assets/images/Picon/icon-cancel.png" class="icon2">取消</button>
                <button class="set" type = "summit" id="btn3" style="display: none"><img src="assets/images/Picon/icon-confirm.png" class="icon2">儲存</button>

              </div>
            </div>
            <?php } ?>
            <!-- <div class="save">
              <input type=submit name="btn-project_mission_create" value="儲存 " class="savebtn">
            </div> -->
          </form>

          <!-- </div> -->
          <div style="height: 0px;clear: both;"></div>
          <!-- </div> -->

        </div>
      </div>
      <div>
        <!-- <input type=button value="+ 新增階段目標" onClick="y_increase()" class="stage_plus"> -->
      </div>
      <!--期間-->
      <script type="text/javascript">

      $(document).ready(function(){
          $("#btn1").click(function(){

              $(".show1").hide();
              $(".input1").show();
              $(".show2").hide();
              $(".input2").show();
              $(".show3").hide();
              $(".input3").show();
              $(".show4").hide();
              $(".input4").show();
              $("#btn1").hide();
              $("#btn2").show();
              $("#btn3").show();
          });
          $("#btn2").click(function(){
            $(".show1").show();
            $(".input1").hide();
            $(".show2").show();
            $(".input2").hide();
            $(".show3").show();
            $(".input3").hide();
            $(".show4").show();
            $(".input4").hide();
            $("#btn1").show();
            $("#btn2").hide();
            $("#btn3").hide();
          });

      });


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
      <!--新增-->
      <script type="text/javascript">

        var x = 0;
        var y = 0;
        function x_increase() {
          window.x = window.x + 1;
          document.getElementById("x").value = window.x;
        }
        function y_increase() {
          window.y = window.y + 1;
          document.getElementById("y").value = window.y;
        }
        function loadValues(){
          document.getElementById("x").value = window.x;
      //alert(document.getElementById("hiddenVal").value);
    }
    $(document).on("click", ".adddoc", function() {
      $(this).parent().append('<input class="up" type="file" value="" name="FILE">');
    });

    $(document).on("click", ".plus", function() {
      $(this).parent().find("#test").append('<tr class="PS-3"> <td class="PS3-1"> <input id="input1" class="input1" type="text" value="' + window.y + window.x + '" name="missionName_new' + window.y + window.x + '"> </td> <td class="PS3-2"> <input class="input1" type="text" name="missionMembers_new' + window.y + window.x + '"> </td> <td class="PS3-3"> <input class="input2" type="date" id="bookdate" name="missionDate_new' + window.y + window.x + '" placeholder="2014-09-18"> </td>  <td class="PS3-4"><textarea class="input3" class="form-control" rows="1" name="missionContent_new'+ window.y + window.x + '" placeholder=""></textarea></td><td id="PS3-7"></td><td id="PS3-5"><input type="checkbox" name="missionFile_new' + window.x +  '" value=""></td><td></td><td id="PS3-6"></td> </tr>');
    });


    // $(".plus").click(function() {
    //     $("#test").append('<tr class="PS-3"> <td class="PS3-1"><input id="input1" type="text" name="任務名稱"></td> <td class="PS3-2"><input id="input1" type="text" name="參與人員"></td> <td class="PS3-3"><input id="input2" type="date" id="bookdate" placeholder="2014-09-18"></td> <td class="PS3-4">#<input id="input3" type="text" name="標籤" style="height:20px; width:50px;""></td> <td class="PS3-5"><input type="checkbox" name="" value=""></td> </tr>');
    // });

    $(".stage_plus").click(function() {
      $("#stage").append('<div class="Stage"> <div class="StageName"> <h2>階段目標</h2> <br> <div class="StageTime"> <nobr> <input type="text" name="project_stage_name_new' + window.y + '" placeholder="區段名稱" maxlength="40" value="" /> <br> <input id="query2StartDate" type="date" name="project_stage_start_new' + window.y + '" maxDate="query2EndDate" value="" /> <br> ~ <br> <input id="query2EndDate" type="date" name="project_stage_end_new' + window.y + '"minDate="query2StartDate" value="" /> </nobr> </div> </div> <div class="Assign"> <table class="PAssign"> <tbody id="test"> <tr class="PS-3" style="font-weight: 900;font-size: 18px;"> <td class="PS3-1">任務名稱</td> <td class="PS3-2">參與人員</td> <td class="PS3-3">時間</td> <td class="PS3-4">內容</td> <td id="PS3-7">狀態</td> <td id="PS3-5">提醒</td> <td>刪除檔案</td> <td id="PS3-6">上傳檔案</td> </tr> <tr class="PS-3"> <td class="PS3-1">開會討論</td> <td class="PS3-2">黃晨浩<br>吳紹瑜<br>許旆旟<br>鄭韶葳<br>鄭俊彥</td> <td class="PS3-3">2016/09/20</td> <td class="PS3-4">內容</td> <td id="PS3-7">未完成</td> <td id="PS3-5"> <input type="checkbox" name="" value=""> </td> <td id="PS3-7"><input type="checkbox" name="" value="">會計學報告</td> <td id="PS3-6"> </td> </tr> <tr class="PS-3"> <td class="PS3-1"> <input class="input1" type="text"  name="missionName_new' + window.y + window.x + '"> </td> <td class="PS3-2"> <input class="input1" type="text" name="missionMembers_new' + window.y + window.x + '"> </td> <td class="PS3-3"> <input class="input2" name="missionDate_new' + window.y + window.x + '" type="date" id="bookdate" placeholder="2014-09-18"> </td> <td class="PS3-4"><textarea class="input3" name="missionContent_new' + window.y + window.x + '" class="form-control" rows="1" placeholder=""></textarea> </td> <td id="PS3-7"></td> <td id="PS3-5"><input type="checkbox"  name="missionFile_new' + window.y + window.x + '" value=""></td> <td id="PS3-6"></td> </tr> </tbody> </table> <input type=button onClick="x_increase()" value="+ 新增任務 " class="plus "> <input type=submit value="儲存 " name="btn-project_mission_create" class="save "> <input type=button value="編輯 " class="edit "> </div> <div style="height: 0px;clear: both;"></div> </div>');
    });
  </script>
</body>
</html>
