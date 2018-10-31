<?php
if(empty($member['provinsi']) || empty($member['th_pelaksanaan']) || empty($member['kelamin']) || empty($member['agama']) || empty($member['tempat_lahir']) || empty($member['tgl_lahir']) || empty($member['alamat'])){
  echo '<div class="alert alert-info">
  Silahkan lengkapi biodata terlebih dahulu.
  </div>';
}else{
  include 'periode_jadwal.php';
  // if(empty($member['id_jadwal'])){
  //   echo '<br />
  //   <div class="alert alert-danger">
  //     <i class="fa fa-fw fa-warning"></i>Tentukan jadwal tes dengan hati-hati. Jadwal tes tidak dapat diganti setelah disimpan.
  //   </div>';
  // }

  if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $id_jadwal = $_POST['id_jadwal'];
    if(!empty($id_jadwal)){
      $submit_jadwal = date('Y-m-d H:i:s');
      $sql = "insert into jadwal_member (id_member,id_jadwal, created_at) values ('{$_SESSION['id_member']}','{$id_jadwal}', '{$submit_jadwal}')";
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
}
?>
