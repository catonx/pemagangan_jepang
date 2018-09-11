<?php
include 'user_form.php';

if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
	$username=trim($_POST['username']);
	$nama_lengkap=trim($_POST['nama_lengkap']);
	$email=trim($_POST['email']);
  $tlp=trim($_POST['tlp']);
	$level=$_POST['level'];
	$password=md5(trim($_POST['password']));
	$password_admin=md5(trim($_POST['password_admin']));

	if(!empty($username) && !empty($nama_lengkap) && !empty($email) && !empty($tlp) && !empty($level) && !empty($password) && !empty($password_admin)){
		if($user['password'] == $password_admin && $user['level'] == 'Admin'){
			$sql = "insert into user(username, nama_lengkap, email, tlp, level, password) values('{$username}','{$nama_lengkap}','{$email}','{$tlp}', '{$level}', '{$password}')";
			$query = $db->query($sql);
			if($query->errno){
				echo '<script>alert("Query error!\n('.$query->errno.') '.$query->error.'");</script>';
			}else{
				echo '<script>alert("Data berhasil disimpan!");</script>';
				echo '<script>window.location.href="?page='.$page.'";</script>';
			}
		}else{
			echo '<script>alert("Password Admin Salah!");</script>';
		}
	}else{
		echo '<script>alert("Data belum lengkap!");</script>';
	}
}
?>
