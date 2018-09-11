<?php
$id_provinsi = $_GET['id_provinsi'];
$sql = "delete from provinsi where id_provinsi = '{$id_provinsi}' limit 1";
$query = $db->query($sql);
if($query->errno){
	echo '<script>alert("Query error!\n('.$query->errno.') '.$query->error.'");</script>';
}else{
	echo '<script>alert("Data berhasil dihapus!");</script>';
	echo '<script>window.location.href="?page='.$page.'";</script>';
}
?>
