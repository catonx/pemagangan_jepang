<form method="post" action="">
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Username</label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="username" value="<?php echo $user['username'] ; ?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Level</label>
    <div class="col-md-5">
      <input type="text" class="form-control" value="<?php echo $user['level'] ; ?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Nama Lengkap</label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $user['nama_lengkap'] ; ?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Email</label>
    <div class="col-md-5">
      <input type="email" class="form-control" name="email" value="<?php echo $user['email'] ; ?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">No. Telepon/HP</label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="tlp" value="<?php echo $user['tlp'] ; ?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Terakhir Login</label>
    <div class="col-md-5">
      <input type="text" class="form-control" value="<?php echo $user['last_login'] ; ?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Password</label>
    <div class="col-md-5">
      <input type="password" class="form-control" name="password" required>
      <span class="form-text text-muted">Masukkan password untuk menyimpan perubahan</span>
    </div>
  </div>
  <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
</form>
<?php
if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
  $nama_lengkap = trim($_POST['nama_lengkap']);
  $email = trim($_POST['email']);
  $tlp = trim($_POST['tlp']);
  $password = md5(trim($_POST['password']));

  if(!empty($nama_lengkap) && !empty($email) && !empty($tlp) && !empty($password)){
    if($user['password']==$password){
      $query = $db->query("update user set nama_lengkap = '{$nama_lengkap}', email = '{$email}', tlp = '{$tlp}' where id_user = '{$_SESSION['id_user']}' limit 1");
      if($db->affected_rows==1){
        echo '<script>alert("Berhasil menyimpan perubahan");</script>';
        echo '<script>document.location.href="?page='.$page.'";</script>';
      }else{
        echo '<script>alert("Gagal menyimpan perubahan");</script>';
      }
    }else{
      echo '<script>alert("Password anda salah")</script>';
    }
  }else{
    echo '<script>alert("Data belum lengkap")</script>';
  }

}
?>
