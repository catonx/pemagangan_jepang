<?php if($act=='edit'){ $soal = $db->query("select * from soal where id_soal='{$_GET['id_soal']}' limit 1")->fetch_assoc(); } ?>
<form method="post" action="">
  <?php echo '<input type="hidden" name="id_soal" value="'.$soal['id_soal'].'" />'; ?>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Pertanyaan</label>
    <div class="col-md-10">
      <input type="text" class="form-control" name="pertanyaan" value="<?php echo $soal['pertanyaan']; ?>" required />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Pilihan A</label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="pilihan_a" value="<?php echo $soal['pilihan_a']; ?>" required />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Pilihan B</label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="pilihan_b" value="<?php echo $soal['pilihan_b']; ?>" required />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Pilihan C</label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="pilihan_c" value="<?php echo $soal['pilihan_c']; ?>" required />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Pilihan D</label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="pilihan_d" value="<?php echo $soal['pilihan_d']; ?>" required />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Jawaban</label>
    <div class="col-md-2">
      <input type="text" class="form-control" name="jawaban" value="<?php echo $soal['jawaban']; ?>" required />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Kategori Soal</label>
    <div class="col-md-5">
      <select class="form-control" name="id_kategori" required>
        <option value=""></option>
        <?php
          $getkat = $db->query("select * from kategori order by nama_kategori");
          while($kat = $getkat->fetch_assoc()){
            echo '<option value="'.$kat['id_kategori'].'"';
            if($kat['id_kategori'] == $soal['id_kategori']){ echo ' selected'; }
            echo '>'.$kat['nama_kategori'].'</option>';
          }
        ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Publish</label>
    <div class="col-md-10">
      <label class="custom-control custom-radio">
        <input name="publish" type="radio" class="custom-control-input" value="Ya" <?php if($soal['publish']=='Ya'){ echo ' checked'; } ?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Ya</span>
      </label>
      <label class="custom-control custom-radio">
        <input name="publish" type="radio" class="custom-control-input" value="Tidak" <?php if($soal['publish']=='Tidak'){ echo ' checked'; } ?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Tidak</span>
      </label>
    </div>
  </div>

  <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
  <a href="?page=soal" class="btn btn-warning">Batal</a>
</form>
