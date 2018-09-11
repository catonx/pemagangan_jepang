<?php
include 'soal_form.php';

if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
  $id_soal=$_POST['id_soal'];
	$pertanyaan=trim($_POST['pertanyaan']);
  $pilihan_a=trim($_POST['pilihan_a']);
  $pilihan_b=trim($_POST['pilihan_b']);
  $pilihan_c=trim($_POST['pilihan_c']);
  $pilihan_d=trim($_POST['pilihan_d']);
  $jawaban=trim($_POST['jawaban']);
  $publish=trim($_POST['publish']);
  $id_kategori=$_POST['id_kategori'];

	if(!empty($pertanyaan) && !empty($pilihan_a) && !empty($pilihan_b) && !empty($pilihan_c) && !empty($pilihan_d) && !empty($jawaban) && !empty($publish)){
		$sql = "update soal set pertanyaan='{$pertanyaan}',
                            pilihan_a='{$pilihan_a}',
                            pilihan_b='{$pilihan_b}',
                            pilihan_c='{$pilihan_c}',
                            pilihan_d='{$pilihan_d}',
                            jawaban='{$jawaban}',
                            publish='{$publish}',
                            id_kategori='{$id_kategori}' 
            where id_soal='{$id_soal}' limit 1";
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
