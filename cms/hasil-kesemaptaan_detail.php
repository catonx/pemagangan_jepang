<?php $kesemaptaan = $db->query("select * from hasil_kesemaptaan where id_member = '{$_GET['id_member']}' limit 1")->fetch_assoc(); ?>
<form method="post" action="">
  <?php
		echo '<input type="hidden" name="id_member" value="'.$_GET['id_member'].'" />';
		$member = $db->query("select nama from member where id_member = '{$_GET['id_member']}' limit 1")->fetch_assoc();
		$cek = $db->query("select * from tes_kesemaptaan")->fetch_assoc();
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
				<input type="text" class="form-control" value="<?php echo $kesemaptaan['tinggi']; ?>" readonly>
				<div class="input-group-addon">cm</div>
			</div>
			<?php
        if (empty($kesemaptaan['tinggi'])) {
          echo '<div class="form-text text-warning">Belum Dinilai</div>';
        }elseif($kesemaptaan['tinggi'] < $cek['tinggi']){
          echo '<div class="form-text text-danger">Tidak Lulus</div>';
        }else{
          echo '<div class="form-text text-success">Lulus</div>';
        }
      ?>
		</div>
  </div>

	<div class="form-group row">
    <label class="col-md-2 col-form-label">Berat</label>
		<div class="col-md-3">
			<div class="input-group">
				<input type="text" class="form-control" value="<?php echo $kesemaptaan['berat']; ?>" readonly>
				<div class="input-group-addon">Kg</div>
			</div>
			<?php
        if (empty($kesemaptaan['berat'])) {
          echo '<div class="form-text text-warning">Belum Dinilai</div>';
        }elseif($kesemaptaan['berat'] < $cek['berat']){
          echo '<div class="form-text text-danger">Tidak Lulus</div>';
        }else{
          echo '<div class="form-text text-success">Lulus</div>';
        }
      ?>
		</div>
  </div>

  <div class="form-group row">
    <label class="col-md-2 col-form-label">Bertato</label>
    <div class="col-md-3">
			<input type="text" class="form-control" value="<?php echo $kesemaptaan['bertato']; ?>" readonly>
			<?php
        if (empty($kesemaptaan['bertato'])) {
          echo '<div class="form-text text-warning">Belum Dinilai</div>';
        }elseif($kesemaptaan['bertato'] != $cek['bertato']){
          echo '<div class="form-text text-danger">Tidak Lulus</div>';
        }else{
          echo '<div class="form-text text-success">Lulus</div>';
        }
      ?>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-2 col-form-label">Bertindik</label>
    <div class="col-md-3">
			<input type="text" class="form-control" value="<?php echo $kesemaptaan['bertindik']; ?>" readonly>
			<?php
        if (empty($kesemaptaan['bertindik'])) {
          echo '<div class="form-text text-warning">Belum Dinilai</div>';
        }elseif($kesemaptaan['bertindik'] != $cek['bertindik']){
          echo '<div class="form-text text-danger">Tidak Lulus</div>';
        }else{
          echo '<div class="form-text text-success">Lulus</div>';
        }
      ?>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-2 col-form-label">Cacat Tubuh</label>
    <div class="col-md-3">
			<input type="text" class="form-control" value="<?php echo $kesemaptaan['cacat_tubuh']; ?>" readonly>
			<?php
        if (empty($kesemaptaan['cacat_tubuh'])) {
          echo '<div class="form-text text-warning">Belum Dinilai</div>';
        }elseif($kesemaptaan['cacat_tubuh'] != $cek['cacat_tubuh']){
          echo '<div class="form-text text-danger">Tidak Lulus</div>';
        }else{
          echo '<div class="form-text text-success">Lulus</div>';
        }
      ?>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-2 col-form-label">Patah Tulang</label>
    <div class="col-md-3">
			<input type="text" class="form-control" value="<?php echo $kesemaptaan['patah_tulang']; ?>" readonly>
			<?php
        if (empty($kesemaptaan['patah_tulang'])) {
          echo '<div class="form-text text-warning">Belum Dinilai</div>';
        }
        elseif($kesemaptaan['patah_tulang'] != $cek['patah_tulang']){
          echo '<div class="form-text text-danger">Tidak Lulus</div>';
        }else{
          echo '<div class="form-text text-success">Lulus</div>';
        }
      ?>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-2 col-form-label">Penyakit Kulit</label>
    <div class="col-md-3">
			<input type="text" class="form-control" value="<?php echo $kesemaptaan['penyakit_kulit']; ?>" readonly>
			<?php
        if (empty($kesemaptaan['penyakit_kulit'])) {
          echo '<div class="form-text text-warning">Belum Dinilai</div>';
        }
        elseif($kesemaptaan['penyakit_kulit'] != $cek['penyakit_kulit']){
          echo '<div class="form-text text-danger">Tidak Lulus</div>';
        }else{
          echo '<div class="form-text text-success">Lulus</div>';
        }
      ?>
    </div>
  </div>

  <a href="?page=hasil-kesemaptaan" class="btn btn-warning">Kembali</a>
</form>
