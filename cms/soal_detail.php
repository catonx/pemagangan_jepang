<?php
$sql = "select s.*, k.nama_kategori
        from soal s left join kategori k
        on s.id_kategori = k.id_kategori
        where s.id_soal = '{$_GET['id_soal']}' 
        order by s.id_soal desc";
$soal = $db->query($sql)->fetch_assoc();
?>
<form>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Pertanyaan</label>
    <div class="col-md-10">
      <input type="text" class="form-control" value="<?php echo $soal['pertanyaan']; ?>" readonly />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Pilihan A</label>
    <div class="col-md-5">
      <input type="text" class="form-control" value="<?php echo $soal['pilihan_a']; ?>" readonly />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Pilihan B</label>
    <div class="col-md-5">
      <input type="text" class="form-control" value="<?php echo $soal['pilihan_b']; ?>" readonly />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Pilihan C</label>
    <div class="col-md-5">
      <input type="text" class="form-control" value="<?php echo $soal['pilihan_c']; ?>" readonly />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Pilihan D</label>
    <div class="col-md-5">
      <input type="text" class="form-control" value="<?php echo $soal['pilihan_d']; ?>" readonly />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Jawaban</label>
    <div class="col-md-2">
      <input type="text" class="form-control" value="<?php echo $soal['jawaban']; ?>" readonly />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Kategori Soal</label>
    <div class="col-md-2">
      <input type="text" class="form-control" value="<?php echo $soal['nama_kategori']; ?>" readonly />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Publish</label>
    <div class="col-md-2">
      <input type="text" class="form-control" value="<?php echo $soal['publish']; ?>" readonly />
    </div>
  </div>

  <a href="?page=soal&act=edit&id_soal=<?php echo $soal['id_soal']; ?>" class="btn btn-primary">Edit</a>
  <a href="?page=soal" class="btn btn-warning">Batal</a>
</form>
