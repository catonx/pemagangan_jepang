<table id="datatable" class="table table-responsive table-striped table-bordered table-hover" width="100%" cellspacing="0">
	<thead class="table-inverse">
		<tr>
			<th>No.</th>
			<th>Foto</th>
			<th>Nama Member</th>
			<th>Provinsi</th>
			<th>Email</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$no = 1;
		$sql = "select * from member order by id_member desc";
		$query = $db->query($sql);
		while($data = $query->fetch_assoc()){
			echo '<tr>
				<td class="text-center">'.$no.'.</td>
				<td class="text-center">';
				if(empty($data['foto'])){
						echo '<img src="../img/noimage.jpg" class="img-fluid img-thumbnail" width="100">';
				}else{
						echo '<img src="../img/member/'.$data['foto'].'" class="img-fluid img-thumbnail" width="100">';
				}
			echo '</td>
				<td>'.$data['nama'].'</td>
				<td>'.$data['provinsi'].'</td>
				<td>'.$data['email'].'</td>
				<td class="text-center">
					<a href="?page='.$page.'&act=detail&id_member='.$data['id_member'].'" class="btn btn-sm btn-primary" title="Detail Member"><span class="fa fa-window-maximize"></span></a>
					<a href="?page='.$page.'&act=delete&id_member='.$data['id_member'].'" class="btn btn-sm btn-warning" title="Hapus Data" onclick="return confirm(\'Anda yakin ingin menghapus data ini?\nData yang sudah dihapus tidak dapat dikembalikan\')"><span class="fa fa-remove"></span></a>
				</td>
			</tr>';
			$no++;
		}
	?>
	</tbody>
</table>
