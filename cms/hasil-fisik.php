<?php
switch($act){
	case 'detail':
		include 'hasil-fisik_detail.php';
		break;
	case 'edit':
		include 'hasil-fisik_edit.php';
		break;
	case 'reset':
		include 'hasil-fisik_reset.php';
		break;
	case 'resetall':
		include 'hasil-fisik_resetall.php';
		break;
	default:
		include 'hasil-fisik_show.php';
}
?>
