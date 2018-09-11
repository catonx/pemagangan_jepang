<?php $kategori = $db->query("select * from kategori where id_kategori='{$_GET['id_kategori']}' limit 1")->fetch_assoc(); ?>
<form>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Nama Kategori</label>
    <div class="col-md-10">
      <input type="text" class="form-control" value="<?php echo $kategori['nama_kategori']; ?>" readonly />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Keterangan</label>
    <div class="col-md-10">
      <div class="alert alert-secondary"><?php echo $kategori['ket']; ?></div>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Waktu Pengerjaan</label>
    <div class="col-md-3">
      <div class="input-group">
        <input type="text" class="form-control" value="<?php echo $kategori['waktu']; ?>" readonly />
        <div class="input-group-addon">Menit</div>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Nilai Minimum</label>
    <div class="col-md-3">
      <input type="text" class="form-control" value="<?php echo $kategori['nilai_min']; ?>" readonly />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Publish</label>
    <div class="col-md-3">
      <input type="text" class="form-control" value="<?php echo $kategori['publish']; ?>" readonly />
    </div>
  </div>

  <a href="?page=kategori&act=edit&id_kategori=<?php echo $kategori['id_kategori']; ?>" class="btn btn-primary">Edit</a>
  <a href="?page=kategori" class="btn btn-warning">Batal</a>
</form>
