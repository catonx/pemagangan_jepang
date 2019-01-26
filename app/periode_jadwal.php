<?php
  $sql_get_test_status = "
  SELECT m.id_member, jm.id_jadwal, jd.jadwal, x.created_at, count(x.id_jadwal) AS answer, x.correct
  FROM member m
  LEFT JOIN jadwal_member jm ON jm.id_member = m.id_member
  LEFT JOIN jadwal jd ON jm.id_jadwal = jd.id_jadwal
  LEFT JOIN jawaban j ON j.id_member = m.id_member
  LEFT JOIN ( SELECT jw.id_member, jw.id_jadwal, jw.created_at, count(jw.id_jawaban) AS correct FROM jawaban jw, soal s WHERE jw.id_soal = s.id_soal AND jw.jawaban = s.jawaban AND jw.id_member = ".$member['id_member']." GROUP BY jw.id_member, jw.id_jadwal, jw.created_at) AS x ON x.id_jadwal = jm.id_jadwal
  WHERE m.id_member = ".$member['id_member']."
  GROUP BY m.id_member, jm.id_jadwal, x.created_at, x.correct
  ORDER BY jd.jadwal";

  $get_jadwal_and_tests = $db->query($sql_get_test_status);
  $row = $db->query($sql_get_test_status)->fetch_assoc();
  // $count_row = $row->num_rows;
  // echo '<pre>';
  // var_dump($get_jadwal_and_tests->num_rows);
  // echo '</pre>';
  if (empty($row['id_jadwal']) && empty($row['correct']) ) {
    echo'

    <div class="alert alert-primary" role="alert"><h4>Periode 1</h3><hr>
      <form method="post" action="">';
      include 'jadwal_form.php';
      echo'
      <button type="submit" class="btn btn-primary" name="simpan" onclick="return confirm(\'Anda yakin ingin menyimpan data ini?\nData yang sudah tersimpan tidak dapat diedit.\')">Simpan</button>
      </form>
    </div>
    <br />
    <div class="alert alert-danger">
      <i class="fa fa-fw fa-warning"></i>Tentukan jadwal tes dengan hati-hati. Jadwal tes tidak dapat diganti setelah disimpan.
    </div>';
  }else{
    $i = 1;
    while($jadwal_and_test = $get_jadwal_and_tests->fetch_assoc()){
      if ($jadwal_and_test['correct'] >= 14){
      echo '
        <div class="alert alert-primary" role="alert">
          <h4>Periode '.$i.' </h4><hr>
          <div class="form-group row">
            <label class="col-md-2 col-form-label">Jadwal Pilihan</label>
            <div class="col-md-4">
              <input type="text" class="form-control" value="'.tanggal_indo($jadwal_and_test['jadwal']).'" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2 col-form-label">Provinsi</label>
            <div class="col-md-10">
              <input type="text" class="form-control" value="'.$member['provinsi'].'" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2 col-form-label">Tanggal tes</label>
            <div class="col-md-10">
              <input type="text" class="form-control" value="'.$jadwal_and_test['created_at'].'" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2 col-form-label">Hasil Tes</label>
            <div class="col-md-10">
              <strong class="text-success">LULUS</strong>
            </div>
          </div>
        </div>';

      }else {
        if ($get_jadwal_and_tests->num_rows < 2 && !empty($jadwal_and_test['jadwal']) && !empty($jadwal_and_test['correct'])){
          echo '
          <div class="alert alert-primary" role="alert">
            <h4>Periode '.$i.' </h4><hr>
            <form method="post" action="">
              <div class="form-group row">
                <label class="col-md-2 col-form-label">Jadwal Pilihan</label>
                <div class="col-md-4">
                  <input type="text" class="form-control" value="'.tanggal_indo($jadwal_and_test['jadwal']).'" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-2 col-form-label">Provinsi</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="'.$member['provinsi'].'" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-2 col-form-label">Tanggal tes</label>
                <div class="col-md-10">';
                if (empty($jadwal_and_test['created_at'])) {
                  echo "<a href='?page=soal' class='btn btn-success'>Mulai Tes</a>";
                }else{
                  echo'<input type="text" class="form-control" value="'.$jadwal_and_test['created_at'].'" readonly>';
                }
                echo'</div>
              </div>
              <div class="form-group row">
                <label class="col-md-2 col-form-label">Hasil Tes</label>
                <div class="col-md-10">';
                if (empty($jadwal_and_test['correct'])) {
                  echo "-";
                }else{
                  echo'<strong class="text-danger">TIDAK LULUS</strong>';
                }
                echo'</div>
              </div>
            </form>
          </div>
          <div class="alert alert-danger">
            <i class="fa fa-fw fa-warning"></i>Anda belum lulus psikotes! </br> Silahkan tentukan kembali jadwal tes di bawah ini. </br> Tentukan jadwal tes dengan hati-hati. Jadwal tes tidak dapat diganti setelah disimpan.
          </div>
          <form method="post" action="">
          <div class="alert alert-primary" role="alert">
            <form method="post" action="">
              <h4>Periode 2 </h4><hr>';
              include 'jadwal_form.php';
          echo '
              <button type="submit" class="btn btn-primary" name="simpan" onclick="return confirm(\'Anda yakin ingin menyimpan data ini?\nData yang sudah tersimpan tidak dapat diedit.\')">Simpan</button>
            </form>
          </div>
          <br />';
        }else{
          echo '
            <div class="alert alert-primary" role="alert">
              <h4>Periode '.$i.' </h4><hr>
              <form method="post" action="">
                <div class="form-group row">
                  <label class="col-md-2 col-form-label">Jadwal Pilihan</label>
                  <div class="col-md-4">
                    <input type="text" class="form-control" value="'.tanggal_indo($jadwal_and_test['jadwal']).'" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 col-form-label">Provinsi</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control" value="'.$member['provinsi'].'" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 col-form-label">Tanggal tes</label>
                  <div class="col-md-10">';
                  if (empty($jadwal_and_test['created_at'])) {
                    // echo "-";
                    echo "<a href='?page=soal' class='btn btn-success'>Mulai Tes</a>";
                  }else{
                    echo'<input type="text" class="form-control" value="'.$jadwal_and_test['created_at'].'" readonly>';
                  }
                  echo'</div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 col-form-label">Hasil Tes</label>
                  <div class="col-md-10">';
                  if (empty($jadwal_and_test['correct'])) {
                    echo "-";
                  }else{
                    echo'<strong class="text-danger">TIDAK LULUS</strong>';
                  }
                  echo'</div>
                </div>
              </form>
            </div>';
        }
      }
      $i++;
    }
  }

?>
