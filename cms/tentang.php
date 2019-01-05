<?php $data=$db->query("select * from tentang order by id_tentang desc limit 1")->fetch_assoc(); ?>
<form method="post" action="">
  <div class="form-group">
    <label>Isi</label>
    <textarea rows="15" class="form-control" name="isi" id="box"><?php echo $data['isi']; ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
	<a href="?page=tentang&kosong=y" class="btn btn-warning">Kosongkan</a>
	<?php echo '<input type="hidden" name="id_tentang" value="'.$data['id_tentang'].'">'; ?>
</form>
<?php
if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
	$id_tentang = $_POST['id_tentang'];
	$isi = trim($_POST['isi']);

  // var_dump($_POST);

	if(!empty($isi)){
		$hit=$db->query("select * from tentang")->num_rows;
		if($hit>0){
			$query="update tentang set isi='{$isi}' where id_tentang='{$id_tentang}' limit 1";
		}else{
			$query="insert into tentang(isi) values('{$isi}')";
		}
    // var_dump($query);
		$in=$db->query($query);
		if($in){
			echo '<script>alert("Data berhasil disimpan");</script>';
			echo '<script>document.location.href="?page='.$page.'";</script>';
		}else{
			echo '<script>alert("Insert gagal!");</script>';
		}
	}else{
		echo '<script>alert("Data belum lengkap!");</script>';
	}
}elseif(isset($_GET['kosong'])=='y'){
	$kosong=$db->query("truncate table tentang");
	if($kosong){
		echo '<script>alert("Truncate berhasil");</script>';
		echo '<script>document.location.href="?page='.$page.'";</script>';
	}else{
		echo '<script>alert("Truncate gagal!");</script>';
	}
}
?>
