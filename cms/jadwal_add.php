<?php
include 'jadwal_form.php';

if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
	$tgl=trim($_POST['tgl']);
  $bln=trim($_POST['bln']);
	// $bln = $bln + 1;
  $thn=trim($_POST['thn']);
  $provinsi=trim($_POST['provinsi']);
  $publish=trim($_POST['publish']);
	$jadwal = $thn."-".$bln."-".$tgl;

	if(!empty($tgl) && !empty($bln) && !empty($thn) && !empty($provinsi) && !empty($publish)){
		$sql = "insert into jadwal(provinsi, publish, jadwal)
            values('{$provinsi}','{$publish}','{$jadwal}')";

    $query = $db->query($sql);
    if($db->error){
			echo '<script>alert("Query error!\n('.$query->errno.') '.$db->error.'");</script>';
		}else{
			echo '<script>alert("Data berhasil disimpan!");</script>';
			echo '<script>window.location.href="?page='.$page.'";</script>';
		}
	}else{
		echo '<script>alert("Data belum lengkap!");</script>';
	}
}
?>
