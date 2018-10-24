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
		$sql = "select k.id_kategori, k.nama_kategori,
						(select count(*) from jawaban where id_kategori = k.id_kategori and id_member = '{$_SESSION['id_member']}') jml_jawaban,
						(select count(*) from jawaban j, soal s
							where j.id_kategori = k.id_kategori and j.id_member = '{$_SESSION['id_member']}'
							and j.id_soal = s.id_soal and j.jawaban = s.jawaban) jawaban_benar
						from kategori k where k.publish = 'Ya'";
		$query = $db->query($sql);
		$correct_jawaban = 0;
		while($data = $query->fetch_assoc()){

			echo '<tr>
				<td class="text-center">'.$no.'.</td>
				<td>'.$data['nama_kategori'].'</td>
				<td>'.$data['jml_jawaban'].'</td>
				<td>'.$data['jawaban_benar'].'</td>
				<td class="text-center">
					<a href="?page='.$page.'&act=detail&id_kategori='.$data['id_kategori'].'" class="btn btn-sm btn-primary" title="Detail kategori"><span class="fa fa-window-maximize"></span></a>
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
