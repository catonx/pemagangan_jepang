<?php
$id_jadwal = $_GET['id_jadwal'];
$sql = "delete from jadwal where id_jadwal = '{$id_jadwal}' limit 1";
$query = $db->query($sql);
if($query->errno){
	echo '<script>alert("Query error!\n('.$query->errno.') '.$query->error.'");</script>';
}else{
	echo '<script>alert("Data berhasil dihapus!");</script>';
	echo '<script>window.location.href="?page='.$page.'";</script>';
}
?>
