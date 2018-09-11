<?php $member = $db->query("select * from member where id_member = '{$_GET['id_member']}' limit 1")->fetch_assoc(); ?>
<form>
  <div class="form-row">
    <div class="form-group col-md-3">
      <?php
      if (empty($member['foto'])) {
        echo '<img src="../img/noimage.jpg" class="img-fluid img-thumbnail">';
      }else{
        echo '<img src="../img/member/'.$member['foto'].'" class="img-fluid img-thumbnail">';
      } ?>
    </div>
    <div class="form-group col-md-9">

        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Nama Lengkap</label>
            <input type="text" class="form-control" value="<?php echo $member['nama']; ?>" readonly>
          </div>
          <div class="form-group col-md-3">
            <label>Jenis Kelamin</label>
            <input type="text" class="form-control" value="<?php echo $member['kelamin']; ?>" readonly>
          </div>
          <div class="form-group col-md-3">
            <label>Agama</label>
            <input type="text" class="form-control" value="<?php echo $member['agama']; ?>" readonly>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-3">
            <label>Tempat Lahir</label>
            <input type="text" class="form-control" value="<?php echo $member['tempat_lahir']; ?>" readonly>
          </div>
          <div class="form-group col-md-3">
            <label>Tanggal Lahir</label>
            <input type="text" class="form-control" value="<?php echo $member['tgl_lahir']; ?>" readonly>
          </div>
          <div class="form-group col-md-3">
            <label>No. HP</label>
            <input type="text" class="form-control" value="<?php echo $member['hp']; ?>" readonly>
          </div>
          <div class="form-group col-md-3">
            <label>Email</label>
            <input type="text" class="form-control" value="<?php echo $member['email']; ?>" readonly>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-8">
            <label>Provinsi</label>
            <input type="text" class="form-control" value="<?php echo $member['provinsi']; ?>" readonly>
          </div>
          <div class="form-group col-md-4">
            <label>Tahun Pelaksanaan</label>
            <input type="text" class="form-control" value="<?php echo $member['th_pelaksanaan']; ?>" readonly>
          </div>
        </div>

        <div class="form-group">
          <label>Alamat</label>
          <div class="alert alert-secondary"><?php echo $member['alamat']; ?></div>
        </div>

    </div>
  </div>

  <a href="?page=member" class="btn btn-primary">Kembali</a>
</form>
