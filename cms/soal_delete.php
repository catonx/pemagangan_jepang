<?php
$id_soal = $_GET['id_soal'];
$sql = "delete from soal where id_soal = '{$id_soal}' limit 1";
$query = $db->query($sql);
if($query->errno){
	echo '<script>alert("Query error!\n('.$query->errno.') '.$query->error.'");</script>';
}else{
	echo '<script>alert("Data berhasil dihapus!");</script>';
	echo '<script>window.location.href="?page='.$page.'";</script>';
}
?>
