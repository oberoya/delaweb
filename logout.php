<?php
	session_start();
	unset($_SESSION['session_email']);
	unset($_SESSION['session_name']);
	session_destroy();
	header("location:index.php");
?>