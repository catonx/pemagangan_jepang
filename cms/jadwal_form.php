<?php if($act=='edit'){ $jadwal = $db->query("select * from jadwal where id_jadwal='{$_GET['id_jadwal']}' limit 1")->fetch_assoc(); } ?>
<form method="post" action="">
  <?php echo '<input type="hidden" name="id_jadwal" value="'.$jadwal['id_jadwal'].'" />'; ?>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Tanggal</label>
    <div class="col-md-1">
      <select type="text" class="form-control" name="tgl" required>
				<option value=""></option>
				<?php
					for($tg = 1; $tg <= 31; $tg++){
						echo '<option value="'.$tg.'"';
						if($tg == $jadwal['tgl']){ echo ' selected'; }
						echo '>'.$tg.'</option>';
					}
				?>
			</select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Bulan</label>
    <div class="col-md-3">
      <select type="text" class="form-control" name="bln" required>
				<option value=""></option>
				<?php
					$blAr = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
					foreach($blAr as $bl){
						echo '<option value="'.$bl.'"';
						if($bl == $jadwal['bln']){ echo ' selected'; }
						echo '>'.$bl.'</option>';
					}
				?>
			</select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Tahun</label>
    <div class="col-md-2">
       <select type="text" class="form-control" name="thn" required>
				<option value=""></option>
				<?php
					for($th = 2017; $th <= 2030; $th++){
						echo '<option value="'.$th.'"';
						if($th == $jadwal['thn']){ echo ' selected'; }
						echo '>'.$th.'</option>';
					}
				?>
			</select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Provinsi</label>
    <div class="col-md-5">
       <select type="text" class="form-control" name="provinsi" required>
				<option value=""></option>
				<?php
					$getprov = $db->query("select * from provinsi order by nama_provinsi");
					while($prov = $getprov->fetch_assoc()){
						echo '<option value="'.$prov['nama_provinsi'].'"';
						if($prov['nama_provinsi'] == $jadwal['provinsi']){ echo ' selected'; }
						echo '>'.$prov['nama_provinsi'].'</option>';
					}
				?>
			</select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Publish</label>
    <div class="col-md-10">
      <label class="custom-control custom-radio">
        <input name="publish" type="radio" class="custom-control-input" value="Ya" <?php if($jadwal['publish']=='Ya'){ echo ' checked'; } ?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Ya</span>
      </label>
      <label class="custom-control custom-radio">
        <input name="publish" type="radio" class="custom-control-input" value="Tidak" <?php if($jadwal['publish']=='Tidak'){ echo ' checked'; } ?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Tidak</span>
      </label>
    </div>
  </div>

  <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
  <a href="?page=jadwal" class="btn btn-warning">Batal</a>
</form>
