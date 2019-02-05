<table id="datatable" class="table table-responsive table-striped table-bordered table-hover" width="100%" cellspacing="0">
	<thead class="table-inverse">
		<tr>
			<th>No.</th>
			<th>Kategori</th>
      <th>Dijawab</th>
			<th>Jawaban Benar</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$no = 1;
		$sql = "SELECT k.id_kategori, k.nama_kategori, p.created_at AS periode , jd.id_jadwal, count(xj.id_jawaban) as jml_jawaban, count(xb.id_jawaban) jawaban_benar
FROM kategori k
LEFT JOIN (SELECT j.* FROM jawaban j) AS xj ON xj.id_kategori = k.id_kategori
LEFT JOIN (SELECT jb.id_jawaban FROM jawaban jb, soal s WHERE jb.id_soal = s.id_soal AND jb.jawaban = s.jawaban) AS xb ON xb.id_jawaban = xj.id_jawaban
LEFT JOIN jadwal_member p ON p.id_member = xj.id_member
LEFT JOIN jadwal jd ON p.id_jadwal = jd.id_jadwal
WHERE k.publish = 'Ya' AND p.id_member = '{$_SESSION['id_member']}' AND p.id_jadwal = xj.id_jadwal AND p.id_jadwal = '{$_GET['id_periode']}'
GROUP BY p.created_at, k.id_kategori
ORDER BY p.created_at";
		$query = $db->query($sql);
		$correct_jawaban = 0;
		while($data = $query->fetch_assoc()){

			echo '<tr>
				<td class="text-center">'.$no.'.</td>
				<td>'.$data['nama_kategori'].'</td>
				<td>'.$data['jml_jawaban'].'</td>
				<td>'.$data['jawaban_benar'].'</td>
				<td class="text-center">
					<a href="?page='.$page.'&act=detail&id_periode='.$data['id_jadwal'].'&id_kategori='.$data['id_kategori'].'" class="btn btn-sm btn-primary" title="Detail kategori"><span class="fa fa-window-maximize"></span></a>
				</td>
			</tr>';
			$correct_jawaban+= $data['jawaban_benar'];
			$no++;
		}
		if (empty($correct_jawaban)) {
			echo '<tr><td colspan="5" class="text-center"><div class="alert alert-dark">Anda <strong>Belum Melakukan Tes !</strong></div></td></tr>';
		}
		elseif($correct_jawaban >= 14){
			echo '<tr><td colspan="5" class="text-center"><div class="alert alert-success">Selamat, Anda <strong>Lulus</strong> Psikotes !</div></td></tr>';
		}else{
			echo '<tr><td colspan="5" class="text-center"><div class="alert alert-danger">Maaf, Anda <strong>Tidak Lulus</strong> Psikotes !</div></td></tr>';
		}

	?>
	</tbody>
</table>
<hr>
<a href="?page=hasil" class="btn btn-primary" ><i class="fa fa-caret-left"></i> Kembali</a>
