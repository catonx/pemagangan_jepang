<?php
session_start();
require_once '../config.php';
if(empty($_SESSION['id_user']) || !isset($_SESSION['id_user'])){
	header('location: ../user.php');
}
$user = $db->query("select * from user where id_user = '{$_SESSION['id_user']}' limit 1")->fetch_assoc();
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$act = isset($_GET['act']) ? $_GET['act'] : 'show';

$title = "";

$menuArs = array(
						 array('page'=>'Home','menu'=>'home', 'level'=>'All',),
						 array('page'=>'Tentang','menu'=>'tentang', 'level'=>'Admin',),
						 array('page'=>'Panduan Member','menu'=>'panduan', 'level'=>'Admin',),
						 array('page'=>'Member','menu'=>'member', 'level'=>'All',),
						 array('page'=>'Provinsi','menu'=>'provinsi', 'level'=>'Admin',),
						 array('page'=>'Jadwal Tes','menu'=>'jadwal', 'level'=>'Admin',),
						 array('page'=>'Kategori Soal','menu'=>'kategori', 'level'=>'Admin',),
						 array('page'=>'Soal','menu'=>'soal', 'level'=>'All',),
						 array('page'=>'Hasil Tes','menu'=>'hasil', 'level'=>'All',),
						 array('page'=>'Acuan Kesemaptaan','menu'=>'kesemaptaan', 'level'=>'All',),
						 array('page'=>'Hasil Tes Kesemaptaan','menu'=>'hasil-kesemaptaan', 'level'=>'All',),
						 array('page'=>'Acuan Ketahanan Fisik','menu'=>'fisik', 'level'=>'All',),
						 array('page'=>'Hasil Tes Fisik','menu'=>'hasil-fisik', 'level'=>'All',),
						 array('page'=>'Admin & Staff','menu'=>'user', 'level'=>'Admin',),
						 array('page'=>'Akun Saya','menu'=>'akun', 'level'=>'All',),
						 array('page'=>'Ganti Password','menu'=>'ganti-password', 'level'=>'All',),
						 array('page'=>'Keluar','menu'=>'keluar', 'level'=>'All')
					);

$menu_lists = filter_array($menuArs,'All');
if ($user["level"] == "Admin") {
	$admin = filter_array($menuArs,'Admin');
	$menu_lists = array_merge($menu_lists, $admin);
}else{
	$menu_lists;
}

function filter_array($array, $term){
	$filtered_levels = array();
	$filtered_menus = array();
	foreach($array as $a){
		// var_dump($a);
		if($a['level'] == $term){
			$filtered_levels[]= $a;
		}
	}
	return $filtered_levels;

}

foreach($menu_lists as $active){
	if($active["menu"] == $page){
		$active_menu = $active["menu"];
		$active_page = $active["page"];
	}
}



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>
			<?php
				echo $active_page;
			?>
		</title>

    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/DataTables/datatables.min.css" rel="stylesheet">
    <!-- <link href="../vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
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
					foreach($menu_lists as $link){
						echo '<li class="nav-item"><a class="nav-link';
						if($link["menu"] == $page){
							echo ' active';
						}
						echo '" href="?page='.$link["menu"].'"><i class="fa fa-fw fa-tag"></i> '.$link["page"].'</a></li>';
					}

					?>
          </ul>
        </nav>

        <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
        <?php
					//
					// echo "<pre>";
					// var_dump($active_page);
					// echo "</pre>";
					if ($active_menu == $page) {
						echo '<h1>'.$active_page.'</h1>';
						include $page.'.php';
					}else {
						include 'home.php';
					}
				?>

        </main>
      </div>
    </div>

    <script src="../vendor/jquery/jquery.js"></script>
    <!-- <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="../vendor/DataTables/datatables.min.js"></script>
    <script src="../vendor/DataTables/TableTools.ShowSelectedOnly.js"></script>
    <script src="../vendor/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
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
