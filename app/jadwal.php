<?php
if(empty($member['provinsi']) || empty($member['th_pelaksanaan']) || empty($member['kelamin']) || empty($member['agama']) || empty($member['tempat_lahir']) || empty($member['tgl_lahir']) || empty($member['alamat'])){
  echo '<div class="alert alert-info">
  Silahkan lengkapi biodata terlebih dahulu.
  </div>';
}else{
  include 'periode_jadwal.php';
  // var_dump($_POST);
  // exit;

  if(isset($_POST['simpan']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $id_jadwal = $_POST['id_jadwal'];
    if(!empty($id_jadwal)){
      $submit_jadwal = date('Y-m-d H:i:s');
      $sql = "insert into jadwal_member (id_member,id_jadwal, created_at) values ('{$_SESSION['id_member']}','{$id_jadwal}', '{$submit_jadwal}')";
      $query = $db->query($sql);
      if($db->error){
        echo '<script>alert("Query error!\n('.$query->errno.') '.$db->error.'");</script>';
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
