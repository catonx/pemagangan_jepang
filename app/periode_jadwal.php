<?php
  $sql_get_test_status = "
  SELECT m.id_member, jm.id_jadwal, jd.jadwal, j.created_at, count(j.id_jawaban) AS answer, x.correct
  FROM member m
  LEFT JOIN jadwal_member jm ON jm.id_member = m.id_member
  LEFT JOIN jadwal jd ON jm.id_jadwal = jd.id_jadwal
  LEFT JOIN jawaban j ON jd.id_jadwal = j.id_jadwal
  LEFT JOIN ( SELECT jw.id_jadwal, count(jw.id_jawaban) AS correct FROM jawaban jw, soal s WHERE jw.id_soal = s.id_soal AND jw.jawaban = s.jawaban GROUP BY jw.id_jadwal ) AS x ON x.id_jadwal = jd.id_jadwal
  WHERE m.id_member = ".$member['id_member']."
  GROUP BY m.id_member, jm.id_jadwal, j.created_at";

  $get_jadwal_and_test = $db->query($sql_get_test_status);

  if ($get_jadwal_and_test->num_rows == 0) {
    echo'<div class="alert alert-primary" role="alert"><h4>Periode '.$periode.'</h3><hr>';
    include 'jadwal_form.php';
    echo'</div><br />
    <div class="alert alert-danger">
      <i class="fa fa-fw fa-warning"></i>Tentukan jadwal tes dengan hati-hati. Jadwal tes tidak dapat diganti setelah disimpan.
    </div>';
  }else{
    while($jadwal_and_test = $get_jadwal_and_test->fetch_assoc()){
      if ($jadwal_and_test['correct'] >= 14){
        echo '
          <div class="alert alert-primary" role="alert">
            <h4>Periode 1 </h3><hr>
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
        echo '
          <div class="alert alert-primary" role="alert">
            <h4>Periode 1 </h3><hr>
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
                <strong class="text-danger">TIDAK LULUS</strong>
              </div>
            </div>
          </div>
          <div class="alert alert-danger">
            <i class="fa fa-fw fa-warning"></i>Anda belum lulus! </br> Silahkan tentukan kembali jadwal tes periode 2 di bawah ini.</br> Tentukan jadwal tes dengan hati-hati. Jadwal tes tidak dapat diganti setelah disimpan.
          </div>
          <div class="alert alert-primary" role="alert"><h4>Periode 2</h3><hr>';
          include 'jadwal_form.php';
          echo'</div><br />';
      }
    }
  }


?>
