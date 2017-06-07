<?php
include_once 'dbconnect.php';
session_start();
ob_start();


if (!isset($_SESSION['user'])) {
	header("Location: index.php");
	exit;
}

$res = mysqli_query($db, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow = mysqli_fetch_array($res);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.0.js"></script>
	<link rel="stylesheet" href="/Ssearch/assets/css/SSearch.css">
	<link rel="stylesheet" href="/assets/css/cartSideNav.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	    <meta charset="utf-8">
	     <meta name="viewport" content="width=device-width, initial-scale=1">
	     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


	     <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	     <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	     <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	     <link rel="stylesheet" href="/resources/demos/style.css">
	     <link href="titatoggle-dist.css" rel="stylesheet">
	     <link rel="stylesheet" href="bar_S.css">


	    <script type='text/javascript' src='https://code.jquery.com/jquery-1.9.1.min.js'></script>
	    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>

	<img class="cartLogo" src="/Ssearch/images/logoorg-04.png" />
	<form action="/cart/public/index.php" method="GET" >
		<input type="text" name="query" class="homeSearch" placeholder="搜尋.."/>
		<input type="image" src="/assets/images/srchicon.png" class="homeGo" disabled/>
	</form>
	<button class="c-hamburger c-hamburger--htra" onclick="openNav()">
					<span >&#9776;</span>
	</button>
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
										<a href="personaldata.php"><img class="edit" src="editicon.png" ></a>
							</div>
							<a href="logout.php?logout"><img class="logout" src="logout.png" ></a>


					</div>

					<hr class="line3"></hr>
				</div>
				<div  class="nav_area" id="accordion">
					<div class="button">
						<a href="/">首頁</a>
					</div>

					<div class="button">
						<a href="/personal_calendar.php">個人行事曆</a>
					</div>
					<div class="button">
						<a href="/cart/file_manager.php">檔案總管</a>
					</div>
					<div class="button">
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
			<?php ob_end_flush(); ?>
