<?php
	session_start();
	$Товар 		= $_POST['Товар'];
	$Количество = $_POST['щет'];
	$Категория  = $_POST['Категория'];
	foreach ($_SESSION['cart'] as $key => $value) {
		$value = explode ('; ', $value);
		$value = explode (': ', $value[0]);
		if ($value[1] == $Товар) {
			unset ($_SESSION['cart'][$key]);
			array_push($_SESSION['cart'], "Товар: " . $_POST['Товар'] . "; Стоимость: " . $_POST['Стоимость'] . "; Количество_товара: " . $_POST['щет'] . "; Категория: " . $_POST['Категория'] . "; ");
		}
	}
?>