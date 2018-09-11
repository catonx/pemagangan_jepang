<?php
switch($act){
	case 'add':
		include 'jadwal_add.php';
		break;
	case 'edit':
		include 'jadwal_edit.php';
		break;
	case 'detail':
		include 'jadwal_detail.php';
		break;
	case 'delete':
		include 'jadwal_delete.php';
		break;
	default:
		include 'jadwal_show.php';
}
?>
