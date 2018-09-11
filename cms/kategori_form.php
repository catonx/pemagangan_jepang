<?php if($act=='edit'){ $kategori = $db->query("select * from kategori where id_kategori='{$_GET['id_kategori']}' limit 1")->fetch_assoc(); } ?>
<form method="post" action="">
  <?php echo '<input type="hidden" name="id_kategori" value="'.$kategori['id_kategori'].'" />'; ?>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Nama Kategori</label>
    <div class="col-md-10">
      <input type="text" class="form-control" name="nama_kategori" value="<?php echo $kategori['nama_kategori']; ?>" required />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Keterangan</label>
    <div class="col-md-10">
      <textarea rows="8" id="box" class="form-control" name="ket"><?php echo $kategori['ket']; ?></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Waktu Pengerjaan</label>
    <div class="col-md-3">
      <div class="input-group">
        <input type="text" class="form-control" name="waktu" value="<?php echo $kategori['waktu']; ?>" required />
        <div class="input-group-addon">Menit</div>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Nilai Minimum</label>
    <div class="col-md-3">
      <input type="number" class="form-control" name="nilai_min" value="<?php echo $kategori['nilai_min']; ?>" required />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Publish</label>
    <div class="col-md-10">
      <label class="custom-control custom-radio">
        <input name="publish" type="radio" class="custom-control-input" value="Ya" <?php if($kategori['publish']=='Ya'){ echo ' checked'; } ?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Ya</span>
      </label>
      <label class="custom-control custom-radio">
        <input name="publish" type="radio" class="custom-control-input" value="Tidak" <?php if($kategori['publish']=='Tidak'){ echo ' checked'; } ?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Tidak</span>
      </label>
    </div>
  </div>

  <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
  <a href="?page=kategori" class="btn btn-warning">Batal</a>
</form>
