<?php
switch($act){
	case 'add':
		include 'soal_add.php';
		break;
	case 'edit':
		include 'soal_edit.php';
		break;
	case 'detail':
		include 'soal_detail.php';
		break;
	case 'delete':
		include 'soal_delete.php';
		break;
	default:
		include 'soal_show.php';
}
?>
