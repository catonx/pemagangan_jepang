<?php
session_start();
require_once '../config.php';
if(empty($_SESSION['id_user']) || !isset($_SESSION['id_user'])){
	header('location: ../user.php');
}
$user = $db->query("select * from user where id_user = '{$_SESSION['id_user']}' limit 1")->fetch_assoc();
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$act = isset($_GET['act']) ? $_GET['act'] : 'show';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Content Management System</title>

    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/datatable_old/datatables.min.css" rel="stylesheet">
    <link href="../vendor/datatable_old/DataTables-1.10.15/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">Content Management System</a>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
          <ul class="nav nav-pills flex-column">
			<?php
				if($user['level']=='Admin'){
					$menuAr = array(
											'home'=>'Home',
											'tentang'=>'Tentang',
											'panduan'=>'Panduan Member',
											'member'=>'Member',
											'provinsi'=>'Provinsi',
											'jadwal'=>'Jadwal Tes',
											'kategori'=>'Kategori Soal',
											'soal'=>'Soal',
											'hasil'=>'Hasil Tes',
											'kesemaptaan'=>'Tes Kesemaptaan',
											'hasil-kesemaptaan'=>'Hasil Tes Kesemaptaan',
											'fisik'=>'Tes Ketahanan Fisik',
											'hasil-fisik'=>'Hasil Tes Fisik',
											'user'=>'Admin & Staff',
											'akun'=>'Akun Saya',
											'ganti-password'=>'Ganti Password',
											'keluar'=>'Keluar'
										);
				}else{
					$menuAr = array(
											'home'=>'Home',
											'soal'=>'Soal',
											'hasil'=>'Hasil Tes',
											'member'=>'Member',
											'akun'=>'Akun Saya',
											'ganti-password'=>'Ganti Password',
											'keluar'=>'Keluar'
										);
				}

				foreach($menuAr as $link=>$menu){
					echo '<li class="nav-item"><a class="nav-link';
					if($link == $page){ echo ' active'; }
					echo '" href="?page='.$link.'"><i class="fa fa-fw fa-tag"></i> '.$menu.'</a></li>';
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
    <script src="../vendor/datatable_old/datatables.min.js"></script>
    <script src="../vendor/DataTables/datatables.min.js"></script>
    <script src="../vendor/DataTables/TableTools.ShowSelectedOnly.js"></script>
    <script src="../vendor/datatable_old/DataTables-1.10.15/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/filtering/row-based/TableTools.ShowSelectedOnly.js"></script>
	<script>
		$(document).ready(function() {
			$('#datatable').DataTable();
			$('#datatable-admin').DataTable( {
					dom: 'Bfrtip',
					buttons: [
							'copyHtml5',
							'excelHtml5',
							'csvHtml5',
							'pdfHtml5'
					]

			});
			// $('#result').dataTable({
		  // 	"sDom": 'T<"clear">Sfrtip',
		  //   	"oTableTools": {
		  //     	"sRowSelect": "multi",
		  //     },
		  //     "oLanguage": {
		  //     	"oFilterSelectedOptions": {
		  //       	AllText: "All Widgets",
		  //         SelectedText: "Selected Widgets"
		  //       }
		  //     }
		  // });

		} );
	</script>
    <script src="../vendor/tinymce/tinymce.min.js"></script>
	<script>tinymce.init({ selector:'textarea#box' });</script>
  </body>
</html>
