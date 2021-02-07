<?php
	ini_set('session.gc_maxlifetime', 864000);
	session_start();
	// Если в магазине нет сессии корзины то создадим ее
	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = [];
		$_SESSION['Лайки'] = [];
		// Сохраним сессию в куки
		setcookie(session_name(), session_id(), time() + 86400);
	}
	// session_destroy ();
	include 'Блоки/Корзина.php';
	echo '<div>';
	include 'Блоки/Шапка.php';
	// Если $_GET (?страница=) пустой или он равен "Каталог" выведем по умолчанию страницу "Каталог"
	if (!isset ($_GET['страница'])) {
		include 'Шаблоны/Каталог.php';
	} elseif (isset ($_GET['страница'])) {
		// Выводим соответствующий шаблон
		if (is_file('Шаблоны/' . $_GET['страница'] . '.php')) {
			include 'Шаблоны/' . $_GET['страница'] . '.php';
		} else {
			// Выведем стиль 404
			?>
				<style>
					body {
						background: url('http://localhost/сайт для гималайской соли/Картинки стиля/404.jpg') no-repeat top center;
					}
				</style>
			<?php
		}
	}
	echo '</div>';
	include 'Блоки/Ноги.php';
?>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<style>
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
	.Каталог .Слайдер {
		position: relative;
	}
	.Каталог .Слайдер li {
		display: none;
	}
	.Каталог .Слайдер li:nth-child(1) {
		display: block;
	}
	.Каталог > li:hover .Слайдер .кнопка {
		display: flex;
		position: absolute;
		top: 0;
		height: 90%;
		color: #6f5a5d;
		border-bottom: 5px solid;
	}
	.Каталог > li:hover .Слайдер .кнопка:hover {
		color: #40cb2e;
	}
	.Каталог {
		text-align: center;
	}
	.Каталог:not(.фильтр) > li {
		display: none;
	}
	.Каталог > li:hover {
		border: 2px solid #40cb2e;
	}
	.Каталог > li:hover .В_избранное {
		display: block;
	}
	.Каталог > li {
		position: relative;
		width: 136px;
		padding: 10px;
		margin: 10px;
		vertical-align: top;
		border: 2px solid #fff;
	}
	.Каталог > li:nth-child(-n + 8),.Каталог.фильтр > li {
		display: inline-block;
	}
	.Каталог a {
		font-size: 16px;
		color: #df5372;
	}
	ul.Каталог p {
		margin: 0;
	}
	.Каталог a + img {
		margin: 10px 0;
	}
	.Каталог .В_избранное.В_избранном,.Каталог .В_избранное.В_избранном:before,.Каталог .В_избранное.В_избранном:after {
		background: red;
		display: block;
	}
	.Каталог .В_избранное {
		background: #000;
		transform: rotate(45deg);
		position: relative;
		top: 5px;
		float: right;
		cursor: pointer;
		display: none;
		width: 10px;
		height: 10px;
	}
	.Каталог .В_избранное:hover,
	.Каталог .В_избранное:hover:before,
	.Каталог .В_избранное:hover:after {
		background: red;
	}
	.Каталог .В_избранное:before,
	.Каталог .В_избранное:after {
		content : '';
		display: block;
		width: 10px;
		height: 10px;
		background-color: #000;
		border-radius: 50%;
		position: absolute;
	}
	.Каталог .В_избранное:before {
		top: -5px;
		left: 0;
	}
	.Каталог .В_избранное:after {
		top: 0;
		left: -5px;
	}
	.Каталог li:hover div {
		display: flex;
		flex-direction: column;
		justify-content: center;
	}
	.Каталог div :first-child {
		padding: 10px 0 5px;
	}
	.Каталог div :last-child {
		padding: 5px 0 10px;
	}
	hr {
		height: 1px;
		background: #e6e6e6;
		margin: 20px 0;
	}
	.две-колонки {
		max-width: 1000px;
		margin: auto;
	}
	.две-колонки > * {
		display: inline-block;
		vertical-align: top;
	}
	.Левая-колонка {
		width: 220px;
		margin: 0 20px;
	}
	.Правая-колонка {
		max-width: calc(100% - 280px);
		width: 100%;
		margin: 0 20px 0 0;
	}
	.блок-товара > * {
		vertical-align: top;
		display: inline-block;
	}
	.блок-товара > :nth-child(1) {
		width: 30%;
	}
	.блок-товара > :nth-child(2) {
		padding-left: 20px;
		width: calc(70% - 20px);
	}
	.блок-товара h1 {
		color: #df5372;
		font-weight: 400;
		font-size: 24px;
	}
	.блок-товара .слайдер * {
		width: calc(30% - 20px);
		cursor: pointer;
		margin: 10px;
	}
	h1 {
		color: #df5372;
		font-size: 39px;
		font-weight: 400;
		margin-bottom: 20px;
	}
	.Правая-колонка p, .Правая-колонка ul {
		color: #666;
		margin: 0 0 10px;
	}
	.Правая-колонка h2 {
		font-size: 18px;
		color: #666;
		margin: 20px 0 10px;
	}
	.Правая-колонка.текстовый_блок ul li {
		color: #666;
		list-style: disc;
		margin-left: 20px;
	}
</style>
<script>
	// Сделаем слайдер в иконке товара при наведении
	function Наведение_мыши_на_товар (e) {
		s = new XMLHttpRequest();
		s.open("POST", "http://localhost/сайт для гималайской соли/Шаблоны/Ajax/Вывод_всех_картинок_в_блок_товара_в_каталоге.php", true);
		s.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		s.addEventListener("readystatechange", () => {
			if(s.readyState === 4 && s.status === 200) {
				e.parentNode.parentNode.innerHTML = s.responseText;
			}
		});
		s.send('Каталог=' + e.getAttribute('Каталог'));
	}
	function Уход_мыши_с_товара (e) {
		t = e.querySelectorAll('.Картинка');
		for( i = 0; i < t.length; i++ ) {
			t[i].style.display = 'none';
		}
		e.firstChild.style.display = 'block';
	}
	function Наведение_мыши_на_картинку_товара (e) {
		t = e.parentNode.querySelectorAll('.Картинка');
		for( i = 0; i < t.length; i++ ) {
			t[i].style.display = 'none';
		}
		e.previousElementSibling.style.display = 'block';
	}
	function В_избранное (e) {
		if (e.classList.contains('В_избранном')) {
			e.classList.remove("В_избранном");
			e.setAttribute ('title', 'Добавить в избранное');
			// Удалим товар из избранного
			r = new XMLHttpRequest();
			r.open("POST", "http://localhost/сайт для гималайской соли/Шаблоны/Ajax/Удалить товар из сессии избранного.php", true);
			r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			r.addEventListener("readystatechange", () => {
				if(r.readyState === 4 && r.status === 200) {
					// console.log (r.responseText);
				}
			});
			r.send('Товар=' + e.parentNode.firstChild.innerHTML);
		} else {
			e.classList.add("В_избранном");
			e.setAttribute ('title', 'Удалить из избранного');
			// Добавим товар в избранное
			r = new XMLHttpRequest();
			r.open("POST", "http://localhost/сайт для гималайской соли/Шаблоны/Ajax/Добавить товар в сессию избранного.php", true);
			r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			r.addEventListener("readystatechange", () => {
				if(r.readyState === 4 && r.status === 200) {
					// console.log (r.responseText);
				}
			});
			r.send('Товар=' + e.parentNode.firstChild.innerHTML);
		}
	}
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
		Пагинация = document.querySelector('.Правая-колонка .Пагинация');
		g = document.querySelector('.Избранное');
		if (g != undefined) {
			Вывод_избранных_товаров_в_каталоге ();
		}
		k = document.querySelector('.Правая-колонка .Каталог');
		l = document.querySelector('.блок-Категории-товаров .div');
		if (l != undefined) {
			l.onclick = function (e) {
				document.body.scrollTop = 0;
				for(i = 0; i < l.querySelectorAll('span').length; i++){
					l.children[i].classList.remove('a');
				}
				e.target.classList.add('a');
				k.innerHTML = '';
				Пагинация.innerHTML = '';
				Вывод_товаров_в_каталоге ();
				r.send('t=' + e.target.innerHTML);
				кнопка_назад.setAttribute ('data', 1);
				кнопка_вперед.setAttribute ('data', 1);
			}
			Вывод_товаров_в_каталоге ();
			r.send ();
		}
		кнопка_вперед = document.querySelector('.Пагинация-блок .Вперед');
		кнопка_назад = document.querySelector('.Пагинация-блок .Назад');
		if (кнопка_вперед != undefined) {
			кнопка_вперед.onclick = function (e) {
				a = e.target.getAttribute('data');
				спаны = Пагинация.querySelectorAll('span');
				if ( a == спаны.length - 1) {
					кнопка_вперед.setAttribute('style', 'cursor: default; opacity: 0;');
				}
				if ( a != спаны.length) {
					document.body.scrollTop = 0;
					кнопка_назад.style.opacity = 1;
					a++;
					e.target.setAttribute('data', a);
					кнопка_назад.setAttribute('data', a);
					q ();
				}
			}
		}
		if (кнопка_назад != undefined) {
			кнопка_назад.onclick = function (e) {
				a = e.target.getAttribute('data');
				a--;
				if (a == 1) {
					кнопка_назад.style.opacity = 0;
				}
				if (a == -1) {
					return
				} else if (a == 0){
					// console.log(a);
				} else {
					document.body.scrollTop = 0;
					кнопка_вперед.setAttribute('data', a);
					кнопка_вперед.style.opacity = 1;
					e.target.setAttribute('data', a);
					q ();
				}
			}
		}
		function q () {
			li = k.childNodes;
			for (j = 0; j < li.length; j++) {
				li[j].style.display = 'none';
			}
			for (z = (a - 1) * 8; z < a * 8; z++) {
				if (li[z] !== undefined) {
					li[z].style.display = 'inline-block';
				}
			}
			for(i = 0; i < Пагинация.querySelectorAll('span').length; i++){
				Пагинация.children[i].classList.remove('a');
			}
			Пагинация.querySelectorAll('span')[a - 1].classList.add('a');
		};
	}
</script>