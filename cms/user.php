<?php
switch($act){
	case 'add':
		include 'user_add.php';
		break;
	case 'edit':
		include 'user_edit.php';
		break;
	case 'detail':
		include 'user_detail.php';
		break;
	case 'delete':
		include 'user_delete.php';
		break;
	default:
		include 'user_show.php';
}
?>
