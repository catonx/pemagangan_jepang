<?php $fisik = $db->query("select * from hasil_fisik where id_member = '{$_GET['id_member']}' limit 1")->fetch_assoc(); ?>
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
	$id_member=$_POST['id_member'];
	$lari=$_POST['lari'];
  $push_up=$_POST['push_up'];
  $sit_up=$_POST['sit_up'];

	$cek = $db->query("select * from tes_fisik")->fetch_assoc();
	if($lari>$cek['lari'] || $push_up<$cek['push_up'] || $sit_up<$cek['sit_up']){
		$ket = 'Tidak Lulus';
	}else{
		$ket = 'Lulus';
	}

	if(!empty($lari) && !empty($push_up) && !empty($sit_up)){
		
		$cekdata = $db->query("select * from hasil_fisik where id_member = '{$id_member}'")->num_rows;
		if($cekdata > 0){
			$sql = "update hasil_fisik set lari='{$lari}', push_up='{$push_up}', sit_up='{$sit_up}', ket='{$ket}' 
							where id_member = '{$id_member}'";
		}else{
			$sql = "insert into hasil_fisik(id_member,lari, push_up, sit_up, ket)
						values('{$id_member}','{$lari}','{$push_up}','{$sit_up}','{$ket}')";
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
