<?php
	session_start();
	$Товар = $_POST['Товар'];
	$Количество = $_POST['Количество_товара'];
	// Если товар есть в массиве прибавим количество товара в элемент массива
	if (count($_SESSION['cart']) == 0) {
		array_push($_SESSION['cart'], "Товар: " . $_POST['Товар'] . "; Стоимость: " . $_POST['Стоимость_товара'] . "; Количество_товара: " . $_POST['Количество_товара'] . "; Категория: " . $_POST['Категория'] . '; ');
	} else {
		$s = 0;
		foreach ($_SESSION['cart'] as $key => $value) {
			$массив = $_SESSION['cart'][$key];
			$массив = explode ('; ', $массив);
			$новый_массив = [];
			foreach ($массив as $keyy => $value) {
				$массив[$keyy] = explode (': ', $value);
				array_push ($новый_массив, $массив[$keyy]);
			}
			foreach ($новый_массив as $value) {
				if ($value[1] == $Товар) {
					$s = 1;
					$новый_массив[2][1] += (int)$Количество;
					array_pop ($новый_массив);
					$Строка = '';
					foreach ($новый_массив as $value) {
						$Строка = $Строка . $value[0] . ': ' . $value[1] . '; ';
					}
					unset ($_SESSION['cart'][$key]);
					array_push($_SESSION['cart'], $Строка);
				}
			}
		}
		if ($s == 0) {
			array_push($_SESSION['cart'], "Товар: " . $_POST['Товар'] . "; Стоимость: " . $_POST['Стоимость_товара'] . "; Количество_товара: " . $_POST['Количество_товара'] . "; Категория: " . $_POST['Категория'] . '; ');
		}
		$_SESSION['cart'] = array_values ($_SESSION['cart']);
	}
?>