<table id="datatable" class="table table-responsive table-striped table-bordered table-hover" width="100%" cellspacing="0">
	<thead class="table-inverse">
		<tr>
			<th>No.</th>
			<th>Pertanyaan</th>
			<th>Jawaban</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$no = 1;
		$sql = "select j.id_jadwal, s.pertanyaan, s.jawaban jawaban_benar, j.jawaban
						from soal s left join jawaban j on s.id_soal = j.id_soal
						where s.id_kategori = '{$_GET['id_kategori']}' and id_member = '{$_SESSION['id_member']}' and j.id_jadwal = '{$_GET['id_periode']}' ";
		$query = $db->query($sql);
		$jadwal = '';
		while($data = $query->fetch_assoc()){
			echo '<tr>
				<td class="text-center">'.$no.'.</td>
				<td>'.$data['pertanyaan'].'</td>
				<td>'.$data['jawaban'].'</td>
				<td>';
				if($data['jawaban'] == $data['jawaban_benar']){ echo '<span class="text-success"><i class="fa fa-fw fa-check"></i> Benar</span>'; }else{ echo '<span class="text-danger"><i class="fa fa-fw fa-remove"></i> Salah</span>'; }
			echo '</td>
				</tr>';
			$no++;
			$jadwal = $data['id_jadwal'];
		}

	?>
	</tbody>
</table>
<hr>
<?php echo '<a href="?page=hasil&act=detail_category&id_periode='.$jadwal.'" class="btn btn-primary" ><i class="fa fa-caret-left"></i> Kembali</a>' ?>
