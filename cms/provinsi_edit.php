<?php
include 'provinsi_form.php';

if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
  $id_provinsi=$_POST['id_provinsi'];
	$nama_provinsi=trim($_POST['nama_provinsi']);

	if(!empty($nama_provinsi)){
		$sql = "update provinsi set nama_provinsi='{$nama_provinsi}' where id_provinsi='{$id_provinsi}' limit 1";
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
