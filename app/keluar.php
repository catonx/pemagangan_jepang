<?php
session_start();
if(isset($_SESSION['id_member']) || isset($_SESSION['mulai']) || isset($_SESSION['soal'])){
	unset($_SESSION['id_member']);
	unset($_SESSION['mulai']);
	unset($_SESSION['soal']);
	session_destroy();
	header('location: ../index.php');
}else{
	header('location: ../index.php');
}
?>
