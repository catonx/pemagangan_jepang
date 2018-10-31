<?php
include 'jadwal_form.php';
if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
  // var_dump($_POST);
  // exit;
  $id_jadwal=$_POST['id_jadwal'];
  $tgl=trim($_POST['tgl']);
  $bln=trim($_POST['bln']);
  $thn=trim($_POST['thn']);
  $provinsi=trim($_POST['provinsi']);
  $publish=trim($_POST['publish']);
	$jadwal = $thn."-".$bln."-".$tgl;

  if(!empty($tgl) && !empty($bln) && !empty($thn) && !empty($provinsi) && !empty($publish)){
		$sql = "update jadwal set provinsi='{$provinsi}', publish='{$publish}', jadwal='{$jadwal}'
            where id_jadwal='{$id_jadwal}' limit 1";
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
