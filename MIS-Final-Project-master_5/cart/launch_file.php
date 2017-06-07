<?php
ob_start();
session_start();
require_once 'dbconnect.php';

//如果非登入狀態將導回首頁
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
  exit;
}
//抓取登入之帳戶資料
$res = mysqli_query($db, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow = mysqli_fetch_array($res);
$error = false;

//get the file id
$res=mysqli_query($db, "SELECT * FROM tbl_uploads WHERE id=".$_GET['id']);
$filerow=mysqli_fetch_array($res);



$query = mysqli_query($db, "SELECT projectName FROM projects WHERE projectId=".$filerow['projectId']);
$projectName = mysqli_fetch_array($query);


$filetype = $filerow['type'];
switch ($filetype) {
  case "docx":
  $image = '/assets/images/documents/word.png';
  break;
  case "xlsx":
  $image = '/assets/images/documents/excel.png';
  break;
  case "ppt":
  $image = '/assets/images/documents/powerpoint.png';
  break;
  case "png":
  $image = '/assets/images/documents/image.png';
  break;
  case "jpg":
  $image = '/assets/images/documents/image.png';
  break;
  case "pdf":
  $image = '/assets/images/documents/pdf.png';
  break;
  default:
  $image = '/assets/images/documents/text.png';
}

if (isset($_POST['launch'])) {

  $title = trim($_POST['title']);
  $title = strip_tags($_POST['title']);
  $title = htmlspecialchars($title);
  $description = trim($_POST['description']);
  $description = strip_tags($description);
  $description = htmlspecialchars($description);
  $price = trim($_POST['price']);
  $price = strip_tags($price);
  $price = htmlspecialchars($price);
  $tag1 = trim($_POST['tag1']);
  $tag1 = strip_tags($tag1);
  $tag1 = htmlspecialchars($tag1);
  $tag2 = trim($_POST['tag2']);
  $tag2 = strip_tags($tag2);
  $tag2 = htmlspecialchars($tag2);
  $tag3 = trim($_POST['tag3']);
  $tag3 = strip_tags($tag3);
  $tag3 = htmlspecialchars($tag3);
  $tag4 = trim($_POST['tag4']);
  $tag4 = strip_tags($tag4);
  $tag4 = htmlspecialchars($tag4);
  $tag5 = trim($_POST['tag5']);
  $tag5 = strip_tags($tag5);
  $tag5 = htmlspecialchars($tag5);

  if (empty($title)) {
    $error = true;
    $errMSG = "請輸入檔案名稱";
  }
  if (empty($description)) {
    $error = true;
    $errMSG = "請輸入檔案描述";
  }
  if (empty($price)) {
    $error = true;
    $errMSG = "請輸入期望價格";
  }
  if (isset($errMSG)) {
    echo $errMSG;
  }

  $subtitle = substr($title, 0, 3);
  $subdescription = substr($description, 0, 5);
  $slug = $subtitle . $subdescription;

  $query = "INSERT INTO products(userName,title,slug,description,price,tag1,tag2,tag3,tag4,tag5,image, projectName, stock)
  VALUES('$userRow[1]', '$title', '$slug', '$description', '$price', '$tag1', '$tag2', '$tag3', '$tag4', '$tag5', '$image', '$projectName[0]', '1')";

  $res = mysqli_query($db, $query);

echo "<script>
alert('successfully launched');
window.location.href='/cart/file_manager.php';
</script>";
}

if ($res) {
  unset($title);
  unset($description);
  unset($price);
  unset($tag1);
  unset($tag2);
  unset($tag3);
  unset($tag4);
  unset($tag5);
}
?>
<!--
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
</head>
<body>
  <form method="post">
    <input type="text" name="title" placeholder="請輸入檔案名稱" /><br />
    <input type="text" name="description" placeholder="請輸入檔案描述" /><br />
    <input type="text" name="price" placeholder="請輸入期望價格" /><br />
    <input type="text" name="tag1" placeholder="請檔案關鍵字一" /><br />
    <input type="text" name="tag2" placeholder="請檔案關鍵字二" /><br />
    <input type="text" name="tag3" placeholder="請檔案關鍵字三" /><br />
    <input type="text" name="tag4" placeholder="請檔案關鍵字四" /><br />
    <input type="text" name="tag5" placeholder="請檔案關鍵字五" /><br /><br />
    <?php echo $filetype ?>
    <button type="submit" name="launch" class="btn btn-default">確認上架</button>
  </form>

  <br /><br />
  <a href="file_manager.php">回檔案總管</a>
</body>
</html> -->
