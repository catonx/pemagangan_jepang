<?php $fisik = $db->query("select * from hasil_fisik where id_member = '{$_GET['id_member']}' limit 1")->fetch_assoc(); ?>
<form method="post" action="">
  <?php 
		echo '<input type="hidden" name="id_member" value="'.$_GET['id_member'].'" />'; 
		$member = $db->query("select nama from member where id_member = '{$_GET['id_member']}' limit 1")->fetch_assoc();
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
	
  <a href="?page=hasil-fisik" class="btn btn-warning">Kembali</a>
</form>