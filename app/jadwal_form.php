<?php
// echo "<pre>";
// var_dump($jadwal_and_test);
// echo "<pre>";
// exit;
echo '
    <div class="form-group row">
      <label class="col-md-2 col-form-label">Jadwal Pilihan</label>
      <div class="col-md-4">
        <select type="text" class="form-control" name="id_jadwal" required><option value=""></option>';
          $getjadwal = $db->query("select * from jadwal where publish = 'Ya' and provinsi = '{$member['provinsi']}' and jadwal >= DATE_FORMAT(now(), '%Y-%m-%d')");
          while($jadwal = $getjadwal->fetch_assoc()){
            if ($jadwal['id_jadwal'] == $member['id_jadwal']) {
              echo '<option value=""> - </option>';
            }else {
              echo '<option value="'.$jadwal['id_jadwal'].'">'.tanggal_indo($jadwal['jadwal']).'</option>';
            }

          }
        echo'
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-2 col-form-label">Provinsi</label>
      <div class="col-md-10">
        <input type="text" class="form-control" value="'.$member['provinsi'].'" readonly>
      </div>
    </div>';

?>
