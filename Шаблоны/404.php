<?php
	ini_set('session.gc_maxlifetime', 864000);
	session_start();
	// Если в магазине нет сессии корзины то создадим ее
	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = [];
	}
	// session_destroy ();
?>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<?php
	include '../Блоки/Корзина.php';
	echo '<div>';
	include '../Блоки/Шапка.php';
	echo '</div>';
	include '../Блоки/Ноги.php';
?>
<style>
	body {
		background: url('http://localhost/сайт для гималайской соли/Картинки стиля/404.jpg') no-repeat bottom center;
	}
	* {
		margin: 0;
		padding: 0;
		list-style: none;
		font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
		font-size: 14px;
		background: none;
		border: 0;
	}
	body {
		display: flex;
		flex-direction: column;
		justify-content: space-between;
		height: 100%;
	}
</style>
<script>
	window.onload = function() {
		// Посчитаем товары в щетчик в шапку
		s = new XMLHttpRequest();
		s.open("POST", "http://localhost/сайт для гималайской соли/Шаблоны/Ajax/Вывод всех товаров.php", true);
		s.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		s.addEventListener("readystatechange", () => {
			if(s.readyState === 4 && s.status === 200) {
				строка = s.responseText;
				массив = строка.split('; *');
				массив.pop();
				щет = 0;
				for ( строка in массив ) {
					понятие = массив[строка].split('; ');
					Количество = понятие[2].split(': ');
					щет += parseInt(Количество[1]);
				}
				document.querySelector('#щетчик_в_шапке').innerHTML = щет;
				// Спрячем / покажем кнопку Посмотреть корзину
				if (document.querySelector('#щетчик_в_шапке').innerHTML != '0') {
					document.querySelector('.Открыть_корзину').style.opacity = '1';
				} else {
					document.querySelector('.Открыть_корзину').style.opacity = '0';
				}
			}
		});
		s.send();
	}
</script>