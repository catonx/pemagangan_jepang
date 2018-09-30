<?php
ob_start();
session_start();
require_once 'config.php';
if(!empty($_SESSION['id_member']) && isset($_SESSION['id_member'])){
	header('location: app/');
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Magang</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/freelancer.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Pemagangan</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#tentang">Tentang</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#daftar">Daftar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#login">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <img class="img-fluid" src="img/profile.png" alt="">
        <div class="intro-text">
          <span class="name">Pemagangan Jepang</span>
          <hr class="star-light">
          <span class="skills">Dapatkan pengalaman hebat dengan bekerja magang di jepang</span>
        </div>
      </div>
    </header>

      <!-- tentang Section -->
    <section id="tentang">
      <div class="container">
        <h2 class="text-center">tentang</h2>
        <hr class="star-primary">
        <div class="row">
          <div class="col-lg-12">
            <?php
              $tentang = $db->query("select isi from tentang order by id_tentang desc limit 1")->fetch_assoc();
              echo $tentang['isi'];
            ?>
          </div>
        </div>
      </div>
    </section>

  <?php
		// var_dump($_SESSION);
    if(isset($_POST['daftar']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
  		$nama = trim($_POST['nama']);
  		$email = trim($_POST['email']);
  		$hp = trim($_POST['hp']);
  		$password1 = md5(trim($_POST['password1']));
  		$password2 = md5(trim($_POST['password2']));

  		if(!empty($nama) && !empty($email) && !empty($hp) && !empty($password1) && !empty($password2)){
  			if($password1 == $password2){
  				$getuser = $db->query("select * from member where email = '{$email}'");
  				if($getuser->num_rows > 0){
  					echo '<script>alert("Email '.$email.' sudah terdaftar!");</script>';
            echo '<script>window.location.href="#daftar"</script>';
  				}else{
  					$query = $db->query("insert into member(nama, hp, email, password) values('{$nama}', '{$hp}', '{$email}', '{$password1}')");
						// if ($query === TRUE){
						// 	echo '<script>alert("Sampe!");</script>';
						// 	var_dump($db->insert_id);
						// 	header('location: app/');
						// }
						// die;
						if($query->errno){
  						echo '<script>alert("Pendaftaran gagal!");</script>';
              echo '<script>window.location.href="#daftar"</script>';
  					}else{
							$_SESSION['id_member'] = $db->insert_id;
							echo '<script>alert("Pendaftaran berhsil !");</script>';
		          header('location: app/');
  					}
  				}
  			}else{
  				echo '<script>alert("Konfirmasi password tidak sesuai!");</script>';
          echo '<script>window.location.href="#daftar"</script>';
  			}
  		}else{
  			echo '<script>alert("Data belum lengkap!");</script>';
        echo '<script>window.location.href="#daftar"</script>';
  		}
  	}
  ?>
  <!-- Daftar Section -->
  <section class="success" id="daftar">
    <div class="container">
      <h2 class="text-center">Daftar</h2>
      <hr class="star-light">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <form method="post" action="index.php">
            <div class="form-group floating-label-form-group controls">
            <div class="control-group">
                <label>Nama</label>
                <input class="form-control" type="text" name="nama" placeholder="Nama" required>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Email</label>
                <input class="form-control" type="email" name="email" placeholder="Email" required>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>No. HP</label>
                <input class="form-control" type="text" name="hp" placeholder="No. HP" required>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Password</label>
                <input class="form-control" type="password" name="password1" placeholder="Password" required>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Konfirmasi Password</label>
                <input class="form-control" type="password" name="password2" placeholder="Konfirmasi Password" required>
              </div>
            </div>
            <br>
            <div class="form-group">
              <button type="submit" class="btn btn-lg btn-outline" name="daftar">Daftar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

    <?php
    if(isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
      $email = trim($_POST['email']);
      $password = md5(trim($_POST['password']));

      if(!empty($email) && !empty($password)){
        $getuser = $db->query("select * from member where email = '{$email}' and password = '{$password}' limit 1");
        if($getuser->num_rows > 0){
          $user_login = $getuser->fetch_assoc();
          $_SESSION['id_member'] = $user_login['id_member'];
          header('location: app/');
        }else{
          echo '<script>alert("Email/Password salah!");</script>';
          echo '<script>window.location.href="#login"</script>';
        }
      }else{
        echo '<script>alert("Semua field harus diisi!");</script>';
        echo '<script>window.location.href="#login"</script>';
      }
    }
    ?>
    <!-- Login Section -->
    <section id="login">
      <div class="container">
        <h2 class="text-center">Login</h2>
        <hr class="star-primary">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <form method="post" action="">
              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label>Email</label>
                  <input class="form-control" id="email" type="email" name="email" placeholder="Email" required>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label>Password</label>
                  <input class="form-control" id="name" type="password" name="password" placeholder="Password" required>
                </div>
              </div>
              <br>
              <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg" name="login">Login</button>
              </div>
            </form>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-8 mx-auto">
						<p class="help-block text-warning">Belum punya akun? <a class="js-scroll-trigger" href="#daftar">Daftar</a></p>
					</div>
				</div>

      </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
      <div class="footer-below">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              Copyright &copy; 2017, Magang
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top d-lg-none">
      <a class="btn btn-primary js-scroll-trigger" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/freelancer.min.js"></script>

  </body>

</html>
