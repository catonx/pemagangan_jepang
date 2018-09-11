<?php echo '<a href="?page='.$page.'&act=add" class="btn btn-sm btn-warning" title="Tambah Data"><span class="fa fa-plus-square fa-fw"></span> Tambah Data</a>'; ?>
<hr>
<table id="datatable" class="table table-responsive table-striped table-bordered table-hover" width="100%" cellspacing="0">
	<thead class="table-inverse">
		<tr>
			<th>No.</th>
			<th>Nama Provinsi</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$no = 1;
		$sql = "select * from provinsi";
		$query = $db->query($sql);
		while($data = $query->fetch_assoc()){
			echo '<tr>
				<td class="text-center">'.$no.'.</td>
				<td>'.$data['nama_provinsi'].'</td>
				<td class="text-center">
					<a href="?page='.$page.'&act=edit&id_provinsi='.$data['id_provinsi'].'" class="btn btn-sm btn-success" title="Edit Data"><span class="fa fa-edit"></span></a>
					<a href="?page='.$page.'&act=delete&id_provinsi='.$data['id_provinsi'].'" class="btn btn-sm btn-warning" title="Hapus Data" onclick="return confirm(\'Anda yakin ingin menghapus data ini?\nData yang sudah dihapus tidak dapat dikembalikan\')"><span class="fa fa-remove"></span></a>
				</td>
			</tr>';
			$no++;
		}
	?>
	</tbody>
</table>
