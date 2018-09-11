<form method="post" action="">
  <div class="form-group">
    <label>Password Sekarang</label>
    <input type="password" class="form-control" name="passwordlama" required autofocus>
  </div>
  <div class="form-group">
    <label>Password Baru</label>
    <input type="password" class="form-control" name="passwordbaru1" required>
  </div>
  <div class="form-group">
    <label>Konfirmasi Password Baru</label>
    <input type="password" class="form-control" name="passwordbaru2" required>
  </div>
  <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
</form>
<?php
if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
	$passwordlama=md5(trim($_POST['passwordlama']));
	$passwordbaru1=md5(trim($_POST['passwordbaru1']));
	$passwordbaru2=md5(trim($_POST['passwordbaru2']));

	if(!empty($passwordlama) && !empty($passwordbaru1) && !empty($passwordbaru2)){
		$getpass=$db->query("select password from member where id_member='{$_SESSION['id_member']}' limit 1")->fetch_assoc();
		if($passwordlama==$getpass['password']){
			if($passwordbaru1==$passwordbaru2){
				$kueri="update member set password='{$passwordbaru1}' where id_member='{$_SESSION['id_member']}' limit 1";
				$edit_qu=$db->query($kueri);
				if($db->affected_rows==1){
					echo '<script>alert("Perubahan password berhasil disimpan!");</script>';
					echo '<script>document.location.href="?page=home";</script>';
				}else{
					echo '<script>alert("Gagal menyimpan perubahan!");</script>';
				}
			}else{
				echo '<script>alert("Konfirmasi Password baru tidak sesuai!");</script>';
			}
		}else{
				echo '<script>alert("Password lama salah!");</script>';
		}
	}else{
		echo '<script>alert("Data belum lengkap!");</script>';
	}
}
?>
