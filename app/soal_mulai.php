<?php

$sql_check = "
SELECT m.id_member, jm.id_jadwal, jd.jadwal, j.created_at, count(j.id_jawaban) AS answer, x.correct
FROM member m
LEFT JOIN jadwal_member jm ON jm.id_member = m.id_member
LEFT JOIN jadwal jd ON jm.id_jadwal = jd.id_jadwal
LEFT JOIN jawaban j ON j.id_member = m.id_member
LEFT JOIN ( SELECT jw.id_member, jw.id_jadwal, count(jw.id_jawaban) AS correct FROM jawaban jw, soal s WHERE jw.id_soal = s.id_soal AND jw.jawaban = s.jawaban AND jw.id_jawaban = ".$member['id_member']." GROUP BY jw.id_member, jw.id_jadwal) AS x ON x.id_jadwal = jm.id_jadwal
WHERE m.id_member = ".$member['id_member']."
GROUP BY m.id_member, jm.id_jadwal, j.created_at, x.correct
ORDER BY jd.jadwal";
// $getresult = $db->query("select * from jawaban where id_member = '{$member['id_member']}'");

$getresult = $db->query($sql_check);
$count_row = $getresult->num_rows;
$result_content = '';
// $start_soal = '';
// $start_soal_1 = FALSE;
// $start_soal_2 = FALSE;

// echo "<pre>";
// var_dump("$count_row");
// echo "</pre>";
// exit;
if(empty($member['provinsi']) || empty($member['th_pelaksanaan']) || empty($member['kelamin']) || empty($member['agama']) || empty($member['tempat_lahir']) || empty($member['tgl_lahir']) || empty($member['alamat'])
){
  echo '<div class="alert alert-info">
  <p><i class="fa fa-fw fa-caret-right"></i>Silahkan lengkapi biodata terlebih dulu.</p>
  </div>';
}else{
  // $count = 1;
  $pilihan_tanggal = array();
  $created = array();
  $correct = array();
  $jadwal = array();
  while ($resultexist = $getresult->fetch_assoc()) {
    $correct[]= $resultexist['correct'];
    $pilihan_tanggal[] = tanggal_indo($resultexist['jadwal']);
    $created[] = $resultexist['created_at'];
    $correct[] = $resultexist['correct'];
    $jadwal[] = $resultexist['id_jadwal'];
  }
  // var_dump($pilihan_tanggal);
  for ($count = 1; $count <= $count_row; $count++) {
    // Tes Pertama
    if ($count_row == $count) {

      $pilihan_tanggal_1 = $pilihan_tanggal[0];
      $created_1 = $created[0];
      $correct_1 = $correct[1];
      $jadwal_1 = $jadwal[0];

      // echo "<pre>";
      // var_dump($pilihan_tanggal_1);
      // echo "</pre>";
      // exit;

      if (!empty($created_1) && $correct_1 >= 14) {
        $result_content_1 = '<div class="alert alert-info">
        <p>Anda telah melakukan test.</p>
        <a href="?page=hasil" class="btn btn-primary" ><i class="fa fa fa-check-square-o"></i> Lihat hasil tes </a>
        </div>';
      }elseif (!empty($created_1) && $correct_1 < 14) {
        $result_content_1 = '<div class="alert alert-danger">
        <p><i class="fa fa-fw fa-warning"></i>Anda belum lulus psikotes periode 1 ! </p>
        <p><i class="fa fa-fw fa-warning"></i>Silahkan tentukan kembali jadwal tes terlebih dulu.</p>
        <p><i class="fa fa-fw fa-warning"></i>Soal tes akan tampil sesuai dengan jadwal tes yang anda tentukan.</p>
        <a href="?page=jadwal" class="btn btn-primary" ><i class="fa fa fa-check-square-o"></i> Tentukan Jadwal tes </a>
        </div>';
      }elseif (empty($jadwal_1)) {
        $result_content_1 = '<div class="alert alert-info">
        <p><i class="fa fa-fw fa-caret-right"></i>Silahkan tentukan jadwal tes terlebih dulu.</p>
      	<p><i class="fa fa-fw fa-caret-right"></i>Soal tes akan tampil sesuai dengan jadwal tes yang anda tentukan.</p>
        <a href="?page=jadwal" class="btn btn-primary" ><i class="fa fa fa-check-square-o"></i> Tentukan Jadwal tes </a>
        </div>';

      }else {
        $result_content_1 = '<div class="card border-primary mb-3">
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
      // echo "<pre>";
      // echo "tgl 1 ";
      // var_dump($pilihan_tanggal_1 == $tgl_now);
      // echo "</pre>";
      // exit;
      $start_soal_1 = ($pilihan_tanggal_1 == $tgl_now) ? "TRUE" : "FALSE" ;

      // echo "<pre>";
      // echo "tgl 2 ";
      // var_dump($start_soal_1);
      // echo "</pre>";
      // exit;

    }

    // Tes Kedua
    if ($count_row > $count) {
      // var_dump($resultexist);

      $pilihan_tanggal_2 = $pilihan_tanggal[1];
      $created_2 = $created[1];
      $correct_2 = $correct[2];
      $jadwal_2 = $jadwal[1];

      // var_dump($correct_2);
      // exit;

      if (!empty($created_2) && (int)$correct_2 >= 14) {
        $result_content_2 = '<div class="alert alert-info">
        <p>Anda telah melakukan test.</p>
        <a href="?page=hasil" class="btn btn-primary" ><i class="fa fa fa-check-square-o"></i> Lihat hasil tes </a>
        </div>';
      }elseif (!empty($created_2) && (int)$correct_2 < 14) {
        $result_content_2 = '<div class="alert alert-danger">
        <p><i class="fa fa-fw fa-warning"></i>Maaf, Anda Tidak Lulus Psikotes !</p>
        </div>';
      }elseif (!empty($jadwal_1) && empty($jadwal_2)) {
        $result_content_2 = '<div class="alert alert-danger">
        <p><i class="fa fa-fw fa-warning"></i>Anda belum lulus psikotes periode 1 ! </p>
        <p><i class="fa fa-fw fa-warning"></i>Silahkan tentukan kembali jadwal tes terlebih dulu.</p>
        <p><i class="fa fa-fw fa-warning"></i>Soal tes akan tampil sesuai dengan jadwal tes yang anda tentukan.</p>
        <a href="?page=jadwal" class="btn btn-primary" ><i class="fa fa fa-check-square-o"></i> Tentukan Jadwal tes </a>
        </div>';

      }else {
        $result_content_2 = '<div class="alert alert-danger">
          <p><i class="fa fa-fw fa-warning"></i> Anda Belum Lulus Psikotes Periode 1 ! </p>
          <p><i class="fa fa-fw fa-warning"></i> Kerjakan Kembali Soal Tes Melalui Tombol "Mulai Tes" ! </p>
        </div>
        <div class="card border-primary mb-3">
          <div class="card-header bg-primary text-light">
            <div class="float-left"><h5><i class="fa fa-tag fa-fw"></i>Panduan Pengerjaan Periode 2</h5></div>
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
      // echo "<pre>";
      // echo "tgl 2 ";
      // var_dump($pilihan_tanggal_2 == $tgl_now);
      // echo "</pre>";
      // exit;
      $start_soal_2 = ($pilihan_tanggal_2 == $tgl_now) ? "TRUE" : "FALSE" ;

      // echo "<pre>";
      // echo "tgl 2 ";
      // var_dump($start_soal_2);
      // echo "</pre>";
      // exit;
    }

    // $count++;
  }
}

$result_content = ($count_row == 1) ? $result_content_1 : $result_content_2 ;
$start_soal = ($count_row == 1) ? $start_soal_1 : $start_soal_2 ;

if($_GET['page'] == 'soal' && empty($_GET['act'])){
   echo $result_content;

}else{
  // echo "<pre>";
  // var_dump($start_soal);
  // var_dump("tgl 1 ".$pilihan_tanggal_1);
  // var_dump("tgl 2 ".$pilihan_tanggal_2);
  // var_dump($tgl_now);
  // echo "</pre>";
  // exit;
  if ($_GET['page'] == 'soal' && $_GET['act'] == 'start') {
    if ($start_soal == "TRUE") {
      echo '<div class="card border-primary mb-3">
              <div class="card-header bg-primary text-light">
                <div class="float-left"><h5><i class="fa fa-tag fa-fw"></i>Pilihlah jawaban yang sesuai!</h5></div>
                <div class="float-right"><h5>Sisa Waktu: <span id="timer" class="text-warning"></span></h5></div>
              </div>
            </div>';
      // echo '  </div>';
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
      // $sql = "SELECT * FROM soal s WHERE s.publish = 'Ya' ORDER BY RAND() LIMIT 20";

      $sql_temp_cat_1 = $db->query("SELECT s.id_soal FROM soal s WHERE s.publish = 'Ya' AND s.id_kategori = 2 ORDER BY RAND() LIMIT 5");
      $sql_temp_cat_2 = $db->query("SELECT s.id_soal FROM soal s WHERE s.publish = 'Ya' AND s.id_kategori = 3 ORDER BY RAND() LIMIT 5");
      $sql_temp_cat_3 = $db->query("SELECT s.id_soal FROM soal s WHERE s.publish = 'Ya' AND s.id_kategori = 4 ORDER BY RAND() LIMIT 5");
      $sql_temp_cat_4 = $db->query("SELECT s.id_soal FROM soal s WHERE s.publish = 'Ya' AND s.id_kategori = 5 ORDER BY RAND() LIMIT 5");
      $array_soal_1 = [];
      $array_soal_2 = [];
      $array_soal_3 = [];
      $array_soal_4 = [];
      // $array_soal_5 = [];
      $array_soal_ids = [];
      $array_soal = [];

      if (!isset($_SESSION["soal"])) {
         //jika session tidak ada
         while ($row1 = $sql_temp_cat_1->fetch_assoc()) {
           $array_soal_1[] = $row1["id_soal"];
         }

         while ($row2 = $sql_temp_cat_2->fetch_assoc()) {
           $array_soal_2[] = $row2["id_soal"];
         }
         while ($row3 = $sql_temp_cat_3->fetch_assoc()) {
           $array_soal_3[] = $row3["id_soal"];
         }
         while ($row4 = $sql_temp_cat_4->fetch_assoc()) {
           $array_soal_4[] = $row4["id_soal"];
         }

         $array_soal_ids = array_merge($array_soal_1, $array_soal_2, $array_soal_3, $array_soal_4);

         $thePostIdArray = implode(', ', $array_soal_ids);

         $sql = $db->query("SELECT * FROM soal s WHERE s.id_soal IN ($thePostIdArray) ORDER BY RAND()");
         while ($row = $sql->fetch_assoc()) {
           $array_soal[] = $row;
         }

         // echo "<pre>";
         // var_dump($array_soal_1);
         // var_dump($array_soal_2);
         // var_dump($array_soal_3);
         // var_dump($array_soal_4);
         // print($array_soal_ids);
         // print_r($thePostIdArray);
         // print_r($array_soal);
         // echo "</pre>";
         // exit;

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
    }else {
      echo '<div class="card border-primary mb-3">
              <div class="card-header alert-danger">
                <p><i class="fa fa-fw fa-warning"></i>Anda Bukan Pada Periode Tes Yang Telah Anda Tentukan ! </p>
                <a href="?page=jadwal" class="btn btn-primary" ><i class="fa fa fa-check-square-o"></i> Lihat Periode Tes </a>
              </div>
            </div>';
    }
  }
}

?>
