
<?php
$gettgl = $db->query("select * from jadwal where id_jadwal = '{$member['id_jadwal']}' limit 1");
$tgljadwal = $gettgl->fetch_assoc();
$tglmember = $tgljadwal['tgl'].' '.$tgljadwal['bln'].' '.$tgljadwal['thn'];
if(empty($member['provinsi']) || empty($member['th_pelaksanaan']) || empty($member['kelamin']) || empty($member['agama']) || empty($member['tempat_lahir']) || empty($member['tgl_lahir']) || empty($member['alamat']) || empty($member['id_jadwal']) || $tglmember != $tgl_now){
  echo '<div class="alert alert-info">
  <p><i class="fa fa-fw fa-caret-right"></i>Silahkan lengkapi biodata dan tentukan jadwal tes terlebih dulu.</p>
	<p><i class="fa fa-fw fa-caret-right"></i>Soal tes akan tampil sesuai dengan jadwal tes yang anda tentukan.</p>
  </div>';
}else{
	echo '<div class="card-deck">';

	$no=1;
	$getkat = $db->query("select * from kategori where publish = 'Ya'");
	while($kat = $getkat->fetch_assoc()){
		$jwb = "select count(*) jml from jawaban where id_kategori = '{$kat['id_kategori']}' and id_member = '{$_SESSION['id_member']}'";
	  $cekjwb = $db->query($jwb)->fetch_assoc();
	  echo '<div class="card border-primary mb-3" style="max-width: 20rem;">
	    <div class="card-header bg-primary text-light">
	      <h5><i class="fa fa-tag fa-fw"></i>'.$kat['nama_kategori'].'</h5>
	    </div>
	    <div class="card-body">'.$kat['ket'].'</div>
	    <div class="card-footer">';
	    if($cekjwb['jml'] > 0){
	      echo '<a href="?page=hasil&act=detail&id_kategori='.$kat['id_kategori'].'" class="btn btn-block btn-success">Lihat Hasil</a>';
	    }else{
	      echo '<a href="?page=soal&act=test&id_kategori='.$kat['id_kategori'].'" class="btn btn-block btn-warning">Ikuti Tes</a>';
	    }
	  echo '</div>
	  </div>';
	  if($no%3==0){
	    echo '</div><div class="card-deck">';
	  }
	  $no++;
	}
	echo '</div>';
}
?>
