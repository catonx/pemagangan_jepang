<a href="?page=hasil-kesemaptaan&act=resetall" class="btn btn-sm btn-warning" onclick="return confirm('Reset semua hasil tes?\nData yang sudah dihapus tidak dapat dikembalikan.')"><i class="fa fa-fw fa-remove"></i> Reset Semua</a>
<hr />
<table id="datatable" class="table table-responsive table-striped table-bordered table-hover" width="100%" cellspacing="0">
	<thead class="table-inverse">
		<tr>
			<th>No.</th>
			<th>Nama Member</th>
			<th>Keterangan</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$cek = $db->query("select * from tes_kesemaptaan order by id_tes desc limit 1")->fetch_assoc();
		$no = 1;
		$sql = "select m.*, hk.ket from member m
						left join hasil_kesemaptaan hk
						on m.id_member = hk.id_member
						where m.id_member in (SELECT x.id_member FROM (SELECT j.id_member, m.nama , m.provinsi, j.id_jadwal , jw.jadwal, count(j.jawaban) AS jawaban
FROM jawaban j
LEFT JOIN soal s ON s.id_soal = j.id_soal
LEFT JOIN jadwal jw ON jw.id_jadwal = j.id_jadwal
LEFT JOIN member m ON j.id_member = m.id_member
WHERE s.jawaban = j.jawaban
GROUP BY j.id_member, j.id_jadwal) AS X
WHERE x.jawaban >= 14) order by nama";
		$query = $db->query($sql);
		while($data = $query->fetch_assoc()){
			echo '<tr>
				<td class="text-center">'.$no.'.</td>
				<td>'.$data['nama'].'</td>
				<td>';
				if (empty($data['ket'])) {
					echo '<p class="bg-warning text-center"><strong>Belum dinilai</strong></p>';
				}else {
					$retVal = ($data['ket']=='Lulus') ? '<p class="bg-success text-center"><strong>'.$data['ket'].'</strong></p>' : '<p class="bg-danger text-center"><strong>'.$data['ket'].'</strong></p>' ;
					echo $retVal;
				}

				echo '</td>
				<td class="text-center">
					<a href="?page='.$page.'&act=edit&id_member='.$data['id_member'].'" class="btn btn-sm btn-success" title="Edit Member"><span class="fa fa-edit"></span></a>
					<a href="?page='.$page.'&act=detail&id_member='.$data['id_member'].'" class="btn btn-sm btn-primary" title="Detail Member"><span class="fa fa-window-maximize"></span></a>
					<a href="?page='.$page.'&act=reset&id_member='.$data['id_member'].'" class="btn btn-sm btn-warning" title="Reset Data" onclick="return confirm(\'Reset seluruh hasil tes '.$data['nama'].'?\nSemua hasil tes akan dihapus.\nPeringatan: Data yang sudah dihapus tidak dapat dikembalikan.\')"><span class="fa fa-refresh"></span></a>
				</td>
			</tr>';
			$no++;
		}
	?>
	</tbody>
</table>
