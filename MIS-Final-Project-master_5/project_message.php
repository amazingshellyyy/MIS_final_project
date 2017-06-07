<?php
ob_start();
session_start();
require_once 'dbconnect.php';
require_once 'bar_P.php';

$projectId = $_GET['id'];

$res = mysqli_query($db, "SELECT * FROM projects WHERE projectId=".$_GET['id']);
$projectRow = mysqli_fetch_array($res);

  //echo $projectRow[3];<--專案名稱

$res = mysqli_query($db, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow = array();
for ($i = 0; $i < mysqli_num_rows($res); $i++) {
  $userRow[] = mysqli_result($res,$i,0);
}

$res = mysqli_query($db, "SELECT userName FROM users WHERE userId=".$_SESSION['user']);
$userName = mysqli_fetch_array($res);

$res = $db->query("SELECT Comtext FROM comment WHERE ProjectId=".$_GET['id']);
$commentRow = array();
for ($i = 0; $i < mysqli_num_rows($res); $i++) {
  $commentRow[] = mysqli_result($res,$i,0);
}

$res = $db->query("SELECT ComId FROM comment WHERE ProjectId=".$_GET['id']);
$commentRow_Id = array();
for ($i = 0; $i < mysqli_num_rows($res); $i++) {
  $commentRow_Id[] = mysqli_result($res,$i,0);
}

$res = $db->query("SELECT ComId FROM comment WHERE ProjectId=".$_GET['id']);
$commentIdRow = array();
for ($i = 0; $i < mysqli_num_rows($res); $i++) {
  $commentIdRow[] = mysqli_result($res,$i,0);
}

$res = $db->query("SELECT ComTime FROM comment WHERE ProjectId=".$_GET['id']);
$commentTimeRow = array();
for ($i = 0; $i < mysqli_num_rows($res); $i++) {
  $commentTimeRow[] = mysqli_result($res,$i,0);
}

$res = mysqli_query($db, "SELECT userEmail FROM users WHERE userId=".$projectRow[1]);
$userEmail = mysqli_fetch_array($res);

$error = false;

if (isset($_POST['post'])) {
  $text = strip_tags($_POST['text']);
  $text = htmlspecialchars($text);

  $time = $_POST['time'];

  $postSource = "貼文發布";
  $postText = "$userName[0] 已發佈一則貼文至 <a href=\"project_home.php?id=$projectRow[0]\">$projectRow[3]</a>";


  if (empty($text)) {
    $error = true;
    $errMSG = "請輸入文字";
  }

  if (!$error) {

    $membersEmail = $projectRow[2];
    $ownerEmail = $userEmail[0];
    $involvedMembers = $membersEmail.",".$ownerEmail;

    $query = "INSERT INTO comment(UserId,ProjectId,ComText,ComTime)
    VALUES('$userRow[0]','$projectRow[0]','$text','$time')";
    $res = mysqli_query($db, $query);

    $query = "INSERT INTO post(postSource,postText,postUserId,postProjectId,postInvolvedMembers)
    VALUES('$postSource','$postText','$userRow[0]','$projectRow[0]','$projectRow[2]')";
    $res = mysqli_query($db, $query);


    if ($res) {
      unset($text);
      unset($time);
      unset($membersEmail);
      unset($ownerEmail);
      unset($involvedMembers);

    }
  }
  echo "<script>
  window.location.href='project_message.php?id=$projectId';
</script>";
}

if(isset($_POST['post_subcomment'])){
  $subcomment = strip_tags($_POST['subcomment']);
  $subcomment = htmlspecialchars($subcomment);
  $subcomment = $userName[0]."：".$subcomment;

  $ComId_subcomment = $_POST['ComId_subcomment'];

  $time_subcomment = $_POST['time_subcomment'];

  if (!$error) {
    $query = "INSERT INTO subcomment(ComId,SubComText,UserId)
    VALUES('$ComId_subcomment','$subcomment','$userRow[0]')";
    $res = mysqli_query($db, $query);

    if ($res) {
      unset($ComId_subcomment);
      unset($subcomment);
    }
  }
  echo "<script>
  window.location.href='project_message.php?id=$projectId';
</script>";
}


?>
<!DOCTYPE html>
<html>
<head>
  <title>留言板</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link type="text/css" rel="stylesheet" href="assets/css/PPost.css">
  <script type="text/javascript" src="assets/js/PPost.js"></script>
</head>
<body>
  <!-- 新增留言 -->
  <div class="mainpost">


    <div class="post">
      <div>
        <button href="javascript:ShowContent(1, 3, 'message')" class="btn"><img class="icon" src="assets/images/Picon/icon-edit.png">撰寫貼文</button>
        <button href="javascript:ShowContent(2, 3, 'message')" class="btn"><img class="icon" src="assets/images/file+.png">新增檔案</button>
        <button href="javascript:ShowContent(3, 3, 'message')" class="btn"><img class="icon" src="assets/images/vote.png">建立投票</button>
        <button type="button" class="btn" value="View" onclick="this.form.FILE.click();"><img class="icon" src="assets/images/pic+.png">新增圖片/影片</button>
      </div>
      <div id="message1">
        <form method="post" action="project_message.php?id=<?php echo $_GET['id']; ?>" autocomplete="off" id="revise">
          <div class="form-group">
            <br>
            <textarea class="form-control" row="3" name="text"></textarea>
          </div>
          <input type="hidden" name="time" value="<?php echo date('Y-m-d H:i:s', time()); ?>">
          <input type="file" id="photo1" value="" name="FILE" onchange="this.form.FILEShow.value=this.value">
          <button id="postsend" type="submit" float="right" name="post" class="btn"><img class="icon" src="assets/images/Picon/icon-confirm.png">發佈</button>
        </form>
      </div>
      <div id="message2" style="display: none">
        <form>
          <div class="form-group">
            <br>
            <textarea class="form-control" rows="3" placeholder="請上傳檔案......"></textarea>
          </div>
          <input type="file" id="photo2" value="" name="FILE" onchange="this.form.FILEShow.value=this.value">
          <button class="btn" value="View" onclick="this.form.FILE.click();">新增圖片/影片</button>
          <img id="show2" src="#" alt="your image">
          <button type="button" float="right">完成</button>
        </form>
      </div>
      <div id="message3" style="display: none">
        <form>
          <div id="newvote" class="form-group">
            <h5>標題:</h5>
            <input type="text" class="form-control" placeholder="請輸入投票標題......">
            <h5>到期時間:</h5>
            <input type="text" class="form-control" placeholder="請輸入到期時間......">
            <h5>內容:</h5>
            <textarea class="form-control" rows="3" placeholder="請輸入投票問題......"></textarea>
            <textarea class="form-control" rows="1" placeholder="投票選項......"></textarea>
            <textarea class="form-control" rows="1" placeholder="投票選項......"></textarea>
          </div>
        </form>
        <button type="button" id="newvotebutton" class="btn btn-info btn-s">新增選項</button>
        <button id="votebutton" type="button" class="btn btn-info btn-s">進階設定</button>
        <div id="vote" title="投票設定" style="display:none">
          <form class="form-find">
            <h5>選項:</h5>
            <div class="form-group">
              <select class="form-control" id="sel1">
                <option>一人一票</option>
                <option>一人多票</option>
              </select>
            </div>
            <h5>新增:</h5>
            <div class="form-group">
              <select class="form-control" id="sel1">
                <option>參與者可以新增選項</option>
                <option>參與者不可新增選項</option>
              </select>
            </div>
            <hr>
            <button type="button" class="start">確認</button>
          </form>
        </div>
        <button type="button" class="start">完成</button>
      </div>
    </div>

  </div>
</div>
<!-- 留言區 -->

  <?php
  for($i = count($commentRow)-1; $i >= 0; $i--){
    $subcommentRow = array();
    $res = mysqli_query($db, "SELECT SubComText FROM subcomment WHERE ComId=".$commentIdRow[$i]);
    if($res){
      for ($z = 0; $z < mysqli_num_rows($res); $z++) {
        $subcommentRow[] = mysqli_result($res,$z,0);
      }
    }

    ?>
    <div class="main2">
     <div class="post-left">

       <div>
         <img  src="assets/images/pp-21.png" class="img-circle">
         <div href="#member001" class="UserName"><?php echo $userName[0]; ?></div>
         <div id="time" class="glyphicon glyphicon-time"><?php echo $commentTimeRow[$i]; ?></div>
         <button class="btn2" href="project_message_delete.php?Com_id=<?php echo $commentIdRow[$i]; ?>&Pro_id=<?php echo $projectId; ?>"><img src="assets/images/delete.png" class="icon"></button>

       </div>

       <div class="postarea">
         <p class="posts"><?php echo $commentRow[$i]; ?></p>
       </div>

     </div>

     <div class="post-right">
       <?php
       for ($x = count($subcommentRow)-1; $x >= 0; $x--) {
        ?>
        <div class="commentg">
          <img id="guest" src="assets/images/pp-21.png" class="img-circle">
          <div class="comments"><?php echo $subcommentRow[$x]; ?></div>
        </div>
        <?php
      }
      ?>

      <a></a>
      <div class="commentarea">
       <form class="form-find" method="post" action="project_message.php?id=<?php echo $_GET['id']; ?>" autocomplete="off" id="revise">
         <input type="text" name="subcomment" class="inputcomment" placeholder="請輸入留言......">
         <input type="hidden" name="time_subcomment" value="<?php echo date('Y-m-d H:i:s', time()); ?>">
         <input type="hidden" name="ComId_subcomment" value="<?php echo $commentIdRow[$i]; ?>">
         <button class="btn" type="submit" name="post_subcomment"><img class="icon" src="assets/images/Picon/icon-edit.png">留言</button>
       </form>
     </div>
     <!-- <button type="button" class="start">發送</button> -->
   </div>
 </div>


 <?php
 unset($subcommentRow);
}
?>
</body>
</html>

<?php ob_end_flush(); ?>
