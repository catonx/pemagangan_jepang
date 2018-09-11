<?php
switch($act){
	case 'detail':
		include 'member_detail.php';
		break;
	case 'delete':
		include 'member_delete.php';
		break;
	default:
		include 'member_show.php';
}
?>
