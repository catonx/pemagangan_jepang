<?php
switch($act){
	case 'add':
		include 'provinsi_add.php';
		break;
	case 'edit':
		include 'provinsi_edit.php';
		break;
	case 'detail':
		include 'provinsi_detail.php';
		break;
	case 'delete':
		include 'provinsi_delete.php';
		break;
	default:
		include 'provinsi_show.php';
}
?>
