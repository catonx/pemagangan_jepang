<?php
include 'kategori_form.php';

if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
	$nama_kategori=trim($_POST['nama_kategori']);
	$ket=trim($_POST['ket']);
	$waktu=trim($_POST['waktu']);
	$nilai_min=trim($_POST['nilai_min']);
  $publish=trim($_POST['publish']);

	if(!empty($nama_kategori) && !empty($ket) && !empty($waktu) && !empty($nilai_min) && !empty($publish)){
		$sql = "insert into kategori(nama_kategori, ket, waktu, nilai_min, publish) values('{$nama_kategori}','{$ket}','{$waktu}','{$nilai_min}','{$publish}')";
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
