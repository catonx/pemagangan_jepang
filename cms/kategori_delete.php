<?php
$id_kategori = $_GET['id_kategori'];
$sql = "delete from kategori where id_kategori = '{$id_kategori}' limit 1";
$query = $db->query($sql);
if($query->errno){
	$db->query("delete from soal where id_kategori = '{$id_kategori}'");
	echo '<script>alert("Query error!\n('.$query->errno.') '.$query->error.'");</script>';
}else{
	echo '<script>alert("Data berhasil dihapus!");</script>';
	echo '<script>window.location.href="?page='.$page.'";</script>';
}
?>
