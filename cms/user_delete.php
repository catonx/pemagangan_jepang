<?php
$id_user = $_GET['id_user'];
$sql = "delete from user where id_user = '{$id_user}' limit 1";
$query = $db->query($sql);
if($query->errno){
	echo '<script>alert("Query error!\n('.$query->errno.') '.$query->error.'");</script>';
}else{
	echo '<script>alert("Data berhasil dihapus!");</script>';
	echo '<script>window.location.href="?page='.$page.'";</script>';
}
?>
