<?php
ob_start();

	session_start();
	
	//mysqli_close($co);
	//libere cookie
	//setcookie("co", "", time()-3600);
	//libere session
	session_destroy();
	header('location:../index.php');
?>