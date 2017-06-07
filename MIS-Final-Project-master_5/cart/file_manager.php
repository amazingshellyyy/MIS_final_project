<?php
include_once 'dbconnect.php';
// include_once '../bar_PS.php';
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
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/assets/css/MFile.css">
	<link rel="stylesheet" href="/assets/css/bar_file.css">
	<link rel="stylesheet" href="/assets/css/SScore.css">
	<link rel="stylesheet" href="/assets/css/SCreate.css">
	<link rel="stylesheet" href="/assets/css/hover-min.css">
	<link rel="stylesheet" href="/assets/css/bootstrap.css">
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/titatoggle-dist.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="/assets/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/assets/js/SScore.js"></script>
	<script type="text/javascript" src="/assets/js/SCreate.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

	<script type="text/javascript">
		$(function(){
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
		}).find('a').focus(function(){
			this.blur();
		});
	});
</script>



</head>
<body>

	<!-- childbar -->
	<div>
		<ul class="nav_area2">
			<a href="home.php"><img src="/assets/images/logobo-04.png" class="logoimg"></a>
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
						<a href="../personaldata.php"><img class="edit" src="/assets/images/editicon.png" ></a>

					</div>
					<a href="../logout.php?logout"><img class="logout" src="/assets/images/logout.png" ></a>



				</div>

				<hr class="line3"></hr>
			</div>
			<div  class="nav_area" id="accordion">
				<div class="button">
					<a href="../home.php">首頁</a>
				</div>
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
					<a href="../personal_calendar.php">個人行事曆</a>
				</div>
				<div class="button">
					<a href="search_file.php">分享市集</a>
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

	<div class="head">
		<img src="/assets/images/icon/iconb-file.png" class="icon">
		<h2 class="title">檔案總管</h2>
	</div>
	<!-- file.upload -->

	<div class="File" >
		<div class="top">
			<h3 class="title-1">我的檔案</h3>
			<!-- <img src="../images/tablepic2.png" class="tablepic"> -->


			<form class="file_upload " action="file_upload.php" method="post" enctype="multipart/form-data">
				<input class="choosebtn" type="file" name="files[]" id="file" data-multiple-caption="{count} files selected" multiple />
				<input type="hidden" name="user_Id" value="<?php echo $userRow[0]; ?>">
				<label for="file"></label>
				<input class="uploadbtn" type="submit" value="Upload" disabled />
				<!-- <input class="uploadbtn" type="image" src="/assets/images/upload.png" alt="submit" height="30px" width="30px" disabled /> -->
			</form>
			<form class="srchall" action="/cart/public/index.php" method="GET">

				<input type="text" id="myInput" class="srchbox" onkeyup="myFunction()" placeholder="搜尋檔案.."/>
				<br>

			</form>
		</div>
		<div id="FileOwn">
			<table class="Myfilebody" id="id01">
				<tbody>
					<tr class="FO-1" style="font-weight: 900;font-size: 18px;">
						<th class="FO1-1"> &nbsp </th>
						<th class="FO1-2">檔案名稱</th>
						<th class="FO1-3">上傳者</th>
						<th class="FO1-4">專案名稱</th>
						<th class="FO1-5">允許上架</th>
						<th class="FO1-6">商品狀態</th>
						<th class="FO1-7">目前收益</th>
						<th class="FO1-8">商品編輯</th>
					</tr>



					<?php
					$query="SELECT * FROM tbl_uploads WHERE userId=".$_SESSION['user'];
					$res=mysqli_query($db, $query);
					while($row=mysqli_fetch_array($res))
					{
						?>
						<tr class="FO-1" >
							<td class="FO1-1"><a href="uploads/<?php echo $row['file']; ?>"=><img src="/assets/images/download.png" height="20px" width="20px" /></a></td>
							<td class="FO1-2"><?php echo $row['file'] ?></td>
							<td class="FO1-3">
								<?php
								$query = "SELECT userName FROM users WHERE userId=".$row['userId'];
								$userName = mysqli_fetch_array(mysqli_query($db, $query));
								echo $userName[0];
								?>
							</td>
							<td class="FO1-4">
								<?php
								$query = mysqli_query($db, "SELECT projectName FROM projects WHERE projectId=".$row['projectId']);
								$projectName = mysqli_fetch_array($query);
								if($projectName == 0){
									echo "--";
								}
								echo $projectName[0];
								?>
							</td>
							<!-- <td><a href="launch_file.php?id=<?php echo $row['id']; ?>"></a></td> -->
							<td class="FO1-5">
								<div class="checkbox checkbox-slider--b">
									<label>
										<input onclick="window.location.href='launch_page.php?id=<?php echo $row['id']; ?>'" type="checkbox">
										<span></span>
									</label>
								</div>
							</td>
							<td class="FO1-6"><div class="wait">審核中</div></td>
							<td class="FO1-7">
								<img src="/assets/images/pc-coin.png" style="position:relative;left:25px;top:-5px;width: 20px; height: 20px;"> &nbsp  &nbsp &nbsp 0
							</td>
							<td class="FO1-8"><button onclick="window.location.href='launch_page.php?id=<?php echo $row['id']; ?>'">編輯</button></td>
							<!-- <td class="FO1-8"><button type="button" class="btn1" >編輯</button></td> -->
						</tr>
						<?php
					}
					?>



				</tbody>
			</table>
		</div>
	</div>

	<div class="File">
		<div class="top2"><h3 class="title-1">購買檔案</h3></div>
		<!-- <img src="../images/tablepic2.png" class="tablepic"> -->
		<div id="FileDown">
			<table class="Myfilebody">
				<tbody>
					<tr class="FO2" style="font-weight: 900;font-size: 18px;">
						<th class="FO2-1"> &nbsp </th>
						<th class="FO2-2">檔案名稱</th>
						<th class="FO2-3">提供者</th>
						<th class="FO2-4">價格</th>
						<th class="FO2-5">評分</th>
					</tr>

					<?php
						// customer_id = SESSION[user_id]
					$res = mysqli_query($db, "SELECT id FROM orders WHERE customer_id=".$_SESSION['user']);
					$orderIdRow = mysqli_fetch_array($res);
						// order_id -> product_id
					$res = mysqli_query($db, "SELECT product_id FROM orders_products WHERE order_id=".$orderIdRow[0]);
					$productIdRow  = array();
					for ($i = 0; $i < @mysqli_num_rows($res); $i++) {
						$productIdRow[] = mysqli_result($res,$i,0);
					}

					for ($i = 0; $i < count($productIdRow) ; $i++) {
							// product_id -> product.title
						$res = mysqli_query($db, "SELECT * FROM products WHERE id=".$productIdRow[$i]);
						while($row=mysqli_fetch_array($res))
						{
							?>
							<tr class="FO-2">
								<td class="FO2-1"><a href="uploads/<?php echo $row['file'] ?>" ><img src="/assets/images/download.png" height="20px" width="20px" /></a></td>
								<td class="FO2-2"><?php echo $row['title'] ?></td>
								<td class="FO2-3"><?php echo $row['userName'] ?></td>
								<td class="FO2-4">
									<img src="/assets/images/pc-coin.png" height="25" width="25" /> &nbsp
									<?php echo $row['price'] ?>
								</td>
								<!-- <td><a href="rate.php?id=<?php echo $row['id']; ?>">給予評分</a></td> -->
								<!-- <td><button type="button" class="ratebtn">給予評分</button></td> -->
								<td><button onclick="window.location.href='rate_page.php?id=<?php echo $row['id']; ?>'">給予評分</button></td>
							</tr>
							<?php
						}
					}
					?>

				</tbody>
			</table>
		</div>
	</div>

	<div id="tab" style="display: none">
		<div class="tab0">

			<div class="close" id="btn3"></div>

			<form action="launch_file.php" method="post">
				<div id="name">
					<h4>產品名稱:</h4>
					<br>
					<input class="name" type="text" name="title" value="" placeholder="請輸入產品名稱...">
					<hr>
				</div>
				<div id="price">
					<h4>產品價格:</h4>
					<br> <img src="/assets/images/pc-coin.png" height="25" width="25"/>
					<input class="price" type="text" name="price" value="" placeholder="請輸入產品價格...">
					<hr>
				</div>
				<div id="post">
					<h4>產品介紹:</h4>
					<br>
					<textarea class="post" rows="3" name="description" placeholder="請輸入介紹內容..."></textarea>
					<hr>
				</div>
				<div>
					<h4>產品關鍵字:</h4>
					<h6>(optional)</h6>
					<br>
					<div id="fatorange">
						<input class="key" type="text" name="tag1" placeholder="關鍵字1..">
						<input class="key" type="text" name="tag2" placeholder="關鍵字2..">
						<input class="key" type="text" name="tag3" placeholder="關鍵字3..">
						<input class="key" type="text" name="tag4" placeholder="關鍵字4..">
						<input class="key" type="text" name="tag5" placeholder="關鍵字5..">
					</div>
					<!-- <div class="btn2">
						<button type="button" id="btn2">+</button>
					</div> -->
				</div>
				<br>
				<button id="postsend" type="submit" name="launch">完成</button>
			</form>
		</div>
	</div>

	<div>
		<form action="rate.php" method="post">
			<div id="tabtab" style="display: none">
				<div class="tabtab0">
					<div class="close" id="btn03"></div>
					<br>
					<h4>評分:</h4>

					<div id="div">
						<span class="span" id="1">☆</span>
						<span class="span" id="2">☆</span>
						<span class="span" id="3">☆</span>
						<span class="span" id="4">☆</span>
						<span class="span" id="5">☆</span>
					</div>
					<br>

					<h4>評論:</h4>

					<input id="score" type="" name="score">

					<br/>
					<textarea class="post" rows="10" cols="100" name="feedback" placeholder="give some feedback..."></textarea><br/>
					<br>
					<br>
					<button id="postsend" type="submit" name="rate">確認評價</button>
				</div>
			</div>
		</form>
	</div>

	<!--隱藏卷軸-->
	<script type="text/javascript">
	$(".timeline").on("mouseenter mouseleave", function (event) { //挷定滑鼠進入及離開事件
		if (event.type == "mouseenter") {
			$(this).css({"overflow-x": "scroll"}); //滑鼠進入
		} else {
			$(this).scrollTop(0).css({"overflow-x": "hidden"}); //滑鼠離開
		}
	});
</script>

<?php
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
<script type="text/javascript">
	function myFunction() {
		var input, filter, table, tr, td, i;
		input = document.getElementById("myInput");
		filter = input.value.toUpperCase();
		table = document.getElementById("id01");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[0];
			if (td) {
				if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			}
		}
	}

	$(document).ready(
		function(){
			$('input:submit').attr('disabled',true);
			$('input:file').change(
				function(){
					if ($(this).val()){
						$('input:submit').removeAttr('disabled');
					}
					else {
						$('input:submit').attr('disabled',true);
					}
				});
		});
	</script>

	<script src="/js/custom-file-input.js"></script>

</body>
</html>
<?php ob_end_flush(); ?>
