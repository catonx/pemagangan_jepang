<?php echo '<div><a href="?page='.$page.'&act=add" class="btn btn-sm btn-warning" title="Tambah kategori"><span class="fa fa-plus-square fa-fw"></span> Tambah kategori</a></div>'; ?>
<hr>
<table id="datatable-admin" class="table table-responsive table-striped table-bordered table-hover" width="100%" cellspacing="0">
	<thead class="table-inverse">
		<tr>
			<th>No.</th>
			<th>Kategori</th>
			<th>Publish</th>
			<th>Jml. Soal</th>
			<th>Nilai Minimum</th>
			<th>Waktu</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$no = 1;
		$sql = "select k.id_kategori, k.nama_kategori, k.publish, count(s.id_soal) jml_soal, k.nilai_min, k.waktu
						from kategori k left join soal s
						on k.id_kategori = s.id_kategori
						group by k.id_kategori, k.nama_kategori";
		$query = $db->query($sql);
		while($data = $query->fetch_assoc()){
			echo '<tr>
				<td class="text-center">'.$no.'.</td>
				<td>'.$data['nama_kategori'].'</td>
				<td>'.$data['publish'].'</td>
				<td>'.$data['jml_soal'].'</td>
				<td>'.$data['nilai_min'].'</td>
				<td>'.$data['waktu'].' Menit</td>
				<td class="text-center">
					<a href="?page='.$page.'&act=detail&id_kategori='.$data['id_kategori'].'" class="btn btn-sm btn-primary" title="Detail kategori"><span class="fa fa-window-maximize"></span></a>
					<a href="?page='.$page.'&act=edit&id_kategori='.$data['id_kategori'].'" class="btn btn-sm btn-success" title="Edit kategori"><span class="fa fa-edit"></span></a>
					<a href="?page='.$page.'&act=delete&id_kategori='.$data['id_kategori'].'" class="btn btn-sm btn-warning" title="Hapus kategori" onclick="return confirm(\'Anda yakin ingin menghapus kategori ini?\nSoal-soal yang terkait dengan kategori ini akan ikut terhapus\nData yang sudah dihapus tidak dapat dikembalikan\')"><span class="fa fa-remove"></span></a>
				</td>
			</tr>';
			$no++;
		}
	?>
	</tbody>
</table>
