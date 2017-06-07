<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';
 require_once 'bar_PS.php';

 //如果非登入狀態將導回首頁
 if (!isset($_SESSION['user'])) {
     header("Location: index.php");
     exit;
 }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>代辦清單</title>
  </head>
  <body>
    代辦清單頁面(未完成任務顯示)<br>
    <a href="home.php">回首頁</a>
  </body>
</html>
