<?php $user = $db->query("select * from user where id_user='{$_GET['id_user']}' limit 1")->fetch_assoc(); ?>
<form>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Username</label>
    <div class="col-md-5">
      <input type="text" class="form-control" value="<?php echo $user['username'] ; ?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Nama Lengkap</label>
    <div class="col-md-5">
      <input type="text" class="form-control" value="<?php echo $user['nama_lengkap'] ; ?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Email</label>
    <div class="col-md-5">
      <input type="text" class="form-control" value="<?php echo $user['email'] ; ?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">No. Telepon/HP</label>
    <div class="col-md-5">
      <input type="text" class="form-control" value="<?php echo $user['tlp'] ; ?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Level</label>
    <div class="col-md-5">
      <input type="text" class="form-control" value="<?php echo $user['level'] ; ?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Terakhir Login</label>
    <div class="col-md-5">
      <input type="text" class="form-control" value="<?php echo $user['last_login'] ; ?>" readonly>
    </div>
  </div>

  <a href="?page=user&act=edit&id_user=<?php echo $user['id_user']; ?>" class="btn btn-primary">Edit</a>
  <a href="?page=user" class="btn btn-warning">Batal</a>
</form>
