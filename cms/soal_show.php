<?php echo '<a href="?page='.$page.'&act=add" class="btn btn-sm btn-warning" title="Tambah Soal"><span class="fa fa-plus-square fa-fw"></span> Tambah Soal</a>'; ?>
<hr>
<table id="datatable" class="table table-responsive table-striped table-bordered table-hover" width="100%" cellspacing="0">
	<thead class="table-inverse">
		<tr>
			<th>No.</th>
			<th>Pertanyaan</th>
			<th>Jawaban</th>
			<th>Kategori Soal</th>
			<th>publish</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$no = 1;
		$sql = "select s.*, k.nama_kategori
						from soal s left join kategori k
						on s.id_kategori = k.id_kategori
						order by s.id_soal desc";
		$query = $db->query($sql);
		while($data = $query->fetch_assoc()){
			echo '<tr>
				<td class="text-center">'.$no.'.</td>
				<td>'.$data['pertanyaan'].'</td>
				<td>'.$data['jawaban'].'</td>
				<td>'.$data['nama_kategori'].'</td>
				<td>'.$data['publish'].'</td>
				<td class="text-center">
					<a href="?page='.$page.'&act=detail&id_soal='.$data['id_soal'].'" class="btn btn-sm btn-primary" title="Detail Soal"><span class="fa fa-window-maximize"></span></a>
					<a href="?page='.$page.'&act=edit&id_soal='.$data['id_soal'].'" class="btn btn-sm btn-success" title="Edit Soal"><span class="fa fa-edit"></span></a>
					<a href="?page='.$page.'&act=delete&id_soal='.$data['id_soal'].'" class="btn btn-sm btn-warning" title="Hapus Soal" onclick="return confirm(\'Anda yakin ingin menghapus data ini?\nData yang sudah dihapus tidak dapat dikembalikan\')"><span class="fa fa-remove"></span></a>
				</td>
			</tr>';
			$no++;
		}
	?>
	</tbody>
</table>
