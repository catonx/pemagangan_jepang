<?php
switch($act){
	case 'test':
		include 'soal_test.php';
		break;
	case 'start':
			include 'soal_mulai.php';
			break;
	default:
		// include 'soal_show.php';
		include 'soal_mulai.php';
}
?>
