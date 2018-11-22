<table id="datatable-admin" class="table table-responsive table-striped table-bordered table-hover" width="100%" cellspacing="0">
	<thead class="table-inverse">
		<tr>
			<th>No.</th>
			<th>Nama Member</th>
			<th>Provinsi Asal</th>
			<th>Jadwal Test</th>
			<th>Jawaban Benar</th>
			<th>Keterangan</th>
			<?php
				if ($user["level"] == "Admin" || $user["level"] == "Staff"){
					echo '<th>Aksi</th>';
				}else{
					echo '';
				}
			?>
		</tr>
	</thead>
	<tbody>
	<?php
		$no = 1;
		$sql = "SELECT j.id_member, m.nama , m.provinsi, j.id_jadwal , jw.jadwal, count(j.jawaban) AS jawaban
FROM jawaban j
LEFT JOIN soal s ON s.id_soal = j.id_soal
LEFT JOIN jadwal jw ON jw.id_jadwal = j.id_jadwal
LEFT JOIN member m ON j.id_member = m.id_member
WHERE s.jawaban = j.jawaban
GROUP BY j.id_jadwal, j.id_member";
		$query = $db->query($sql);
		while($data = $query->fetch_assoc()){
			echo '<tr>
				<td class="text-center">'.$no.'.</td>
				<td>'.$data['nama'].'</td>
				<td>'.$data['provinsi'].'</td>
				<td>'.tanggal_indo($data['jadwal']).'</td>
				<td>'.$data['jawaban'].'</td>
				<td>';
				if($data['jawaban'] >= 14){
					echo '<strong class="text-success">LULUS</strong>';
				}else{
					echo '<strong class="text-danger">TIDAK LULUS</strong>';
				}
				echo '</td>';
				if ($user["level"] == "Admin" || $user["level"] == "Staff"){
					echo '<td class="text-center">
						<a href="?page='.$page.'&act=detail&id_member='.$data['id_member'].'" class="btn btn-sm btn-primary" title="Detail Member"><span class="fa fa-window-maximize"></span></a>
						<a href="?page='.$page.'&act=reset&id_member='.$data['id_member'].'" class="btn btn-sm btn-warning" title="Reset Data" onclick="return confirm(\'Reset seluruh hasil tes '.$data['nama'].'?\nSemua hasil tes akan dihapus.\nPeringatan: Data yang sudah dihapus tidak dapat dikembalikan.\')"><span class="fa fa-refresh"></span></a>
					</td>';
				}else{
					echo '';
				}

			echo'</tr>';
			$no++;
		}
	?>
	</tbody>
</table>
