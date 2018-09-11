<?php 
$cekmember = $db->query("select * from jawaban where id_member = '{$_SESSION['id_member']}'")->num_rows;
$query = $db->query("select * from hasil_kesemaptaan where id_member = '{$_SESSION['id_member']}' limit 1"); 
$kesemaptaan = $query->fetch_assoc();
$cekkesemaptaan = $query->num_rows;

if($cekmember > 0 && $cekkesemaptaan > 0){
	if($kesemaptaan['ket']=='Lulus'){
	$query = $db->query("select * from hasil_fisik where id_member = '{$_SESSION['id_member']}' limit 1"); 
	$fisik = $query->fetch_assoc();
	$cekfisik = $query->num_rows;
		if($cekfisik > 0){
			if($fisik['ket']=='Lulus'){
				echo '<div class="alert alert-success">Anda <strong>Lulus</strong> Tes Ketahanan Fisik</div>';
			}else{
				echo '<div class="alert alert-danger">Anda <strong>Tidak Lulus</strong> Tes Ketahanan Fisik</div>';			
			}
?>

<form method="post" action="">
  <?php 
		echo '<input type="hidden" name="id_member" value="'.$_SESSION['id_member'].'" />'; 
		$member = $db->query("select nama from member where id_member = '{$_SESSION['id_member']}' limit 1")->fetch_assoc();
		$cek = $db->query("select * from tes_fisik")->fetch_assoc();
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
				<input type="text" class="form-control" value="<?php echo $fisik['lari']; ?>" readonly>
				<div class="input-group-addon">Menit</div>
			</div>
			<?php if($fisik['lari'] > $cek['lari']){ echo '<div class="form-text text-danger">Tidak Lulus</div>'; }else{ echo '<div class="form-text text-success">Lulus</div>'; } ?>
		</div>
  </div>
	
	<div class="form-group row">
    <label class="col-md-2 col-form-label">Push Up</label>
		<div class="col-md-3">
			<div class="input-group">
				<input type="text" class="form-control" value="<?php echo $fisik['push_up']; ?>" readonly>
				<div class="input-group-addon">Kali</div>
			</div>
			<?php if($fisik['push_up'] < $cek['push_up']){ echo '<div class="form-text text-danger">Tidak Lulus</div>'; }else{ echo '<div class="form-text text-success">Lulus</div>'; } ?>
		</div>
  </div>
	
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Sit Up</label>
    <div class="col-md-3">
			<div class="input-group">
				<input type="text" class="form-control" value="<?php echo $fisik['sit_up']; ?>" readonly>
				<div class="input-group-addon">Kali</div>
			</div>
			<?php if($fisik['sit_up'] < $cek['sit_up']){ echo '<div class="form-text text-danger">Tidak Lulus</div>'; }else{ echo '<div class="form-text text-success">Lulus</div>'; } ?>
    </div>
  </div>
	
</form>

<?php
		}else{
			echo '<div class="alert alert-info">Anda belum mengikuti Tes Ketahanan Fisik</div>';
		}
	}else{
		echo '<div class="alert alert-danger">Anda <strong>Tidak Lulus</strong> Tes Kesemaptaan</div>';
	}
}else{
	echo '<div class="alert alert-info">Anda belum mengikuti Psikotes dan Tes Kesemaptaan</div>';
}
?>