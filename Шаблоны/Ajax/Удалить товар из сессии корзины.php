<?php
	session_start();
	$Товар = $_POST['Товар'];
	foreach ($_SESSION['cart'] as $key => $value) {
		$value = explode('; ', $value);
		$value = explode(': ', $value[0]);
		if ($Товар == $value[1]) {
			echo 'В корзину';
			unset ($_SESSION['cart'][$key]);
		}
	}
?>