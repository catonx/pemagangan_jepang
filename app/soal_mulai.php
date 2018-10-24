<?php
var_dump($member);
$getresult = $db->query("select * from jawaban where id_member = '{$member['id_member']}'");
$resultexist = $getresult->fetch_assoc();
$gettgl = $db->query("select * from jadwal where id_jadwal = '{$member['id_jadwal']}' ");
$tgljadwal = $gettgl->fetch_assoc();
$tglmember = $tgljadwal['tgl'].' '.$tgljadwal['bln'].' '.$tgljadwal['thn'];
if (!empty($resultexist)) {
  echo '<div class="alert alert-info">
  <p>Anda telah melakukan test.</p>
  <a href="?page=hasil" class="btn btn-primary" ><i class="fa fa fa-check-square-o"></i> Lihat hasil tes </a>
  </div>';
}
elseif(empty($member['provinsi']) || empty($member['th_pelaksanaan']) || empty($member['kelamin']) || empty($member['agama']) || empty($member['tempat_lahir']) || empty($member['tgl_lahir']) || empty($member['alamat']) || empty($member['id_jadwal']) || $tglmember != $tgl_now){
  echo '<div class="alert alert-info">
  <p><i class="fa fa-fw fa-caret-right"></i>Silahkan lengkapi biodata dan tentukan jadwal tes terlebih dulu.</p>
	<p><i class="fa fa-fw fa-caret-right"></i>Soal tes akan tampil sesuai dengan jadwal tes yang anda tentukan.</p>
  </div>';
}else{
echo '<div class="card border-primary mb-3">
        <div class="card-header bg-primary text-light">';
          if($_GET['page'] == 'soal' && empty($_GET['act'])){
            echo'<div class="float-left"><h5><i class="fa fa-tag fa-fw"></i>Panduan Pengerjaan</h5></div>';
          }
          elseif (($_GET['page'] == 'soal') && ($_GET['act'] == 'start')) {
            echo'<div class="float-left"><h5><i class="fa fa-tag fa-fw"></i>Pilihlah jawaban yang sesuai!</h5></div>';
            echo'<div class="float-right"><h5>Sisa Waktu: <span id="timer" class="text-warning"></span></h5></div>';
          }
          else {
            echo'<div class="float-left"><h5><i class="fa fa-tag fa-fw"></i>Halaman tidak ditemukan!</h5></div>';
          }
        echo '</div>';
  if($_GET['page'] == 'soal' && empty($_GET['act'])){
    echo '<div class="card-body">
            <p>Anda akan mengerjakan 20 soal dalam 15 Menit</p>
            <p>Kerjakan soal-soal mulai dari yang termudah dahulu</p>
            <p>Anda dapat melewati soal yang sulit dan di kerjakan kemudian selama waktu belum habis</p>
          </div>
          <div class="card-footer">
            <a href="?page=soal&act=start" class="btn btn-success">Mulai Tes</a>
          </div>';
  }elseif ($_GET['page'] == 'soal' && $_GET['act'] == 'start') {
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
       // var_dump($_SESSION);
    }

    $temp_waktu = (15*60) - $telah_berlalu; //dijadikan detik dan dikurangi waktu yang berlalu
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
    $form_data = [];
    echo '<div class="card-body"><form id="form_soal" method="post" action="">';
    $no = 1;
    $sql = "SELECT * FROM soal s WHERE s.publish = 'Ya' ORDER BY RAND() LIMIT 20";
    $sql_temp = $db->query($sql);
    $array_soal = [];

    if (!isset($_SESSION["soal"])) {
       //jika session tidak ada
       while ($row = $sql_temp->fetch_assoc()) {
         $array_soal[] = $row;
       }
       $_SESSION["soal"] = $array_soal;
    } else {
      $array_soal = $_SESSION["soal"];
    }

    foreach($array_soal as $no=>$soal){
      $no++;
        echo '<div class="form-group">
          <label>'.$no.'. '.$soal['pertanyaan'].'</label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input type="hidden" name="id_soal_'.$no.'" value="'.$soal['id_soal'].'" />
            <input type="hidden" name="id_kategori_'.$no.'" value="'.$soal['id_kategori'].'" />
            <input type="hidden" name="id_member_'.$no.'" value="'.$_SESSION['id_member'].'" />
            <input type="hidden" name="id_jadwal_'.$no.'" value="'.$member['id_jadwal'].'" />
            <input class="form-check-input" type="radio" name="jawaban_'.$no.'" value="A" required> '.$soal['pilihan_a'].'</br>
            <input class="form-check-input" type="radio" name="jawaban_'.$no.'" value="B" required> '.$soal['pilihan_b'].'</br>
            <input class="form-check-input" type="radio" name="jawaban_'.$no.'" value="C" required> '.$soal['pilihan_c'].'</br>
            <input class="form-check-input" type="radio" name="jawaban_'.$no.'" value="D" required> '.$soal['pilihan_d'].'</br>
          </label>
        </div><hr />';
    }
    echo '</div><hr />';
    echo '<button type="submit" class="btn btn-primary" name="simpan" onclick="return confirm(\'Anda yakin sudah selesai mengerjakan semua soal?\nKlik OK jika anda sudah yakin. Data akan disimpan dan tidak dapat diubah lagi.\')">Simpan</button>';
    echo '</form></div>';

    if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
      // echo "<pre>";
      // var_dump($_POST);
      // echo "</pre>";
      for ($i=1; $i<=20; $i++) {
        $id_soal = $_POST['id_soal_'.$i];
        $id_kategori = $_POST['id_kategori_'.$i];
        $id_member = $_POST['id_member_'.$i];
        $id_jadwal = $_POST['id_jadwal_'.$i];
        $jawaban = $_POST['jawaban_'.$i];
        $sql_jawaban = "insert into jawaban(id_soal, id_kategori, id_member, jawaban, id_jadwal)
        values('{$id_soal}','{$id_kategori}','{$id_member}','{$jawaban}','{$id_jadwal}')";
        // echo "<pre>";
        // var_dump($sql_jawaban);
        // echo "</pre>";
        $query = $db->query($sql_jawaban);
        if($query->errno){
    			echo '<script>alert("Query error!\n('.$query->errno.') '.$query->error.'");</script>';
    		}else{
          echo '<script>alert("Selamat Anda telah menyelesaikan Psikotes. Jawaban Anda telah tersimpan! ");</script>';
    			echo '<script>window.location.href="?page=hasil";</script>';
    		}
      }
    }
  }
  else {
    echo '<div class="card-body">
            <p>salah halaman</p>
          </div>';
  }
  echo '</div>';
}
?>
