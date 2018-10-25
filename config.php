<?php
// Set Error Reporting
error_reporting(0);

// Set Timezone
date_default_timezone_set('Asia/Jakarta');

// Define Database
define('DBHOST', 'localhost');
define('DBUSER', 'bengkelk');
define('DBPASS', '.4h[Ma70Wl9WBj');
define('DBNAME', 'bengkelk_project_magang');

$db = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if($db->connect_errno){
	die('Failed to connect to MySQL.<br>('.$db->connect_errno.') '.$db->connect_error);
}

function tanggal_indo($tanggal)
{
	$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}
?>
