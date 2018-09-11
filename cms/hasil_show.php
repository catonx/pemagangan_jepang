<a href="?page=hasil&act=resetall" class="btn btn-sm btn-warning" onclick="return confirm('Reset semua hasil tes?\nData yang sudah dihapus tidak dapat dikembalikan.')"><i class="fa fa-fw fa-remove"></i> Reset Semua</a>
<hr />
<table id="datatable" class="table table-responsive table-striped table-bordered table-hover" width="100%" cellspacing="0">
	<thead class="table-inverse">
		<tr>
			<th>No.</th>
			<th>Nama Member</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$no = 1;
		$sql = "select * from member where id_member in (select id_member from jawaban) order by nama";
		$query = $db->query($sql);
		while($data = $query->fetch_assoc()){
			echo '<tr>
				<td class="text-center">'.$no.'.</td>
				<td>'.$data['nama'].'</td>
				<td class="text-center">
					<a href="?page='.$page.'&act=detail&id_member='.$data['id_member'].'" class="btn btn-sm btn-primary" title="Detail Member"><span class="fa fa-window-maximize"></span></a>
					<a href="?page='.$page.'&act=reset&id_member='.$data['id_member'].'" class="btn btn-sm btn-warning" title="Reset Data" onclick="return confirm(\'Reset seluruh hasil tes '.$data['nama'].'?\nSemua hasil tes akan dihapus.\nPeringatan: Data yang sudah dihapus tidak dapat dikembalikan.\')"><span class="fa fa-refresh"></span></a>
				</td>
			</tr>';
			$no++;
		}
	?>
	</tbody>
</table>
