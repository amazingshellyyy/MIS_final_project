<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';

 //使用者登入後會直接導向home
 if (isset($_SESSION['user'])!="") {
     header("Location: home.php");
     exit;
 }

 $error = false; //如遇到error將改為true，藉此做例外處理管控

 if (isset($_POST['btn-login'])) {

  //清除不合規定之email及password
     $email = trim($_POST['email']);
     $email = strip_tags($email);
     $email = htmlspecialchars($email);

     $pass = trim($_POST['pass']);
     $pass = strip_tags($pass);
     $pass = htmlspecialchars($pass);

     if (empty($email)) {
         $error = true;
         $emailError = "請輸入電子信箱";
     } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $error = true;
         $emailError = "電子信箱格式錯誤";
     }

     if (empty($pass)) {
         $error = true;
         $passError = "請輸入密碼";
     }

  // 如無上述錯誤，繼續執行login動作
  if (!$error) {
      $password = hash('sha256', $pass); // 密碼採用sha256加密

      $res = mysqli_query($db, "SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");
      $row = mysqli_fetch_array($res);
      $count = mysqli_num_rows($res); // 如果帳號密碼皆正確將必return 1

   if ($count == 1 && $row['userPass']==$password) {
       $_SESSION['user'] = $row['userId'];
       header("Location: home.php");
   } else {
       $errMSG = "查無此帳密";
   }
  }
 }

 if (isset($_POST['btn-signup'])) {
     //排除不合規定之name及passwords
     $name = trim($_POST['name']);
     $name = strip_tags($name);
     $name = htmlspecialchars($name);

     $email = trim($_POST['email']);
     $email = strip_tags($email);
     $email = htmlspecialchars($email);

     $pass = trim($_POST['pass']);
     $pass = strip_tags($pass);
     $pass = htmlspecialchars($pass);

     $pass_c = trim($_POST['pass_confirm']);
     $pass_c = strip_tags($pass_c);
     $pass_c = htmlspecialchars($pass_c);

     if (empty($name)) {
         $error = true;
         $nameError = "請輸入名稱";
     }

    //  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //      $error = true;
    //      $emailError = "請輸入正確電子信箱格式.";
    //  } else {
    //      $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
    //      $result = mysqli_query($db, $query);
    //      $count = mysqli_num_rows($db, $result);
    //      if ($count!=0) {
    //          $error = true;
    //          $emailError = "您輸入的電子信箱已被使用";
    //      }
    //  }

     if (empty($pass)) {
         $error = true;
         $passError = "請輸入密碼";
     } elseif (strlen($pass) < 6) {
         $error = true;
         $passError = "密碼須至少6個字元以上";
     }
     if($pass!=$pass_c){
       $error = true;
       $passError = "您的輸入的兩次密碼不相符";
     }


     $password = hash('sha256', $pass); //秘密加密sha256格式

     if (!$error) {
         $query = "INSERT INTO users(userName,userEmail,userPass,user_coin)
                   VALUES('$name','$email','$password','500')";
         $res = mysqli_query($db, $query);

         if ($res) {
             $errTyp = "success";
             $errMSG = "註冊成功";
             unset($name);
             unset($email);
             unset($pass);
         } else {
             $errTyp = "danger";
             $errMSG = "註冊失敗";
         }
     }
 }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="assets/css/login.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script  src="https://code.jquery.com/jquery-3.1.1.min.js"  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="  crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" ></script>
  <script src="assets/js/login.js" ></script>
</head>
<body>
<div class="body">

<div class="veen">
		<div class="login-btn splits">

			<p>Already an user?</p>
			<button>Login</button>
		</div>
		<div class="rgstr-btn splits">

			<p>Don't have an account?</p>
			<button>Register</button>
		</div>
		<div class="wrapper">
			<div id="login">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
  				<img class="logoblue" src="assets/images/logo-04.png">
  				<!-- <h3>Login</h3> -->
  				<div class="mail">
  					<input type="email" name="email" value="" maxlength="40" /></br>
  					<label>Email</label>
  				</div>
  				<div class="passwd">
  					<input type="password" name="pass" maxlength="15" /></br>
  					<label>Password</label>
  				</div>
  				<div class="submit">
  					<button class="dark" type="submit" name="btn-login">Login</button>
  				</div>
        </form>
			</div>
			<div id="register">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" action="form-handler" onsubmit="return checkForm(this)" autocomplete="off" id="register">
  				<img class="logoorg" src="assets/images/logoorg-04.png">
  				<!-- <h3>Register</h3> -->
          <div class="uid">
            <input type="text" name="name" maxlength="50" value=<?php if (isset($nameError)){echo $nameError.'<br>';} ?> >
            <label>Username</label>
          </div>
  				<div class="mail">
  					<input type="email" name="email" maxlength="40" value=<?php if (isset($emailError)){echo $emailError.'<br>';} ?>>
  					<label>Email</label>
  				</div>
  				<div class="passwd">
  					<input type="password" name="pass" maxlength="15">
  					<label>Password</label>
  				</div>
  				<div class="passwd">
  					<input type="password" name="pass_confirm" maxlength="15">
  					<label>*Password check</label>
  				</div>
  				<div class="submit">
  					<button class="dark" type="submit" name="btn-signup">Register</button>
  				</div>
        </form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php ob_end_flush(); ?>
