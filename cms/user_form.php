<?php if($act=='edit'){ $staff = $db->query("select * from user where id_user='{$_GET['id_user']}' limit 1")->fetch_assoc(); } ?>
<form method="post" action="">
  <?php echo '<input type="hidden" name="id_user" value="'.$staff['id_user'].'" />'; ?>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Username</label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="username" value="<?php echo $staff['username']; ?>" required />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Nama Lengkap</label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $staff['nama_lengkap']; ?>" required />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Email</label>
    <div class="col-md-5">
      <input type="email" class="form-control" name="email" value="<?php echo $staff['email']; ?>" required />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">No. Telepon/HP</label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="tlp" value="<?php echo $staff['tlp']; ?>" required />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Level</label>
    <div class="col-md-5">
      <label class="custom-control custom-radio">
        <input name="level" type="radio" class="custom-control-input" value="Admin" <?php if($staff['level']=='Admin'){ echo ' checked'; } ?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Admin</span>
      </label>
      <label class="custom-control custom-radio">
        <input name="level" type="radio" class="custom-control-input" value="Staff" <?php if($staff['level']=='Staff'){ echo ' checked'; } ?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Staff</span>
      </label>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Password</label>
    <div class="col-md-5">
      <input type="password" class="form-control" name="password" value="" />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Password Admin</label>
    <div class="col-md-5">
      <input type="password" class="form-control" name="password_admin" required>
      <span class="form-text text-muted">Masukkan password admin untuk menyimpan data</span>
    </div>
  </div>

  <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
  <a href="?page=user" class="btn btn-warning">Batal</a>
</form>
