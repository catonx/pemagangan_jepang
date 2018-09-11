<?php $kesemaptaan = $db->query("select * from hasil_kesemaptaan where id_member = '{$_GET['id_member']}' limit 1")->fetch_assoc(); ?>
<form method="post" action="">
  <?php 
		echo '<input type="hidden" name="id_member" value="'.$_GET['id_member'].'" />'; 
		$member = $db->query("select nama from member where id_member = '{$_GET['id_member']}' limit 1")->fetch_assoc();
	?>
	
  <div class="form-group row">
    <label class="col-md-2 col-form-label">ID Member</label>
		<div class="col-md-3">
			<input type="text" class="form-control" value="<?php echo $_GET['id_member']; ?>" readonly>
		</div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Nama Member</label>
		<div class="col-md-3">
			<input type="text" class="form-control" value="<?php echo $member['nama']; ?>" readonly>
		</div>
  </div>
	<hr>
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
	$id_member=$_POST['id_member'];
	$tinggi=$_POST['tinggi'];
  $berat=$_POST['berat'];
  $bertato=$_POST['bertato'];
  $bertindik=$_POST['bertindik'];
  $cacat_tubuh=$_POST['cacat_tubuh'];
  $patah_tulang=$_POST['patah_tulang'];
  $penyakit_kulit=$_POST['penyakit_kulit'];

	$cek = $db->query("select * from tes_kesemaptaan")->fetch_assoc();
	if($tinggi<$cek['tinggi'] || $berat<$cek['berat'] || $bertato!=$cek['bertato'] || $bertindik!=$cek['bertindik'] || $cacat_tubuh!=$cek['cacat_tubuh'] || $patah_tulang!=$cek['patah_tulang'] || $penyakit_kulit!=$cek['penyakit_kulit']){
		$ket = 'Tidak Lulus';
	}else{
		$ket = 'Lulus';
	}

	if(!empty($tinggi) && !empty($berat) && !empty($bertato) && !empty($bertindik) && !empty($patah_tulang) && !empty($penyakit_kulit) && !empty($cacat_tubuh)){
		
		$cekdata = $db->query("select * from hasil_kesemaptaan where id_member = '{$id_member}'")->num_rows;
		if($cekdata > 0){
			$sql = "update hasil_kesemaptaan set tinggi='{$tinggi}', berat='{$berat}', bertato='{$bertato}', bertindik='{$bertindik}', patah_tulang='{$patah_tulang}', penyakit_kulit='{$penyakit_kulit}',cacat_tubuh='{$cacat_tubuh}', ket='{$ket}' 
							where id_member = '{$id_member}'";
		}else{
			$sql = "insert into hasil_kesemaptaan(id_member,tinggi, berat, bertato, bertindik, patah_tulang, penyakit_kulit, cacat_tubuh, ket)
						values('{$id_member}','{$tinggi}','{$berat}','{$bertato}','{$bertindik}','{$patah_tulang}','{$penyakit_kulit}','{$cacat_tubuh}', '{$ket}')";
		}
		
		$query = $db->query($sql);
		if($query->errno){
			echo '<script>alert("Query error!\n('.$query->errno.') '.$query->error.'");</script>';
		}else{
			echo '<script>alert("Data berhasil disimpan!");</script>';
			echo '<script>window.location.href="?page='.$page.'&id_member='.$id_member.'";</script>';
		}
		
	}else{
		echo '<script>alert("Data belum lengkap!");</script>';
	}
}
?>
