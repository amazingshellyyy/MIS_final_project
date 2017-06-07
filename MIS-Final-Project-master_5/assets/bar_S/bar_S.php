<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

     <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
     <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
     <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
     <link href="titatoggle-dist.css" rel="stylesheet">
     <link rel="stylesheet" href="bar_S.css">

    <script type='text/javascript' src='https://code.jquery.com/jquery-1.9.1.min.js'></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<!-- childbar -->
    <div>
        <ul class="nav_area2">
        <div style="position:absolute;left:10px;top:0px;">
        <a href="/cart/search_file.php"><img src="assets/images/logoorg-04.png" class="logoimg"></a>

                <li class="button2"><a href="">個人收藏</a></li>
                <li class="button2"><a href="">交易紀錄</a></li>
                <li class="button2"><a href="">代幣管理</a></li>
                <li class="button2"><a href="">好康相報</a></li>


                <div class="srchall">
                    <form action="/cart/public/index.php" method="GET">

                      <input type="text" name="query" class="srchbox" placeholder="搜尋.."/>
                      <input type="image" src="assets/images/srchicon.png" class="goicon" disabled/>

                    </form>
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
                              <div class="userName"><?php echo userRow[1]?></div>
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
                <a href="">首頁</a>
              </div>
              <div class="button">
                <a data-toggle="collapse" href="#collapse2">我的專案</a>

                      <div id="collapse2" class="panel-collapse collapse">

                          <ul>
                              <li class="button3"><a href="" >進行中</a></li>
                              <li class="button3"><a href="" >已完成</a></li>
                          </ul>

                      </div>
              </div>
              <div class="button">
                <a href="">個人行事曆</a>
              </div>
              <div class="button">
                <a href="">檔案總管</a>
              </div>
              <div class="button">
                <a href="cart/search_file.php">分享市集</a>
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

<!-- 原本的功能 -->
<script type="text/javascript">
$(document).ready(
  function(){
    $('input:image').attr('disabled',true);
    $('input:text').change(
      function(){
        if ($(this).val()){
          $('input:image').removeAttr('disabled');
        }
        else {
          $('input:image').attr('disabled',true);
        }
      });
    });
    </script>


</body>
</html>
