<table id="datatable" class="table table-responsive table-striped table-bordered table-hover" width="100%" cellspacing="0">
	<thead class="table-inverse">
		<tr>
			<th>No.</th>
			<th>Periode</th>
      <th>Dijawab</th>
			<th>Jawaban Benar</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$no = 1;
		$sql = "SELECT p.created_at, p.id_jadwal, jd.jadwal, count(j.id_jawaban) as jml_jawaban, count(xb.id_jawaban) jawaban_benar
FROM jawaban j
LEFT JOIN (SELECT jb.id_jawaban FROM jawaban jb, soal s WHERE jb.id_soal = s.id_soal AND jb.jawaban = s.jawaban) AS xb ON xb.id_jawaban = j.id_jawaban
LEFT JOIN jadwal_member p ON p.id_member = j.id_member
LEFT JOIN jadwal jd ON p.id_jadwal = jd.id_jadwal
WHERE p.id_member = '{$_SESSION['id_member']}' AND p.id_jadwal = j.id_jadwal
GROUP BY p.created_at, jd.jadwal, p.id
ORDER BY p.created_at";

		$query = $db->query($sql);
		$correct_jawaban = 0;
		while($data = $query->fetch_assoc()){

			echo '<tr>
				<td class="text-center">'.$no.'.</td>
				<td>Periode '.$no.' - '.tanggal_indo($data['jadwal']).' </td>
				<td>'.$data['jml_jawaban'].'</td>
				<td>'.$data['jawaban_benar'].'</td>
				<td class="text-center">
					<a href="?page='.$page.'&act=detail_category&id_periode='.$data['id_jadwal'].'" class="btn btn-sm btn-primary" title="Detail kategori"><span class="fa fa-window-maximize"></span></a>
				</td>
			</tr>';
			$correct_jawaban+= $data['jawaban_benar'];
			$no++;
		}
		if (empty($correct_jawaban)) {
			echo '<tr><td colspan="6" class="text-center"><div class="alert alert-dark">Anda <strong>Belum Melakukan Tes !</strong></div></td></tr>';
		}
		elseif($correct_jawaban >= 14){
			echo '<tr><td colspan="5" class="text-center"><div class="alert alert-success">Selamat, Anda <strong>Lulus</strong> Psikotes !</div></td></tr>';
		}else{
			echo '<tr><td colspan="5" class="text-center"><div class="alert alert-danger">Maaf, Anda <strong>Tidak Lulus</strong> Psikotes !</div></td></tr>';
		}

	?>
	</tbody>
</table>
