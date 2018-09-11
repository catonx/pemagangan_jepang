<?php
ob_start();
session_start();
require_once 'config.php';
if(isset($_SESSION['id_user']) && !empty($_SESSION['id_user'])){
	header('location: cms/');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Administrator</title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/fa/css/font-awesome.min.css" rel="stylesheet">

    <link href="css/login_style.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post" action="">
        <h2 class="form-signin-heading">Login User</h2>
        <label class="sr-only">Username</label>
        <input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
        <label class="sr-only">Password</label>
        <input type="password" class="form-control" placeholder="Password" name="password" required>
				<label class="custom-control custom-radio">
				  <input id="radio1" name="level" type="radio" class="custom-control-input" value="Admin">
				  <span class="custom-control-indicator"></span>
				  <span class="custom-control-description">Admin</span>
				</label>
				<label class="custom-control custom-radio">
				  <input id="radio2" name="level" type="radio" class="custom-control-input" value="Staff">
				  <span class="custom-control-indicator"></span>
				  <span class="custom-control-description">Staff</span>
				</label>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Log in</button>
      </form>

    </div> <!-- /container -->

	<?php
	if(isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
		$username = trim($_POST['username']);
		$password = md5(trim($_POST['password']));
		$level = $_POST['level'];

		if(!empty($username) && !empty($password) && !empty($level)){
			$getuser = $db->query("select * from user where username = '{$username}' and password = '{$password}' and level = '{$level}' limit 1");
			if($getuser->num_rows > 0){
				$user_login = $getuser->fetch_assoc();
				$_SESSION['id_user'] = $user_login['id_user'];				
				$db->query("update user set last_login = now() where id_user = '{$_SESSION['id_user']}' limit 1");
				header('location: cms/');
			}else{
				echo '<script>alert("User tidak terdaftar!");</script>';
			}
		}else{
			echo '<script>alert("Semua field harus diisi!");</script>';
		}
	}
	?>
  </body>
</html>
