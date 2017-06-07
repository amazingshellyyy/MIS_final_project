<!DOCTYPE html>
<?php
session_start();
require_once 'dbconnect.php';
require_once 'bar_PS.php';

?>
<html>
<head>
	<title>Personal_calendar</title>
	<link rel="stylesheet" href="assets/css/Percale.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
		function init(){
			if(localStorage.getItem("now_month") === null || localStorage.getItem("now_year") === null ) {
				var now = new Date();
				var YEAR = now.getFullYear();
				var MONTH = now.getMonth()+1;
				var DATE = now.getDate();
				document.getElementById('Year').value=YEAR;
				document.getElementById('Month').value=MONTH;
			}
			else{
				var YEAR = window.localStorage["now_year"];
				var MONTH = window.localStorage["now_month"];
				document.getElementById('Year').value=YEAR;
				document.getElementById('Month').value=MONTH;
			}
			saveToStorage();
			showCalendar(YEAR.toString()+"-"+MONTH.toString());
			$("#mission_dialog").hide();
			$("#mission_create").hide();

		}
		function saveToStorage() {
			window.localStorage["now_month"] = document.getElementById("Month").value;
			window.localStorage["now_year"] = document.getElementById("Year").value;
		}
		function month_change(sel) {
			var nm=parseInt(window.localStorage["now_month"]);
			var ny=parseInt(window.localStorage["now_year"]);
			if(sel==0){ //-
				nm-=1;
				if(nm<1){
					nm=12;
					ny-=1;
					document.getElementById('Year').value=ny;
				}
				document.getElementById('Month').value=nm;
			}
			else if(sel==1){//+
				nm+=1;
				if(nm>12){
					nm=1;
					ny+=1;
					document.getElementById('Year').value=ny;
				}
				document.getElementById('Month').value=nm;
			}
			saveToStorage();
			showCalendar(ny.toString()+"-"+nm.toString());
		}

		function mergeYearAndMonth(sel,value) {
			var nm=parseInt(window.localStorage["now_month"]);
			var ny=parseInt(window.localStorage["now_year"]);
			if(sel==0){//year
				ny=value;
			}
			else{//month
				nm=value;
			}

			saveToStorage();
			showCalendar(ny.toString()+"-"+nm.toString());
		}

		function showCalendar(str) {
			var URL="showCalendar.php"
			$.ajax({
				url: URL,
				data: "month="+str,
				type:"GET",
				dataType:"html",

				success: function(msg){
					var first_click=0;

					$('#calendar').html(msg);

					mission_function();
				},


				error:function(xhr, ajaxOptions, thrownError){
					alert(xhr.status);
					alert(thrownError);
				}
			}).done(showlist);
		}

		var first_click=0;
		function showlist(){

			$(".moreEvents").on("click", function(event) {
				first_click=1;
				var URL = "moreEvents.php";
				var date = window.localStorage["now_year"]+"-"+window.localStorage["now_month"]+"-"+$(this).attr('value');
				var title = $(this).attr('value');
						// alert(date);
						var userId=22;
						$.ajax({
							url: URL,
							data: "date="+date+"&userId="+userId,
							type:"GET",
							dataType:"html",

							success: function(msg){
								$(".more_event").html(msg);
								$(".more_event").dialog({
									title:title,
									dialogClass:"dialog",
									autoOpen: false,
									height: 120,
									width: 120 ,
									resizable: false,
									draggable: false,
									show: {
										effect: "fade",
										duration: 150
									},
									modal:true,
									dialogClass: 'no-close success-dialog',
									hide: {
										effect: "fade",
										duration: 150
									},
									open: function(){
										$('.ui-widget-overlay').css('background', 'white');
										$('.ui-widget-overlay').css('opacity', '0');
										jQuery('.ui-widget-overlay').bind('click',function(){
											jQuery('.more_event').dialog('close');
											first_click=0;
										})
									}

								});
								$(".more_event" ).dialog( "option", "position", { my: "left bottom", at: "left bottom", of: event.target } );

								$(".more_event").dialog("open");
								mission_function();
							},

							error:function(xhr, ajaxOptions, thrownError){
								alert(xhr.status);
								alert(thrownError);
							}
						});
					});
		}

		// function ajax_Event(sel,idORname){
		// 	var data="sel="+sel+"&data"+idORname;
		// 	var URL="ADevent.php";
		// 	// alert(data);
		// 	$.ajax({
  //               url: URL,
  //               data: "data="+data,
  //               type:"GET",
  //               dataType:"html",

  //               success: function(msg){
  //               	init();
  //               },

  //              	error:function(xhr, ajaxOptions, thrownError){
	 //                alert(xhr.status);
	 //               	alert(thrownError);
  //               }
  //           });
		// }
		function mission_function() {
			$(".mission" ).on( "click", function() {
				first_click=1;
				var mission = $(this).text();
				var now_month = window.localStorage["now_month"];
				var now_year = window.localStorage["now_year"];
				var res = $(this).attr('value').split("/");
				var mission_id = res[0];
				var mission_date = res[1];
				var mission_weekday = new Date(now_year,now_month-1,mission_date).getDay();

				$('#mission_time').text(now_month+","+mission_date+"("+mission_weekday+")");
				$("#mission_dialog").dialog({
					title: mission,
					autoOpen: false,
					height: 200,
					width: 400 ,
					resizable: false,
					draggable: false,
					show: {
						effect: "fade",
						duration: 150
					},
					modal:true,
					dialogClass: 'no-close success-dialog',
					hide: {
						effect: "fade",
						duration: 150
					},
					buttons: [
					{
						text: "Delete",
						"class": 'DeleteButtonClass',
						click: function(){
							document.location.href="ADEvent.php?sel=0&data="+mission_id;
						}
					},
					{
						text: "Edit",
						"class": 'EditButtonClass',
						click: function() {
							document.location.href="PerEventC.php?sel=0&id="+mission_id;
						}
					}
					],
					open: function(){
						$('.ui-widget-overlay').css('background', 'white');
						$('.ui-widget-overlay').css('opacity', '0');
						jQuery('.ui-widget-overlay').bind('click',function(){
							jQuery('#mission_dialog').dialog('close');
							first_click=0;
						})
					}
				});
				if(mission_weekday==5||mission_weekday==6){
					$( "#mission_dialog" ).dialog( "option", "position", { my: "left-280 top ", at: "left bottom", of: $(this) } );
				}
				else{
					$( "#mission_dialog" ).dialog( "option", "position", { my: "left top", at: "left bottom", of:  $(this) } );

				}
				$("#mission_dialog").dialog("open");
						//alert($(this).attr('value'));
					});
			//create event
			$(".cal").on("click", "td", function() {
				if(first_click==0){
					var now_month = window.localStorage["now_month"];
					var now_year = window.localStorage["now_year"];
					var mission_date = $(this).attr('value');
					var fullDate =  now_year+"-"+now_month+"-"+mission_date;
					document.getElementById('mission_name').value="";
					if(mission_date!=0){
						var mission_weekday = new Date(now_year,now_month-1,mission_date).getDay();

						$('#mission_create_time').text(now_month+"/"+mission_date+"("+Transform_DDDeekday(mission_weekday)+")");
						$("#mission_create").dialog({
							title: "新增事件",
							autoOpen: false,

							height: 250,
							width: 400 ,
							resizable: false,
							draggable: false,

							show: {
								effect: "fade",
								duration: 200
							},
							modal:true,
							dialogClass: 'no-close success-dialog',
							hide: {
								effect: "fade",
								duration: 150
							},
							buttons: [
							{
								text: "Edit",
								"class": 'EditButtonClass',
								click: function() {
									document.location.href="PerEventC.php?sel=1&date="+fullDate;
								}
							},
							{
								text: "Create",
								"class": 'CreateButtonClass',
								click: function() {
									var name = document.getElementById('mission_name').value;
									document.location.href="ADEvent.php?sel=1&date="+fullDate+"&data="+name;
								}
							}
							],
							open: function(event, ui){
								$('.ui-widget-overlay').css('background', 'white');
								$('.ui-widget-overlay').css('opacity', '0');
								jQuery('.ui-widget-overlay').bind('click',function(){
									jQuery('#mission_create').dialog('close');
								})
							}
						});
						if(mission_weekday==5||mission_weekday==6){
							$( "#mission_create" ).dialog( "option", "position", { my: "left-350 top-20 ", at: "left bottom-15", of: $(this) } );


						}
						else{
							$( "#mission_create" ).dialog( "option", "position", { my: "left+60 top-20", at: "left bottom", of:  $(this) } );

						}

						$("#mission_create").dialog("open");
					}
				}
			});

		}
		function Transform_DDDeekday(week_day) {
			var originWeekday = new Array("SUN","MON","TUE","WED","THU","FRI","SAT");
			return originWeekday[week_day];
		}
	</script>
</head>
<body onload="init()">
	<div class="top">
		<img class="icon" src="assets/images/icon/iconb-cale.png">
		<h2 class="pagetitle">個人行事曆</h2>
	</div>
	<div class="selectTable">
		<button class="Mbtn" onclick="month_change(0)"><img class="right" src="assets/images/arrow-left.png"></button>
		<select name="Year" id="Year" onchange="mergeYearAndMonth(0,this.value)">
			<?php
			for ($i=1995; $i <2096 ; $i++) {
				if($i==2016)
					echo '<option value='.$i.' selected>'.$i.'</option>';
				else
					echo '<option value='.$i.'>'.$i.'</option>';
			}
			?>
		</select>
		<select name="Month" id="Month" onchange="mergeYearAndMonth(1,this.value)">
			　<option value="1">JAN</option>
			　<option value="2">FAB</option>
			　<option value="3">MAR</option>
			　<option value="4">APR</option>
			　<option value="5">MAY</option>
			　<option value="6" selected>JUN</option>
			　<option value="7">JUL</option>
			　<option value="8">AUG</option>
			　<option value="9">SEP</option>
			　<option value="10">OCT</option>
			　<option value="11">NOV</option>
			　<option value="12">DEC</option>
		</select>

		<button class="Mbtn" onclick="month_change(1)"><img class="right" src="assets/images/arrow-right.png"></button>

	</div>
	<div id="calendar"></div>

	<div id="mission_dialog" title="" class="">
		When<br>
		<div id="mission_time"></div>
	</div>

	<div id="mission_create">
		<form>
			<label for="mission_name">Event:</label>
			<input type="text" id="mission_name" value=""><br>
		</form>
		When<br>
		<div id="mission_create_time"></div>
	</div>

	<div class="more_event"></div>

</body>
</html>
