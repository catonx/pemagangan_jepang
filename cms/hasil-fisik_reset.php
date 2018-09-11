<?php
$id_member = $_GET['id_member'];
$sql = "delete from hasil_fisik where id_member = '{$id_member}'";
$query = $db->query($sql);
if($query->errno){
	echo '<script>alert("Query error!\n('.$query->errno.') '.$query->error.'");</script>';
}else{
	echo '<script>alert("Data berhasil dihapus!");</script>';
	echo '<script>window.location.href="?page='.$page.'";</script>';
}
?>
