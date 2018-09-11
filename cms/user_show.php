<?php echo '<div><a href="?page='.$page.'&act=add" class="btn btn-sm btn-warning" title="Tambah user"><span class="fa fa-plus-square fa-fw"></span> Tambah user</a></div>'; ?>
<hr>
<table id="datatable" class="table table-responsive table-striped table-bordered table-hover" width="100%" cellspacing="0">
	<thead class="table-inverse">
		<tr>
			<th>No.</th>
			<th>Username</th>
			<th>Level</th>
			<th>Terakhir Login</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$no = 1;
		$sql = "select * from user where id_user <> '{$_SESSION['id_user']}'";
		$query = $db->query($sql);
		while($data = $query->fetch_assoc()){
			echo '<tr>
				<td class="text-center">'.$no.'.</td>
				<td>'.$data['username'].'</td>
				<td>'.$data['level'].'</td>
				<td>'.$data['last_login'].'</td>
				<td class="text-center">
					<a href="?page='.$page.'&act=detail&id_user='.$data['id_user'].'" class="btn btn-sm btn-primary" title="Detail user"><span class="fa fa-window-maximize"></span></a>
					<a href="?page='.$page.'&act=edit&id_user='.$data['id_user'].'" class="btn btn-sm btn-success" title="Edit user"><span class="fa fa-edit"></span></a>
					<a href="?page='.$page.'&act=delete&id_user='.$data['id_user'].'" class="btn btn-sm btn-warning" title="Hapus user" onclick="return confirm(\'Anda yakin ingin menghapus user ini?\nSoal-soal yang terkait dengan user ini akan ikut terhapus\nData yang sudah dihapus tidak dapat dikembalikan\')"><span class="fa fa-remove"></span></a>
				</td>
			</tr>';
			$no++;
		}
	?>
	</tbody>
</table>
