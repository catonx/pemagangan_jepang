<div class="alert alert-primary" role="alert">
  <h3>Selamat datang di Aplikasi Magang</h3><hr>
  <p>Anda login sebagai: <strong><?php echo $member['nama']; ?></strong></p>
</div>
<div class="alert alert-primary" role="alert">
  <?php
		$panduan = $db->query("select * from panduan order by id_panduan desc limit 1")->fetch_assoc();
		echo $panduan['isi'];
	?>
</div>
