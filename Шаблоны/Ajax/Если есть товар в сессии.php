<?php
	session_start();
	$Товар = $_POST['Товар'];
	foreach ($_SESSION['cart'] as $value) {
		$value = explode('; ', $value);
		$value = explode(': ', $value[0]);
		if ($Товар == $value[1]) {
			echo 'В корзине';
		}
	}
?>