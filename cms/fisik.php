<div class="alert alert-primary" role="alert">
  <h3>Panduan Penilaian Tes Ketahanan Fisik</h3><hr>
  <p>Keterangan berikut merupakan acuan penilaian Tes Ketahanan Fisik. Klik tombol Simpan untuk merubah nilai acuan !</p>
</div>
<?php $fisik = $db->query("select * from tes_fisik order by id_tes desc limit 1")->fetch_assoc(); ?>
<form method="post" action="">
  <?php echo '<input type="hidden" name="id_tes" value="'.$fisik['id_tes'].'" />'; ?>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Lari 3 Km</label>
		<div class="col-md-3">
			<div class="input-group">
				<input type="text" class="form-control" name="lari" value="<?php echo $fisik['lari']; ?>">
				<div class="input-group-addon">Menit</div>
			</div>
		</div>
  </div>

	<div class="form-group row">
    <label class="col-md-2 col-form-label">Push Up</label>
		<div class="col-md-3">
			<div class="input-group">
				<input type="text" class="form-control" name="push_up" value="<?php echo $fisik['push_up']; ?>">
				<div class="input-group-addon">Kali</div>
			</div>
		</div>
  </div>

	<div class="form-group row">
    <label class="col-md-2 col-form-label">Sit Up</label>
		<div class="col-md-3">
			<div class="input-group">
				<input type="text" class="form-control" name="sit_up" value="<?php echo $fisik['sit_up']; ?>">
				<div class="input-group-addon">Kali</div>
			</div>
		</div>
  </div>

  <button type="submit" class="btn btn-primary" name="simpan" onclick="return confirm('Simpan perubahan?')">Simpan</button>
</form>

<?php
if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
	$id_tes=$_POST['id_tes'];
	$lari=$_POST['lari'];
  $sit_up=$_POST['sit_up'];
  $push_up=$_POST['push_up'];

	if(!empty($lari) && !empty($sit_up) && !empty($push_up)){
		$cekdata = $db->query("select * from tes_fisik")->num_rows;
		if($cekdata > 0){
			$sql = "update tes_fisik set lari='{$lari}', sit_up='{$sit_up}', push_up='{$push_up}' where id_tes = '{$id_tes}'";
		}else{
			$sql = "insert into tes_fisik(lari, sit_up, push_up)
            values('{$lari}','{$sit_up}','{$push_up}')";
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
