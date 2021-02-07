<?php
	session_start();
	$Товар = $_POST['Товар'];
	array_push($_SESSION['Лайки'], "Товар: " . $_POST['Товар']);
	var_dump($_SESSION['Лайки']);
?>