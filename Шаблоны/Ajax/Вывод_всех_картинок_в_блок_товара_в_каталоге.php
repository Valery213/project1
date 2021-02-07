<?php
	$t = $_POST['Каталог'];
	$e = glob ('../../Товары/' . $t . '/*.jpg');
	for ($i=0; $i < count($e); $i++) { 
		$v = substr($e[$i], 6);
		echo "<li class='Картинка'>";
		echo "<img src='";
		echo $v;
		echo "' width='100%; height: 100%; ' />";
		echo "</li>";
		echo "<li class='кнопка' style='width: ";
		$a = 100 / count($e) - 1;
		$b = 100 / count($e) * $i;
		echo $a . "%; left: " . $b . "%;' onmouseover='Наведение_мыши_на_картинку_товара (this); '></li>";
	}
?>