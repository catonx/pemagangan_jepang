<form method="post" action="" enctype="multipart/form-data">
  <input type="hidden" name="id_member" value="<?php echo $member['id_member']; ?>">
  <div class="form-row">
    <div class="form-group col-md-3">
      <?php
      if (empty($member['foto'])) {
        echo '<img src="../img/noimage.jpg" class="img-fluid img-thumbnail">';
      }else{
        echo '<img src="../img/member/'.$member['foto'].'" class="img-fluid img-thumbnail">';
        echo '<input type="hidden" name="fotolama" value="'.$member['foto'].'">';
      } ?>
      <div class="mt-3">
        <input type="file" class="form-control" name="foto">
      </div>
    </div>
    <div class="form-group col-md-9">

        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Nama Lengkap</label>
            <input type="text" class="form-control" value="<?php echo $member['nama']; ?>" name="nama" required>
          </div>
          <div class="form-group col-md-3">
            <label>Jenis Kelamin</label>
            <select type="text" class="form-control" name="kelamin" required>
              <option value=""></option>
              <?php
                $kelaminAr = array('Laki-laki','Perempuan');
                foreach($kelaminAr as $kel){
                  echo '<option value="'.$kel.'"';
                  if($kel == $member['kelamin']){ echo ' selected'; }
                  echo '>'.$kel.'</option>';
                }
              ?>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label>Agama</label>
            <select type="text" class="form-control" name="agama" required>
              <option value=""></option>
              <?php
                $agamaAr = array('Islam','Kristen Katolik','Kristen Protestan','Hindu','Budha','Konghucu');
                foreach($agamaAr as $agama){
                  echo '<option value="'.$agama.'"';
                  if($agama == $member['agama']){ echo ' selected'; }
                  echo '>'.$agama.'</option>';
                }
              ?>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-3">
            <label>Tempat Lahir</label>
            <input type="text" class="form-control" value="<?php echo $member['tempat_lahir']; ?>" name="tempat_lahir" required>
          </div>
          <div class="form-group col-md-3">
            <label>Tanggal Lahir</label>
            <input type="text" class="form-control" value="<?php echo $member['tgl_lahir']; ?>" name="tgl_lahir" required>
            <small class="form-text text-muted">Format Tanggal: dd-mm-yyyy</small>
          </div>
          <div class="form-group col-md-3">
            <label>No. HP</label>
            <input type="text" class="form-control" value="<?php echo $member['hp']; ?>" name="hp" required>
          </div>
          <div class="form-group col-md-3">
            <label>Email</label>
            <input type="text" class="form-control" value="<?php echo $member['email']; ?>" readonly>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-8">
            <label>Provinsi</label>
              <?php
                if(!empty($member['provinsi'])){
                  echo '<input type="text" class="form-control" name="provinsi" value="'.$member['provinsi'].'" readonly>';
                }else{
              ?>
              <select type="text" class="form-control" name="provinsi" required>
                <option value=""></option>
                <?php
                  $getprov = $db->query("select * from provinsi order by nama_provinsi");
                  while($prov = $getprov->fetch_assoc()){
                    echo '<option value="'.$prov['nama_provinsi'].'"';
                    if($prov['nama_provinsi'] == $member['provinsi']){ echo ' selected'; }
                    echo '>'.$prov['nama_provinsi'].'</option>';
                  }
                ?>
              </select>
            <?php } ?>
          </div>
          <div class="form-group col-md-4">
            <label>Tahun Pelaksanaan</label>
              <?php
                if(!empty($member['th_pelaksanaan'])){
                  echo '<input type="text" class="form-control" name="th_pelaksanaan" value="'.$member['th_pelaksanaan'].'" readonly>';
                }else{
              ?>
              <select type="text" class="form-control" name="th_pelaksanaan" required>
                <option value=""></option>
                <?php
                  for($th = 2017; $th <= 2030; $th++){
                    echo '<option value="'.$th.'"';
                    if($th == $member['th_pelaksanaan']){ echo ' selected'; }
                    echo '>'.$th.'</option>';
                  }
                ?>
              </select>
            <?php } ?>
          </div>
        </div>

        <div class="form-group">
          <label>Alamat</label>
          <textarea rows="4" class="form-control" name="alamat" required><?php echo $member['alamat']; ?></textarea>
        </div>

    </div>
  </div>

  <button class="btn btn-primary" name="simpan" onclick="confirm('Simpan perubahan biodata?')">Simpan</button>
</form>
<?php
  // echo "<pre>";
  // var_dump($_POST);
  // echo "</pre>";
  if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $id_member = $_POST['id_member'];
    $nama_member = trim($_POST['nama']);
    $kelamin = $_POST['kelamin'];
    $agama = $_POST['agama'];
    $tempat_lahir = trim($_POST['tempat_lahir']);
    $tgl_lahir = trim($_POST['tgl_lahir']);
    $hp = trim($_POST['hp']);
    $alamat = trim($_POST['alamat']);
  	$provinsi = trim($_POST['provinsi']);
  	$th_pelaksanaan = trim($_POST['th_pelaksanaan']);
    $fotolama = $_POST['fotolama'];

  	$foto = $_FILES['foto'];
  	$nm = $foto['name'];
  	$tmp = $foto['tmp_name'];
  	$tp = $foto['type'];

  	$dir = '../img/member/';
  	$nama = explode(".", $nm);
  	$eks = end($nama);
  	$rename = date('ymd_his').'.'.$eks;
  	$upload = $dir.$rename;

    if(!empty($nama_member) && !empty($kelamin) && !empty($agama) && !empty($tempat_lahir) && !empty($tgl_lahir) && !empty($hp) && !empty($alamat) && !empty($provinsi) && !empty($th_pelaksanaan)){
  		if(!empty($tmp)){
        if($type == 'image/jpeg' || $type = 'image/jpg'){
  				if(move_uploaded_file($tmp, $upload)){
            if(!empty($fotolama)){
              unlink('../img/member/'.$member['foto']);
            }
  					$sql = "update member set nama = '{$nama_member}', kelamin = '{$kelamin}', agama = '{$agama}', tempat_lahir = '{$tempat_lahir}',
                    tgl_lahir = '{$tgl_lahir}', hp = '{$hp}', alamat = '{$alamat}', foto = '{$rename}', provinsi = '{$provinsi}', th_pelaksanaan = '{$th_pelaksanaan}'
                    where id_member = '{$id_member}' limit 1";
  					$query = $db->query($sql);
  					if($query->errno){
  						echo '<script>alert("Query error!\n('.$query->errno.') '.$query->error.'");</script>';
  					}else{
  						echo '<script>alert("Data berhasil disimpan!");</script>';
  						echo '<script>window.location.href="?page='.$page.'";</script>';
  					}
  				}else{
  					echo '<script>alert("Upload gagal!");</script>';
  				}
  			}else{
  				echo '<script>alert("Jenis gambar yang diijinkan hanya jpg!");</script>';
  			}
  		}else{
        $sql = "update member set nama = '{$nama_member}', kelamin = '{$kelamin}', agama = '{$agama}', tempat_lahir = '{$tempat_lahir}',
                tgl_lahir = '{$tgl_lahir}', hp = '{$hp}', alamat = '{$alamat}', provinsi = '{$provinsi}', th_pelaksanaan = '{$th_pelaksanaan}'
                where id_member = '{$id_member}' limit 1";
  			$query = $db->query($sql);
  			if($query->errno){
  				echo '<script>alert("Query error!\n('.$query->errno.') '.$query->error.'");</script>';
  			}else{
  				echo '<script>alert("Data berhasil disimpan!");</script>';
  				echo '<script>window.location.href="?page='.$page.'";</script>';
  			}
  		}
  	}else{
  		echo '<script>alert("Data belum lengkap!");</script>';
  	}
  }
?>
