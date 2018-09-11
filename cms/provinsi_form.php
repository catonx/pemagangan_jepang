<?php if($act=='edit'){ $provinsi = $db->query("select * from provinsi where id_provinsi='{$_GET['id_provinsi']}' limit 1")->fetch_assoc(); } ?>
<form method="post" action="">
  <?php echo '<input type="hidden" name="id_provinsi" value="'.$provinsi['id_provinsi'].'" />'; ?>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Nama Provinsi</label>
    <div class="col-md-10">
      <input type="text" class="form-control" name="nama_provinsi" value="<?php echo $provinsi['nama_provinsi']; ?>" required />
    </div>
  </div>

  <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
  <a href="?page=provinsi" class="btn btn-warning">Batal</a>
</form>
