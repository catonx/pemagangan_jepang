<?php
$sql_check = "
SELECT m.id_member, jm.id_jadwal, jd.jadwal, j.created_at, count(j.id_jawaban) AS answer, x.correct
FROM member m
LEFT JOIN jadwal_member jm ON jm.id_member = m.id_member
LEFT JOIN jadwal jd ON jm.id_jadwal = jd.id_jadwal
LEFT JOIN jawaban j ON j.id_jadwal = jd.id_jadwal
LEFT JOIN ( SELECT jw.id_member, jw.id_jadwal, count(jw.id_jawaban) AS correct FROM jawaban jw, soal s WHERE jw.id_soal = s.id_soal AND jw.jawaban = s.jawaban GROUP BY jw.id_member, jw.id_jadwal) AS x ON x.id_jadwal = jm.id_jadwal
WHERE m.id_member = ".$member['id_member']."
GROUP BY m.id_member, jm.id_jadwal, j.created_at, x.correct ";
// $getresult = $db->query("select * from jawaban where id_member = '{$member['id_member']}'");
// echo '<pre>';
// var_dump($getresult->num_rows);
// echo '</pre>';

$getresult = $db->query($sql_check);
$result_content = '';
$start_soal = TRUE;
if(empty($member['provinsi']) || empty($member['th_pelaksanaan']) || empty($member['kelamin']) || empty($member['agama']) || empty($member['tempat_lahir']) || empty($member['tgl_lahir']) || empty($member['alamat']) ||
empty($member['id_jadwal'])){
  $start_soal = FALSE;
  echo '<div class="alert alert-info">
  <p><i class="fa fa-fw fa-caret-right"></i>Silahkan lengkapi biodata dan tentukan jadwal tes terlebih dulu.</p>
	<p><i class="fa fa-fw fa-caret-right"></i>Soal tes akan tampil sesuai dengan jadwal tes yang anda tentukan.</p>
  </div>';
}else{
  while ($resultexist = $getresult->fetch_assoc()) {
    // echo "<pre>";
    // var_dump($resultexist['jadwal']);
    // echo "</pre>";
    // exit;
    $pilihan_tanggal = tanggal_indo($resultexist['jadwal']);
    if ($resultexist['correct'] >= 14) {
      $start_soal = TRUE;
      $result_content = '<div class="alert alert-info">
      <p>Anda telah melakukan test.</p>
      <a href="?page=hasil" class="btn btn-primary" ><i class="fa fa fa-check-square-o"></i> Lihat hasil tes </a>
      </div>';
    }else{
      if ($getresult->num_rows == 1 && $resultexist['correct'] < 14 && !empty($resultexist['created_at'])) {
        // $start_soal = (tanggal_indo($resultexist['jadwal']) == $tgl_now) ?  : b ;$start_soal = FALSE;
        $start_soal = TRUE;
        $result_content = '<div class="alert alert-danger">
        <p><i class="fa fa-fw fa-warning"></i>Anda belum lulus psikotes periode 1 ! </p>
        <p><i class="fa fa-fw fa-warning"></i>Silahkan tentukan kembali jadwal tes terlebih dulu.</p>
        <p><i class="fa fa-fw fa-warning"></i>Soal tes akan tampil sesuai dengan jadwal tes yang anda tentukan.</p>
        <a href="?page=jadwal" class="btn btn-primary" ><i class="fa fa fa-check-square-o"></i> Tentukan Jadwal tes </a>
        </div>';
      }
      else {
        $start_soal = TRUE;
        $result_content = '<div class="alert alert-danger">
          <i class="fa fa-fw fa-warning"></i>Anda belum lulus psikotes periode 1 ! </br> Silahkan kerjakan kembali tes dengan menekan tombol "Mulai tes" di bawah ini.
        </div>';

      }
    }
  }
}
// $resultexist = $getresult->fetch_assoc();
// if ($finish_test) {
//   echo $result_content;
// }
// elseif(empty($member['provinsi']) || empty($member['th_pelaksanaan']) || empty($member['kelamin']) || empty($member['agama']) || empty($member['tempat_lahir']) || empty($member['tgl_lahir']) || empty($member['alamat']) || empty($member['id_jadwal']) || $member['jadwal'] != date('Y-n-d')){
//   echo '<div class="alert alert-info">
//   <p><i class="fa fa-fw fa-caret-right"></i>Silahkann lengkapi biodata dan tentukan jadwal tes terlebih dulu.</p>
// 	<p><i class="fa fa-fw fa-caret-right"></i>Soal tes akan tampil sesuai dengan jadwal tes yang anda tentukan.</p>
//   </div>';
// }else{
// var_dump($pilihan_tanggal);
// var_dump($tgl_now);
// $start_soal = ($pilihan_tanggal == $tgl_now)? TRUE  : FALSE ;
if($_GET['page'] == 'soal' && empty($_GET['act'])){

  if ($pilihan_tanggal != $tgl_now) {

    echo'<div class="alert alert-danger">
    <p><i class="fa fa-fw fa-warning"></i>Anda tidak pada periode pengerjaan tes </p>
    <p><i class="fa fa-fw fa-warning"></i>Soal tes akan tampil sesuai dengan jadwal tes yang anda tentukan.</p>
      </div>';
  }else{
    echo $result_content;
    echo '<div class="card border-primary mb-3">
          <div class="card-header bg-primary text-light">
            <div class="float-left"><h5><i class="fa fa-tag fa-fw"></i>Panduan Pengerjaan</h5></div>
          </div>
          <div class="card-body">
            <p>Anda akan mengerjakan 20 soal dalam 15 Menit</p>
            <p>Kerjakan soal-soal mulai dari yang termudah dahulu</p>
            <p>Anda dapat melewati soal yang sulit dan di kerjakan kemudian selama waktu belum habis</p>
          </div>
          <div class="card-footer">
            <a href="?page=soal&act=start" class="btn btn-success">Mulai Tes</a>
          </div>
        </div>';
  }
}else{
  if ($_GET['page'] == 'soal' && $_GET['act'] == 'start') {
    echo '<div class="card border-primary mb-3">
            <div class="card-header bg-primary text-light">
              <div class="float-left"><h5><i class="fa fa-tag fa-fw"></i>Pilihlah jawaban yang sesuai!</h5></div>
              <div class="float-right"><h5>Sisa Waktu: <span id="timer" class="text-warning"></span></h5></div>';
    echo '  </div>';
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
    echo '<form id="form_soal" method="post" action=""><div class="card-body">';
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
    echo '<div class="card-footer"><button type="submit" class="btn btn-primary" name="simpan" onsubmit="return confirm(\'Anda yakin sudah selesai mengerjakan semua soal?\nKlik OK jika anda sudah yakin. Data akan disimpan dan tidak dapat diubah lagi.\')">Simpan</button>';
    echo '</div></div></form>';

    if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
      for ($i=1; $i<=20; $i++) {
        $id_soal = $_POST['id_soal_'.$i];
        $id_kategori = $_POST['id_kategori_'.$i];
        $id_member = $_POST['id_member_'.$i];
        $id_jadwal = $_POST['id_jadwal_'.$i];
        $jawaban = $_POST['jawaban_'.$i];
        $submit_jawaban = date('Y-m-d H:i:s');
        $sql_jawaban = "insert into jawaban(id_soal, id_kategori, id_member, jawaban, id_jadwal, created_at)
        values('{$id_soal}','{$id_kategori}','{$id_member}','{$jawaban}','{$id_jadwal}', '{$submit_jawaban}')";
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
}

?>
