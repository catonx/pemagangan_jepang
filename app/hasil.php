<?php
switch($act){
	case 'detail_category':
		include 'hasil_show.php';
		break;
	case 'detail':
			include 'hasil_detail.php';
			break;
	default:
		include 'hasil_detail_periode.php';
}
?>
