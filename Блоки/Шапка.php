<div class='Меню'>
	<div>
		<a href='http://localhost/сайт для гималайской соли/index.php?страница=Каталог'>Каталог</a>
		<a href='http://localhost/сайт для гималайской соли/index.php?страница=Доставка'>Доставка</a>
		<a href='http://localhost/сайт для гималайской соли/index.php?страница=Контакты'>Контакты</a>
		<a href='http://localhost/сайт для гималайской соли/index.php?страница=О нас'>О нас</a>
		<a href='http://localhost/сайт для гималайской соли/index.php?страница=Лента'>Статьи</a>
		<a href='http://localhost/сайт для гималайской соли/index.php?страница=Избранное'>Товары в избранном</a>
	</div>
	<p onclick='show_menu()'>
		<script>
			function show_menu () {
				document.querySelector('.Меню').classList.toggle("show-menu");
			}
		</script>
		<span></span>
	</p>
</div>
<ul class='Шапка'>
	<li>
		<a href='http://localhost/сайт для гималайской соли/'>
			<img src='http://localhost/сайт для гималайской соли/Картинки стиля/1.jpg'>
		</a>
	</li><li>
		<div class='Корзина'>
			<p>
				<img src='http://localhost/сайт для гималайской соли/Картинки стиля/1.svg'>
				Товаров в корзине
				<span id='щетчик_в_шапке'>0</span>
			</p>
			<a href='#' class="Открыть_корзину">Посмотреть корзину</a>
			<script>
				document.querySelector('.Открыть_корзину').onclick = function () {
					document.querySelector('.блок_Корзина').classList.add('a')
					for (var i = 1; i < 10; i++) {
						(function(i) {
							setTimeout (function() {
								document.querySelector('.блок_Корзина').style.opacity = '0.' + i
							}, 100 * i)
						})(i)
					}
					// Выведем все товары из сессии корзины в блок Корзины
					r = new XMLHttpRequest()
					r.open("POST", "http://localhost/сайт для гималайской соли/Шаблоны/Ajax/Вывод всех товаров.php", true)
					r.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
					r.addEventListener("readystatechange", () => {
						if(r.readyState === 4 && r.status === 200) {
							массив = r.responseText.split('; *')
							массив.pop()
							строки = document.querySelector('.блок_Корзина .товары')
							общая_стоимость  = 0
							общее_количество = 0
							for (i in массив) {
								понятие    = массив [i].split('; ')
								Товар      = понятие[0].split(': ')
								Категория  = понятие[3].split(': ')
								Стоимость  = понятие[1].split(': ')
								Количество = понятие[2].split(': ')
								общая_стоимость  += +(Стоимость[1] * Количество[1])
								общее_количество += +(Количество[1])
								строки.innerHTML += `<li Товар="${Товар[1]}" Категория="${Категория[1]}"></li>`
								строки.children[i].innerHTML += `
									<img src="http://localhost/сайт для гималайской соли/Товары/${Категория[1]}/${Товар[1]}/1.jpg">
									<a class='имя' href="?страница=О товаре&категория=${Категория[1]}&Название_товара=${Товар[1]}">${Товар[1]}</a>
									<span class='стоимость'>${Стоимость[1]}</span>
									<input value='${Количество[1]}' class='количество' onkeyup='пересчитаем_стоимость (); пересчет (this); '>
									<ul>
										<li onclick='кнопка_маленькая_плюс (this);'>+</li>
										<li onclick='кнопка_маленькая_минус (this);'>-</li>
									</ul>
									<a href="#" class="удалить" onclick="удалить_товар (this);">Удалить</a>
								`
							}
							document.querySelector('.блок_Корзина .низ').children[1].innerHTML = общая_стоимость
							document.querySelector('.блок_Корзина .низ').children[2].innerHTML = общее_количество
						}
					})
					r.send()
					return false
				}
 			</script>
		</div>
		<form>
			<input type='text' placeholder='Поиск по каталогу...'>
			<input onclick="кнопка_поиска (this); " type='button'>
		</form>
		<script>
			// Запрограммируем поле ввода поиска
			function кнопка_поиска (e) {
				document.querySelector ('.блок-хлебной-крошки').lastChild.innerHTML = 'Поиск'
				if (document.querySelector ('.Каталог')) {
					каталог = document.querySelector ('.Каталог')
					каталог.className += " фильтр"
					каталог.innerHTML = ''
				} else {
					каталог = document.createElement ('ul')
					каталог.className = "Каталог фильтр"
					document.querySelector ('.блок-хлебной-крошки').parentNode.append(каталог)
					k = document.querySelector('.Правая-колонка .Каталог')
				}
				if (document.querySelector ('.Пагинация-блок')) {
					document.querySelector ('.Пагинация-блок').remove()
				}
				if (document.querySelector ('.блок-товара')) {
					document.querySelector ('.блок-товара').remove()
				}
				// Сделаем аякс на каталог для поиска
				r = new XMLHttpRequest()
				r.open("POST", "http://localhost/сайт для гималайской соли/Шаблоны/Ajax/Каталог.php", true)
				r.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
				r.addEventListener("readystatechange", () => {
					if(r.readyState === 4 && r.status === 200) {
						// отфильтруем товары через инпут
						поле_ввода = e.previousElementSibling.value
						q = r.responseText
						q = q.split(';$')
						q.pop()
						ячейка = ''
						for ( i in q ) {
							w = q[i].split('$')
							for (o in w) {
								e = w[o].split(';')
								if (e[0].includes(поле_ввода)) {
									ячейка += `
										<li>
											<a href="http://localhost/сайт для гималайской соли/?страница=О товаре&категория=${e[4]}&Название_товара=${e[0]}">${e[0]}</a>
											<ul class="Слайдер" onmouseout="Уход_мыши_с_товара (this); ">
												<li>
													<img Каталог="${e[3]}/${e[0]}" onmouseover="Наведение_мыши_на_товар (this); " width="100%" src="http://localhost/сайт для гималайской соли/Товары/${e[2]}/1.jpg">
												</li>
											</ul>
											<p style7="float: left;">${e[1]} бел. руб.</p>
										`
									if (массив_лайков.indexOf(e[0]) !== -1){
										ячейка += '<p onclick="В_избранное (this) " class="В_избранное В_избранном" title="Удалить из избранного"></p>'
									} else {
										ячейка += '<p onclick="В_избранное (this) " class="В_избранное" title="Добавить в избранное"></p>'
									}
									ячейка += '</li>'
								}
							}
							k.innerHTML = ячейка
						}
					}
				});
				r.send();
			}
		</script>
	</li>
</ul>
<style>
	.Шапка #щетчик_в_шапке:before {
		content: '';
		border: 5px solid transparent;
		border-right: 5px solid #A2A2A2;
		position: absolute;
		top: 5px;
		left: -10px;
	}
	.Шапка #щетчик_в_шапке {
		position: relative;
		padding: 2px 5px;
		margin-left: 10px;
		background: #A2A2A2;
		color: #e6e6e6;
	}
	.Шапка {
		margin: 0 auto 20px;
		max-width: 1000px;
	}
	.Меню {
		background: #e6e6e6;
	}
	.Меню > div {
		max-width: 1170px;
		margin: auto;
	}
	.Меню a {
		color: #666;
		text-decoration: none;
		text-transform: uppercase;
		font-size: 13px;
		padding: 10px;
		display: inline-block;
		background: none;
		transition: background 200ms, color 200ms;
	}
	.Меню a:hover {
		color: #fff;
		transition: all 200ms;
		background: #df5372;
	}
	.Шапка > *:nth-child(1), .Шапка > *:nth-child(2) {
		width: 50%;
		vertical-align: top;
		display: inline-block;
	}
	.Шапка > *:nth-child(2) {
		text-align: right;
	}
	.Шапка .Корзина {
		padding: 5px 20px 15px;
		position: fixed;
		background: #fff;
		z-index: 1;
		border: 1px solid #40cb2e;
		right: calc(50% - 480px);
	}
	.Шапка .Корзина img {
		position: relative;
		top: 15px;
		left: -5px;
	}
	.Шапка .Корзина a {
		color: #df5372;
		text-decoration: none;
	}
	.Шапка .Корзина p {
		line-height: 30px;
	}
	.Шапка form {
		width: 250px;
		border: 1px solid #ccc;
		color: #A2A2A2;
		background: #e6e6e6;
		overflow: hidden;
		float: right;
		margin: 95px 10px 0;
	}
	.Шапка form *:nth-child(1) {
		width: 220px;
		padding: 5px 10px;
		float: left;
		font-style: italic;   
	}
	.Шапка form *:nth-child(2) {
		width: 30px;
		height: 25px;
		background: url('http://localhost/сайт для гималайской соли/Картинки стиля/2.svg') no-repeat 50% 50%;
		cursor: pointer;
	}
	.форма_в_корзину .в_корзину {
		margin: 0 10px;
		line-height: 25px;
		padding: 0 10px;
	}
	@media (max-width: 700px) {
		.Меню > div {
			display: none;
		}
		.Меню.show-menu > div {
			display: block;
			position: fixed;
			top: 30px;
			background: #000;
		}
		.Меню.show-menu > div a {
			display: block;
			color: #fff;    
		}
		.Меню > p {
			width: 30px;
			height: 30px;
			cursor: pointer;
			position: relative;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.Меню > p span, .Меню > p span:before, .Меню > p span:after {
			background: #000;
			content: '';
			width: 20px;
			height: 2px;
			display: block;
		}
		.Меню > p span:before, .Меню > p span:after {
			position: absolute;
		}
		.Меню > p span:after {
			top: 8px;
		}
		.Меню > p span:before {
			top: 20px;
		}
	}
</style>
