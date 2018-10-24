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
		$sql = "SELECT m.id_member, m.nama , m.provinsi, CONCAT(j.tgl,' ', j.bln,' ', j.thn) AS jadwal, count(x.jawaban) AS jawaban
    FROM member m
    LEFT JOIN
    (SELECT j.jawaban, j.id_member FROM jawaban j LEFT JOIN soal s ON s.id_soal = j.id_soal WHERE s.jawaban = j.jawaban) AS x ON x.id_member = m.id_member
    LEFT JOIN jadwal j ON j.id_jadwal = m.id_jadwal
    WHERE m.id_member IN (SELECT id_member FROM jawaban)
    GROUP BY m.id_member";
		$query = $db->query($sql);
		while($data = $query->fetch_assoc()){
			echo '<tr>
				<td class="text-center">'.$no.'.</td>
				<td>'.$data['nama'].'</td>
				<td>'.$data['provinsi'].'</td>
				<td>'.$data['jadwal'].'</td>
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
