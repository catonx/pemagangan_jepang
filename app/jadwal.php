<?php
if(empty($member['provinsi']) || empty($member['th_pelaksanaan']) || empty($member['kelamin']) || empty($member['agama']) || empty($member['tempat_lahir']) || empty($member['tgl_lahir']) || empty($member['alamat'])){
  echo '<div class="alert alert-info">
  Silahkan lengkapi biodata terlebih dahulu.
  </div>';
}else{
?>
<form method="post" action="">
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Tanggal</label>
    <div class="col-md-4">
    <?php
      if(!empty($member['id_jadwal'])){
        $gettgl = $db->query("select * from jadwal where id_jadwal = '{$member['id_jadwal']}' limit 1");
        $tgljadwal = $gettgl->fetch_assoc();
        echo '<input type="text" class="form-control" value="'.$tgljadwal['tgl'].' '.$tgljadwal['bln'].' '.$tgljadwal['thn'].'" readonly />';
      }else{
    ?>
      <select type="text" class="form-control" name="id_jadwal" required>
				<option value=""></option>
				<?php
					$getjadwal = $db->query("select * from jadwal where publish = 'Ya' and provinsi = '{$member['provinsi']}'");
          while($jadwal = $getjadwal->fetch_assoc()){
            echo '<option value="'.$jadwal['id_jadwal'].'">'.$jadwal['tgl'].' '.$jadwal['bln'].' '.$jadwal['thn'].'</option>';
          }
				?>
			</select>
    <?php } ?>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 col-form-label">Provinsi</label>
    <div class="col-md-10">
      <input type="text" class="form-control" value="<?php echo $member['provinsi']; ?>" readonly>
    </div>
  </div>
  <?php
    if(empty($member['id_jadwal'])){
      echo '<button type="submit" class="btn btn-primary" name="simpan" onclick="return confirm(\'Anda yakin ingin menyimpan data ini?\nData yang sudah tersimpan tidak dapat diedit.\')">Simpan</button>';
    }
  ?>
</form>
<?php
  if(empty($member['id_jadwal'])){
    echo '<br />
    <div class="alert alert-danger">
      <i class="fa fa-fw fa-warning"></i>Tentukan jadwal tes dengan hati-hati. Jadwal tes tidak dapat diganti setelah disimpan.
    </div>';
  }
  
  if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $id_jadwal = $_POST['id_jadwal'];
    if(!empty($id_jadwal)){
      $sql = "update member set id_jadwal = '{$id_jadwal}' where id_member = '{$_SESSION['id_member']}' limit 1";
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
}
?>
