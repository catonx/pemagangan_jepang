<?php
$kat = $db->query("select * from kategori where publish = 'Ya' and id_kategori = '{$_GET['id_kategori']}' limit 1")->fetch_assoc();

echo '<div class="card border-primary mb-3">
        <div class="card-header bg-primary text-light">
					<div class="float-left">
						<h5><i class="fa fa-tag fa-fw"></i>'.$kat['nama_kategori'].'</h5>
					</div>';
    if(!empty($_GET['hal'])){
      echo '<div class="float-right"><h5>Sisa Waktu: <span id="timer" class="text-warning"></span></h5></div>';
    }
    echo '</div>';
if(empty($_GET['hal'])){
  echo '<div class="card-body">'.$kat['ket'].'</div>
    <div class="card-footer">
      <a href="?page=soal" class="btn btn-warning">Batal</a>
      <a href="?page=soal&act=test&id_kategori='.$kat['id_kategori'].'&hal=1" class="btn btn-success">Mulai Tes</a>
    </div>';
}elseif($_GET['hal'] == 'end'){
  header('location:?page=soal');
}else{
  //untuk memulai session
   session_start();

   //set session dulu dengan nama $_SESSION["mulai"]
  if (isset($_SESSION["mulai"])) {
     //jika session sudah ada
     $telah_berlalu = time() - $_SESSION["mulai"];
  } else {
     //jika session belum ada
     $_SESSION["mulai"]  = time();
     $telah_berlalu      = 0;
  }

  $temp_waktu = ($kat['waktu']*60) - $telah_berlalu; //dijadikan detik dan dikurangi waktu yang berlalu
  $temp_menit = (int)($temp_waktu/60);                //dijadikan menit lagi
  $temp_detik = $temp_waktu%60;                       //sisa bagi untuk detik

  if ($temp_menit < 60) {
      /* Apabila $temp_menit yang kurang dari 60 menit */
      $jam    = 0;
      $menit  = $temp_menit;
      $detik  = $temp_detik;
  } else {
      /* Apabila $temp_menit lebih dari 60 menit */
      $jam    = (int)($temp_menit/60);    //$temp_menit dijadikan jam dengan dibagi 60 dan dibulatkan menjadi integer
      $menit  = $temp_menit%60;           //$temp_menit diambil sisa bagi ($temp_menit%60) untuk menjadi menit
      $detik  = $temp_detik;
  }

  echo '<div class="card-body"><form id="form_soal" method="post" action="">';
  $lim = 1;
  $hal = $_GET['hal'];
  $pos = ($hal-1)*$lim;
  $no = $pos+1;
  $sql = "select * from soal where id_kategori = '{$_GET['id_kategori']}' and publish = 'Ya'
          limit $pos, $lim";
  $query = $db->query($sql);
  while($soal = $query->fetch_assoc()){
    $jwb = $db->query("select jawaban from jawaban where id_soal = '{$soal['id_soal']}' and id_member = '{$_SESSION['id_member']}' limit 1")->fetch_assoc();
    echo '<div class="form-group">
      <label>'.$no.'. '.$soal['pertanyaan'].'</label>
    </div>
    <div class="form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="radio" name="jawaban" value="A"';
        if($jwb['jawaban'] == 'A'){ echo ' checked'; }
        echo '> '.$soal['pilihan_a'].'
      </label>
    </div>
    <div class="form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="radio" name="jawaban" value="B"';
        if($jwb['jawaban'] == 'B'){ echo ' checked'; }
        echo '> '.$soal['pilihan_b'].'
      </label>
    </div>
    <div class="form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="radio" name="jawaban" value="C"';
        if($jwb['jawaban'] == 'C'){ echo ' checked'; }
        echo '> '.$soal['pilihan_c'].'
      </label>
    </div>
    <div class="form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="radio" name="jawaban" value="D"';
        if($jwb['jawaban'] == 'D'){ echo ' checked'; }
        echo '> '.$soal['pilihan_d'].'
      </label>
    </div>
    <input type="hidden" name="id_soal" value="'.$soal['id_soal'].'" /><hr />';
    $no++;
  }
  echo '<button type="submit" class="btn btn-primary" name="simpan">Simpan</button>';
  echo '<input type="hidden" name="id_kategori" value="'.$_GET['id_kategori'].'" />';
  echo '<input type="hidden" name="id_member" value="'.$_SESSION['id_member'].'" />';
  echo '</form></div>';

  echo '<div class="card-footer">';
  $sql2 = "select count(*) jml from soal where id_kategori = '{$_GET['id_kategori']}' and publish = 'Ya'";
  $jml = $db->query($sql2)->fetch_assoc();
  $jmlhal = ceil($jml['jml']/$lim);

  if($hal > 1){
    $prev = $hal-1;
    echo '<a href="?page=soal&act=test&id_kategori='.$_GET['id_kategori'].'&hal='.$prev.'" class="btn btn-warning"><i class="fa fa-arrow-left fa-fw"></i>Sebelumnya</a> ';
  }

  if($hal < $jmlhal){
    $next = $hal+1;
    echo '<a href="?page=soal&act=test&id_kategori='.$_GET['id_kategori'].'&hal='.$next.'" class="btn btn-warning">Berikutnya<i class="fa fa-arrow-right fa-fw"></i></a> ';
  }

  if($hal == $jmlhal){
    echo '<a href="?page=soal&act=test&id_kategori='.$_GET['id_kategori'].'&hal=end" class="btn btn-success" onclick="return confirm(\'Anda yakin sudah selesai mengerjakan semua soal?\nKlik OK jika anda sudah yakin. Data akan disimpan dan tidak dapat diubah lagi.\')"><i class="fa fa-check fa-fw"></i>Selesai</a>';
  }
  echo '</div>';

  if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
  	$id_soal = $_POST['id_soal'];
    $id_kategori = $_POST['id_kategori'];
    $id_member = $_POST['id_member'];
    $jawaban = $_POST['jawaban'];

		$sql = "insert into jawaban(id_soal, id_kategori, id_member, jawaban)
            values('{$id_soal}','{$id_kategori}','{$id_member}','{$jawaban}')";
    $query = $db->query($sql);
    if($query->errno){
			echo '<script>alert("Query error!\n('.$query->errno.') '.$query->error.'");</script>';
		}else{
			echo '<script>window.location.href="?page=soal&act=test&id_kategori='.$_GET['id_kategori'].'&hal='.$hal.'";</script>';
		}
  }
}
echo '</div>';

?>
