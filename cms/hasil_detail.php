<?php
if($_GET['detail_act']=='detail'){
	echo '<a href="?page=hasil&act=detail&id_member='.$_GET['id_member'].'" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a><hr />';
?>
<table id="datatable" class="table table-responsive table-striped table-bordered table-hover" width="100%" cellspacing="0">
	<thead class="table-inverse">
		<tr>
			<th>No.</th>
			<th>Pertanyaan</th>
			<th>Jawaban</th>
			<th>Jawaban Benar</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$no = 1;
		$sql = "select s.pertanyaan, s.jawaban jawaban_benar, j.jawaban
						from soal s left join jawaban j on s.id_soal = j.id_soal
						where s.id_kategori = '{$_GET['id_kategori']}'";
		$query = $db->query($sql);
		while($data = $query->fetch_assoc()){
			echo '<tr>
				<td class="text-center">'.$no.'.</td>
				<td>'.$data['pertanyaan'].'</td>
				<td>'.$data['jawaban_benar'].'</td>
				<td>'.$data['jawaban'].'</td>
				<td>';
				if($data['jawaban'] == $data['jawaban_benar']){ echo '<span class="text-success"><i class="fa fa-fw fa-check"></i> Benar</span>'; }else{ echo '<span class="text-danger"><i class="fa fa-fw fa-remove"></i> Salah</span>'; }
			echo '</td>
				</tr>';
			$no++;
		}
	?>
	</tbody>
</table>
<?php
}elseif($_GET['detail_act']=='reset'){
	$sql = "delete from jawaban where id_kategori = '{$_GET['id_kategori']}' and id_member = '{$_GET['id_member']}'";
	$query = $db->query($sql);
	if($query->errno){
		echo '<script>alert("Query error!\n('.$query->errno.') '.$query->error.'");</script>';
	}else{
		echo '<script>alert("Data berhasil direset!");</script>';
		echo '<script>window.location.href="?page='.$page.'&act=detail&id_member='.$_GET['id_member'].'";</script>';
	}
}else{
?>
<table id="datatable" class="table table-responsive table-striped table-bordered table-hover" width="100%" cellspacing="0">
	<thead class="table-inverse">
		<tr>
			<th>No.</th>
			<th>Kategori</th>
			<th>Jml. Soal</th>
			<th>Dijawab</th>
			<th>Jawaban Benar</th>
			<th>Nilai Minimum</th>
			<th>Keterangan</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$no = 1;
		$sql = "select k.id_kategori, k.nama_kategori, k.nilai_min,
						(select count(*) from jawaban where id_kategori = k.id_kategori and id_member = '{$_GET['id_member']}') jml_jawaban,
						(select count(*) from soal where id_kategori = k.id_kategori) jml_soal,
						(select count(*) from jawaban j, soal s
							where j.id_kategori = k.id_kategori and j.id_member = '{$_GET['id_member']}'
							and j.id_soal = s.id_soal and j.jawaban = s.jawaban) jawaban_benar
						from kategori k where k.publish = 'Ya'
						order by k.nama_kategori";
		$query = $db->query($sql);
		while($data = $query->fetch_assoc()){
			echo '<tr>
				<td class="text-center">'.$no.'.</td>
				<td>'.$data['nama_kategori'].'</td>
				<td>'.$data['jml_soal'].'</td>
				<td>'.$data['jml_jawaban'].'</td>
				<td>'.$data['jawaban_benar'].'</td>
				<td>'.$data['nilai_min'].'</td>
				<td>';
				if($data['jawaban_benar'] >= $data['nilai_min']){
					echo '<strong class="text-success">LULUS</strong>';
				}else{
					echo '<strong class="text-danger">TIDAK LULUS</strong>';
				}
				echo '</td>
				<td class="text-center">
					<a href="?page='.$page.'&act=detail&id_member='.$_GET['id_member'].'&detail_act=detail&id_kategori='.$data['id_kategori'].'" class="btn btn-sm btn-primary" title="Detail Member"><span class="fa fa-window-maximize"></span></a>
					<a href="?page='.$page.'&act=detail&id_member='.$_GET['id_member'].'&detail_act=reset&id_kategori='.$data['id_kategori'].'" class="btn btn-sm btn-warning" title="Reset Data" onclick="return confirm(\'Reset hasil tes '.$data['nama_kategori'].'?\nPeringatan: Data yang sudah dihapus tidak dapat dikembalikan.\')"><span class="fa fa-refresh"></span></a>
				</td>
			</tr>';
			$no++;
		}
	?>
	</tbody>
</table>
<?php
}
?>
