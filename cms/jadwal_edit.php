<?php
include 'jadwal_form.php';

if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
  $id_jadwal=$_POST['id_jadwal'];
	$tgl=trim($_POST['tgl']);
  $bln=trim($_POST['bln']);
  $thn=trim($_POST['thn']);
  $provinsi=trim($_POST['provinsi']);
  $publish=trim($_POST['publish']);

  if(!empty($tgl) && !empty($bln) && !empty($thn) && !empty($provinsi) && !empty($publish)){    
		$sql = "update jadwal set tgl='{$tgl}',
                            bln='{$bln}',
                            thn='{$thn}',
                            provinsi='{$provinsi}',
                            publish='{$publish}' 
            where id_jadwal='{$id_jadwal}' limit 1";
    $query = $db->query($sql);
    if($query->errno){
			echo '<script>alert("Query error!\n('.$query->errno.') '.$query->error.'");</script>';
		}else{
			echo '<script>alert("Data berhasil disimpan!");</script>';
			echo '<script>window.location.href="?page='.$page.'";</script>';
		}
	}else{
		echo '<script>alert("Data belum lengkap!");</script>';
	}
}
?>
