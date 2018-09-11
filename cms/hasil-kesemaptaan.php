<?php
switch($act){
	case 'detail':
		include 'hasil-kesemaptaan_detail.php';
		break;
	case 'edit':
		include 'hasil-kesemaptaan_edit.php';
		break;
	case 'reset':
		include 'hasil-kesemaptaan_reset.php';
		break;
	case 'resetall':
		include 'hasil-kesemaptaan_resetall.php';
		break;
	default:
		include 'hasil-kesemaptaan_show.php';
}
?>
