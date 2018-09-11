<?php
$sql = "truncate table jawaban";
$query = $db->query($sql);
if($query->errno){
  echo '<script>alert("Query error!\n('.$query->errno.') '.$query->error.'");</script>';
}else{
  echo '<script>alert("Data berhasil direset!");</script>';
  echo '<script>window.location.href="?page='.$page.'";</script>';
}
?>
