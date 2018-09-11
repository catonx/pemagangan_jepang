<?php
switch($act){
	case 'detail':
		include 'hasil_detail.php';
		break;
	case 'reset':
		include 'hasil_reset.php';
		break;
	case 'resetall':
		include 'hasil_resetall.php';
		break;
	default:
		include 'hasil_show.php';
}
?>
