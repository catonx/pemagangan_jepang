<?php
switch($act){
	case 'add':
		include 'kategori_add.php';
		break;
	case 'edit':
		include 'kategori_edit.php';
		break;
	case 'detail':
		include 'kategori_detail.php';
		break;
	case 'delete':
		include 'kategori_delete.php';
		break;
	default:
		include 'kategori_show.php';
}
?>
