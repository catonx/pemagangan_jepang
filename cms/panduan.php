<?php $data=$db->query("select * from panduan order by id_panduan desc limit 1")->fetch_assoc(); ?>
<form method="post" action="">
  <div class="form-group">
    <label>Isi</label>
    <textarea rows="15" class="form-control" name="isi" id="box"><?php echo $data['isi']; ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
	<a href="?page=panduan&kosong=y" class="btn btn-warning">Kosongkan</a>
	<?php echo '<input type="hidden" name="id_panduan" value="'.$data['id_panduan'].'">'; ?>
</form>
<?php
if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
	$id_panduan = $_POST['id_panduan'];
	$isi = trim($_POST['isi']);

	if(!empty($isi)){
		$hit=$db->query("select * from panduan")->num_rows;
		if($hit>0){
			$query="update panduan set isi='{$isi}' where id_panduan='{$id_panduan}' limit 1";
		}else{
			$query="insert into panduan(isi) values('{$isi}')";
		}
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
	$kosong=$db->query("truncate table panduan");
	if($kosong){
		echo '<script>alert("Truncate berhasil");</script>';
		echo '<script>document.location.href="?page='.$page.'";</script>';
	}else{
		echo '<script>alert("Truncate gagal!");</script>';
	}
}
?>
