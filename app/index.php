<?php
ob_start();
session_start();
require_once '../config.php';
if(empty($_SESSION['id_member']) || !isset($_SESSION['id_member'])){
	header('location: ../');
}
// concat(j.tgl,'-',j.bln,'-',j.thn) as jadwal
$uye = "select m.*, j.jadwal, j.id_jadwal
from member m
left join jadwal_member jm on m.id_member = jm.id_member
left join jadwal j on jm.id_jadwal = j.id_jadwal
where m.id_member = '{$_SESSION['id_member']}'";
$member = $db->query($uye)->fetch_assoc();
// $member = $db->query("select * from member where id_member = '{$_SESSION['id_member']}' limit 1")->fetch_assoc();
// var_dump($member);
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$act = isset($_GET['act']) ? $_GET['act'] : 'show';
$today = date('Y-n-j');
$tgl_now = tanggal_indo($today);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Computer Based Test</title>

		<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/DataTables/datatables.min.css" rel="stylesheet">
    <!-- <link href="../vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">Computer Based Test</a>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
          <ul class="nav nav-pills flex-column">
			<?php
				$menuAr = array('home'=>'Home','biodata'=>'Biodata','jadwal'=>'Jadwal Tes','soal'=>'Soal Tes','hasil'=>'Hasil Tes','hasil-kesemaptaan'=>'Hasil Tes Kesemaptaan','hasil-fisik'=>'Hasil Tes Fisik','ganti-password'=>'Ganti Password','keluar'=>'Keluar');
				foreach($menuAr as $link=>$menu){
					echo '<li class="nav-item"><a class="nav-link';
					if($link == $page){ echo ' active'; }
					echo '" href="?page='.$link.'"><i class="fa fa-fw fa-chevron-right"></i> '.$menu.'</a></li>';
				}
			?>
          </ul>
        </nav>

        <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
        <?php
			if(in_array($menuAr[$page],$menuAr)){
				echo '<h1>'.$menuAr[$page].'</h1>';
				include $page.'.php';
			}else{
				include 'home.php';
			}
		?>

        </main>
      </div>
    </div>

		<script src="../vendor/jquery/jquery.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="../vendor/DataTables/datatables.min.js"></script>
		<script src="../vendor/DataTables/TableTools.ShowSelectedOnly.js"></script>
		<script src="../vendor/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#datatable').DataTable();
		} );
	</script>
  <script src="../vendor/tinymce/tinymce.min.js"></script>
	<script>tinymce.init({ selector:'textarea#box' });</script>
<!--
  <script src="../vendor/jquery-countdown/jquery.countdown.min.js"></script>

	<script>
		var waktu = new Date().getTime() + 300000;
		$('#timer').countdown(waktu, function(event) {
			$(this).html(event.strftime('%M:%S'));
		}).on('finish.countdown', function(event) {
			alert("Waktu anda telah habis! Terima kasih sudah mengerjakan tes ini.");
			document.getElementById('form_soal').submit();
			url = '?page=soal';
			$(location).attr("href", url);


		});;
	</script>
-->
	<!-- Script Timer -->
    <script type="text/javascript">
        $(document).ready(function() {
            /** Membuat Waktu Mulai Hitung Mundur Dengan
                * var detik;
                * var menit;
                * var jam;
            */
            var detik   = <?= $detik; ?>;
            var menit   = <?= $menit; ?>;
            var jam     = <?= $jam; ?>;

            /**
               * Membuat function hitung() sebagai Penghitungan Waktu
            */
            function hitung() {
                /** setTimout(hitung, 1000) digunakan untuk
                     * mengulang atau merefresh halaman selama 1000 (1 detik)
                */
                setTimeout(hitung,1000);

                /** Jika waktu kurang dari 10 menit maka Timer akan berubah menjadi warna merah */
                if(menit < 10 && jam == 0){
                    var peringatan = 'style="color:red"';
                };

                /** Menampilkan Waktu Timer pada Tag #Timer di HTML yang tersedia */
                $('#timer').html(
                    jam + ' jam : ' + menit + ' menit : ' + detik + ' detik'
                );

                /** Melakukan Hitung Mundur dengan Mengurangi variabel detik - 1 */
                detik --;

                /** Jika var detik < 0
                    * var detik akan dikembalikan ke 59
                    * Menit akan Berkurang 1
                */
                if(detik < 0) {
                    detik = 59;
                    menit --;

                   /** Jika menit < 0
                        * Maka menit akan dikembali ke 59
                        * Jam akan Berkurang 1
                    */
                    if(menit < 0) {
                        menit = 59;
                        jam --;

                        /** Jika var jam < 0
                            * clearInterval() Memberhentikan Interval dan submit secara otomatis
                        */

                        if(jam < 0) {
                            clearInterval(hitung);
                            /** Variable yang digunakan untuk submit secara otomatis di Form */
                            var frmSoal = document.getElementById("form_soal");
                            alert('Waktu Anda telah habis.');
                            form_soal.submit();
														window.location.href="clear_session.php";
                        }
                    }
                }
            }
            /** Menjalankan Function Hitung Waktu Mundur */
            hitung();
        });
    </script>
  </body>
</html>
