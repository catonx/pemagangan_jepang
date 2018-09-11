<?php $kesemaptaan = $db->query("select * from tes_kesemaptaan order by id_tes desc limit 1")->fetch_assoc(); ?>
<form method="post" action="">
  <?php echo '<input type="hidden" name="id_tes" value="'.$kesemaptaan['id_tes'].'" />'; ?>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Tinggi</label>
		<div class="col-md-3">
			<div class="input-group">
				<input type="text" class="form-control" name="tinggi" value="<?php echo $kesemaptaan['tinggi']; ?>">
				<div class="input-group-addon">cm</div>
			</div>
		</div>
  </div>
	
	<div class="form-group row">
    <label class="col-md-2 col-form-label">Berat</label>
		<div class="col-md-3">
			<div class="input-group">
				<input type="text" class="form-control" name="berat" value="<?php echo $kesemaptaan['berat']; ?>">
				<div class="input-group-addon">Kg</div>
			</div>
		</div>
  </div>
	
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Bertato</label>
    <div class="col-md-10">
      <label class="custom-control custom-radio">
        <input name="bertato" type="radio" class="custom-control-input" value="Ya" <?php if($kesemaptaan['bertato']=='Ya'){ echo ' checked'; } ?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Ya</span>
      </label>
      <label class="custom-control custom-radio">
        <input name="bertato" type="radio" class="custom-control-input" value="Tidak" <?php if($kesemaptaan['bertato']=='Tidak'){ echo ' checked'; } ?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Tidak</span>
      </label>
    </div>
  </div>
	
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Bertindik</label>
    <div class="col-md-10">
      <label class="custom-control custom-radio">
        <input name="bertindik" type="radio" class="custom-control-input" value="Ya" <?php if($kesemaptaan['bertindik']=='Ya'){ echo ' checked'; } ?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Ya</span>
      </label>
      <label class="custom-control custom-radio">
        <input name="bertindik" type="radio" class="custom-control-input" value="Tidak" <?php if($kesemaptaan['bertindik']=='Tidak'){ echo ' checked'; } ?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Tidak</span>
      </label>
    </div>
  </div>
	
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Cacat Tubuh</label>
    <div class="col-md-10">
      <label class="custom-control custom-radio">
        <input name="cacat_tubuh" type="radio" class="custom-control-input" value="Ya" <?php if($kesemaptaan['cacat_tubuh']=='Ya'){ echo ' checked'; } ?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Ya</span>
      </label>
      <label class="custom-control custom-radio">
        <input name="cacat_tubuh" type="radio" class="custom-control-input" value="Tidak" <?php if($kesemaptaan['cacat_tubuh']=='Tidak'){ echo ' checked'; } ?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Tidak</span>
      </label>
    </div>
  </div>
	
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Patah Tulang</label>
    <div class="col-md-10">
      <label class="custom-control custom-radio">
        <input name="patah_tulang" type="radio" class="custom-control-input" value="Ya" <?php if($kesemaptaan['patah_tulang']=='Ya'){ echo ' checked'; } ?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Ya</span>
      </label>
      <label class="custom-control custom-radio">
        <input name="patah_tulang" type="radio" class="custom-control-input" value="Tidak" <?php if($kesemaptaan['patah_tulang']=='Tidak'){ echo ' checked'; } ?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Tidak</span>
      </label>
    </div>
  </div>
	
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Penyakit Kulit</label>
    <div class="col-md-10">
      <label class="custom-control custom-radio">
        <input name="penyakit_kulit" type="radio" class="custom-control-input" value="Ya" <?php if($kesemaptaan['penyakit_kulit']=='Ya'){ echo ' checked'; } ?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Ya</span>
      </label>
      <label class="custom-control custom-radio">
        <input name="penyakit_kulit" type="radio" class="custom-control-input" value="Tidak" <?php if($kesemaptaan['penyakit_kulit']=='Tidak'){ echo ' checked'; } ?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Tidak</span>
      </label>
    </div>
  </div>
	
  <button type="submit" class="btn btn-primary" name="simpan" onclick="return confirm('Simpan perubahan?')">Simpan</button>
</form>

<?php
if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
	$id_tes=$_POST['id_tes'];
	$tinggi=$_POST['tinggi'];
  $berat=$_POST['berat'];
  $bertato=$_POST['bertato'];
  $bertindik=$_POST['bertindik'];
  $cacat_tubuh=$_POST['cacat_tubuh'];
  $patah_tulang=$_POST['patah_tulang'];
  $penyakit_kulit=$_POST['penyakit_kulit'];

	if(!empty($tinggi) && !empty($berat) && !empty($bertato) && !empty($bertindik) && !empty($cacat_tubuh) && !empty($patah_ulang) && !empty($penyakit_kulit)){
		$cekdata = $db->query("select * from tes_kesemaptaan")->num_rows;
		if($cekdata > 0){
			$sql = "update tes_kesemaptaan set tinggi='{$tinggi}', berat='{$berat}', bertato='{$bertato}', bertindik='{$bertindik}', patah_tulang='{$patah_tulang}', penyakit_kulit='{$penyakit_kulit}',cacat_tubuh='{$cacat_tubuh}' 
							where id_tes = '{$id_tes}'";
		}else{
			$sql = "insert into tes_kesemaptaan(tinggi, berat, bertato, bertindik, patah_tulang, penyakit_kulit, cacat_tubuh)
            values('{$tinggi}','{$berat}','{$bertato}','{$bertindik}','{$patah_tulang}','{$penyakit_kulit}','{$cacat_tubuh}')";
		}
		
    $query = $db->query($sql);
    if($query->errno){
			echo '<script>alert("Query error!\n('.$query->errno.') '.$query->error.'");</script>';
		}else{
			echo '<script>alert("Data berhasil disimpan!");</script>';
			echo '<script>window.location.href="?page='.$page.'";</script>';
		}
	}else{
		echo '<script>alert("Data belum lengkap!");</script>';
	}
}
?>
