<?php
include 'kategori_form.php';

if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
  $id_kategori=$_POST['id_kategori'];
  	$nama_kategori=trim($_POST['nama_kategori']);
  	$ket=trim($_POST['ket']);
  	$waktu=trim($_POST['waktu']);
  	$nilai_min=trim($_POST['nilai_min']);
    $publish=trim($_POST['publish']);

  if(!empty($nama_kategori) && !empty($ket) && !empty($waktu) && !empty($nilai_min) && !empty($publish)){
		$sql = "update kategori set nama_kategori='{$nama_kategori}', ket='{$ket}', waktu='{$waktu}', nilai_min='{$nilai_min}', publish='{$publish}' 
            where id_kategori='{$id_kategori}' limit 1";
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
