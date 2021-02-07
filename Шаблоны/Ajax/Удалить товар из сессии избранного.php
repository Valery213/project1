<?php
	session_start();
	$Товар = $_POST['Товар'];
	foreach ($_SESSION['Лайки'] as $key => $value) {
		$value = explode('; ', $value);
		$value = explode(': ', $value[0]);
		if ($Товар == $value[1]) {
			unset ($_SESSION['Лайки'][$key]);
		}
	}
	var_dump($_SESSION['Лайки']);
?>