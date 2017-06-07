<?php
session_start();
require_once 'dbconnect.php';
  // require_once 'bar_P.php';

$x = 0;

$y = 0;

$res = mysqli_query($db, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow = mysqli_fetch_array($res);

$res = mysqli_query($db, "SELECT MAX(projectId) FROM projects");
$projectId = mysqli_fetch_array($res);



?>


<!DOCTYPE html>
<html>
<head>
  <title>Project_Creating</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/hover-min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/base/jquery-ui.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="titatoggle-dist.css" >
  <link rel="stylesheet" href="assets/css/PmissionC.css">
  <link rel="stylesheet" type="text/css" href="assets/css/bar_mc.css">



  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type='text/javascript' src='https://code.jquery.com/jquery-1.9.1.min.js'></script>
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
             <li class="button3"><a href="" ></a></li>
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

        <form method="post" action="project_mission_upload.php" action="form-handler" autocomplete="off" id="stage_create">
          <div id="stage">

            <!-- interval setting -->
            <div class="Stage">
              <div class="StageHead">
                <div>
                  <img class="titlepic" src="assets/images/stage.png">
                  <h3 class="title-1">階段目標</h3>
                </div>
                <input type="text" name=<?php echo "project_stage_name$y"; ?> placeholder="區段名稱" maxlength="40" value="" />
                <div class="StageTime">
                  <input id="query2StartDate" type="date" placeholder="開始日期" name=<?php echo "project_stage_start$y"; ?> maxDate="StageEndDate" value="" />
                  <img src="assets/images/arrow.png" class="arrowpng">
                  <input id="query2EndDate" type="date"  placeholder="結束日期" name=<?php echo "project_stage_end$y"; ?> minDate="StageStartDate" value="" />
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
                      <td id="PS1-7"></td>


                    </tr>


                    <tr class="PS-1">
                      <td class="PS1-1">
                        <input id="input1" type="text" name=<?php echo "missionName$y$x"; ?>>
                      </td>
                      <td class="PS1-2">
                        <input id="input1" type="text" value="" name=<?php echo "missionMembers$y$x"; ?>>
                      </td>
                      <td class="PS1-3">
                        <input id="input2" type="date" name=<?php echo "missionDate$y$x"; ?> id="bookdate" placeholder="2014-09-18">
                      </td>
                      <td class="PS1-4"><textarea id="input3" name=<?php echo "missionContent$y$x"; ?> class="form-control" rows="1" placeholder=""></textarea>
                      </td>
                      <td id="PS1-5"></td>
                      <td id="PS1-6"><input type="checkbox" name=<?php echo "missionFile$y$x"; ?> value="1"></td>


                      <td id="PS1-7"><button class="deletebtn"><img src="assets/images/delete.png" class="deletepng"></button></td>
                      <input type="text" style="display:none" name="x" id="x" />
                      <input type="text" style="display:none" name="y" id="y" />
                    </tr>



                  </tbody>

                </table>
                <input type=button value="+ 新增任務 " onClick="x_increase()" class="plus">

              </div>


              <div style="height: 0px;clear: both;"></div>
            </div>

          </div>
        </div>
        <div>
          <input type=button value="+ 新增階段目標" onClick="y_increase()" class="stage_plus">
          <input type=submit name="btn-project_mission_create" value="儲存 " class="save">
        </div>
      </form>
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
      $(this).parent().find("#test").append('<tr class="PS-1"> <td class="PS1-1"> <input id="input1" type="text" name="missionName' + window.y + window.x + '"> </td> <td class="PS1-2"> <input id="input1" type="text" value="" name="missionMembers' + window.y + window.x + '"> </td> <td class="PS1-3"> <input id="input2" type="date" name="missionDate' + window.y + window.x + '" id="bookdate" placeholder="2014-09-18"> </td> <td class="PS1-4"><textarea id="input3" name="missionContent' + window.y + window.x + '" class="form-control" rows="1" placeholder=""></textarea> </td> <td id="PS1-5"></td> <td id="PS1-6"><input type="checkbox" name="missionFile' + window.y + window.x + '" value="1"></td> <td id="PS1-7"><button class="deletebtn"><img src="assets/images/delete.png" class="deletepng"></button></td> </tr>');
    });


    // $(".plus").click(function() {
    //     $("#test").append('<tr class="PS-3"> <td class="PS3-1"><input id="input1" type="text" name="任務名稱"></td> <td class="PS3-2"><input id="input1" type="text" name="參與人員"></td> <td class="PS3-3"><input id="input2" type="date" id="bookdate" placeholder="2014-09-18"></td> <td class="PS3-4">#<input id="input3" type="text" name="標籤" style="height:20px; width:50px;""></td> <td class="PS3-5"><input type="checkbox" name="" value=""></td> </tr>');
    // });

    $(".stage_plus").click(function() {
      $("#stage").append('<div class="Stage"> <div class="StageHead"> <div> <img class="titlepic" src="assets/images/stage.png"> <h3 class="title-1">階段目標</h3> </div> <input type="text" name="project_stage_name' + window.y + '" placeholder="區段名稱" maxlength="40" value="" /> <div class="StageTime"> <input id="query2StartDate" type="date" name="project_stage_start' + window.y + '" maxDate="query2EndDate" value="" /> <img src="assets/images/arrow.png" class="arrowpng"> <input id="query2EndDate" type="date" name="project_stage_end' + window.y + '"minDate="query2StartDate" value="" /> </div> </div> <div class="Assign"> <table class="PAssign"> <table class="mission"> <tbody id="test"> <tr class="PS-1" style="font-weight: 900;font-size: 18px;"> <td class="PS3-1">任務名稱</td> <td class="PS1-2">參與人員</td> <td class="PS1-3">時間</td> <td class="PS1-4">內容</td> <td id="PS3-7">狀態</td> <td id="PS1-6">上傳檔案</td> <td id="PS1-7"></td> </tr>  <tr class="PS-3"> <td class="PS3-1"> <input id="input1" type="text"  name="missionName' + window.y + window.x + '"> </td> <td class="PS3-2"> <input id="input1" type="text" name="missionMembers' + window.y + window.x + '"> </td> <td class="PS3-3"> <input id="input2" name="missionDate' + window.y + window.x + '" type="date" id="bookdate" placeholder="2014-09-18"> </td> <td class="PS3-4"><textarea id="input3" name="missionContent' + window.y + window.x + '" class="form-control" rows="1" placeholder=""></textarea> </td> <td id="PS3-7"></td> <td id="PS3-5"><input type="checkbox" name="missionFile' + window.y + window.x + '" value=""></td><td id="PS1-7"><button class="deletebtn"><img src="assets/images/delete.png" class="deletepng"></button></td> <td id="PS3-6"></td> </tr> </tbody> </table> <input type=button onClick="x_increase()" value="+ 新增任務 " class="plus "> </div> <div style="height: 0px;clear: both;"></div> </div>');
    });
  </script>

  <script type="text/javascript">
        $(document).on("click", ".deletebtn", function() {
      $(this).parent().parent().remove();
    });
      </script>
</body>
</html>
