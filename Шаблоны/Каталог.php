<script>
	function Вывод_товаров_в_каталоге () {
		массив_лайков = '<?php
			foreach ($_SESSION['Лайки'] as $key => $value) {
				echo $value;
			}
		?>';
		r = new XMLHttpRequest();
		r.open("POST", "http://localhost/сайт для гималайской соли/Шаблоны/Ajax/Каталог.php", true);
		r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		r.addEventListener("readystatechange", () => {
			if(r.readyState === 4 && r.status === 200) {
				q = r.responseText;
				q = q.split(';$');
				q.pop();
				ячейка = '';
				for ( i in q ) {
					w = q[i].split('$');
					for (o in w) {
						e = w[o].split(';');
						ячейка += '<li><a href="http://localhost/сайт для гималайской соли/?страница=О товаре&категория=' + e[3] + '&Название_товара=' + e[0] + '">' + e[0] + '</a><ul class="Слайдер" onmouseout="Уход_мыши_с_товара (this); "><li><img Каталог="' + e[3] + '/' + e[0] + '" onmouseover="Наведение_мыши_на_товар (this); " width="100%" src="http://localhost/сайт для гималайской соли/Товары/' + e[2] + '/1.jpg"></li></ul><p style="float: left;">' + e[1] + ' бел. руб.</p>';
						if (массив_лайков.indexOf(e[0]) !== -1){
							ячейка += '<p onclick="В_избранное (this) " class="В_избранное В_избранном" title="Удалить из избранного"></p>';
						} else {
							ячейка += '<p onclick="В_избранное (this) " class="В_избранное" title="Добавить в избранное"></p>';
						}
						ячейка += '</li>';
					}
					k.innerHTML = ячейка;
				}
				Пагинация.innerHTML = '';
				for (i = 1; i <= Math.ceil((k.childNodes.length - 1) / 8); i++) {
					Пагинация.innerHTML += '<span>' + i + '</span>';
				}
				кнопка_назад.setAttribute('style', 'cursor: default; opacity: 0;');
				if (Пагинация.querySelectorAll('span').length == 1) {
					кнопка_вперед.setAttribute('style', 'cursor: default; opacity: 0;');
				} else {
					кнопка_вперед.style.opacity = 1;
				}
				Пагинация.children[0].classList.add('a');
				Пагинация.onclick = function (e) {
					document.body.scrollTop = 0;
					спаны = Пагинация.querySelectorAll('span');
					for(i = 0; i < спаны.length; i++){
						Пагинация.children[i].classList.remove('a');
						p = e.target.innerHTML;
						e.target.classList.add('a');
						li = k.childNodes;
						for (j = 0; j < li.length; j++) {
							li[j].style.display = 'none';
						}
						for (z = (p - 1) * 8; z < p * 8; z++) {
							if (li[z] !== undefined) {
								li[z].style.display = 'inline-block';
							}
						}
						кнопка_назад.setAttribute ('data', Number(p));
						кнопка_вперед.setAttribute ('data', Number(p));
						кнопка_вперед.style.opacity = 1;
						кнопка_назад.style.opacity = 1;
						if ( p == спаны.length) {
							кнопка_вперед.setAttribute('style', 'cursor: default; opacity: 0;');
						}
						if (p == 1) {
							кнопка_назад.setAttribute('style', 'cursor: default; opacity: 0;');
						}
					}
				}
			}
		});
	}
</script>
<div class='две-колонки'>
	<div class='Левая-колонка'>
		<?php include 'Блоки/Контакты в правом блоке.php'; ?>
		<div class='блок-Категории-товаров'>
			<div>Фильтр</div>
			<div class="div">
				<?php
					$q = scandir ('Товары');
					unset ($q[0], $q[1]);
					foreach ($q as $w) {
						echo "<span>$w</span>";
					}
				?>
			</div>
		</div>
	</div><div class='Правая-колонка'>
		<?php include 'Блоки/Хлебная крошка.php'; ?>
		<ul class="Каталог"></ul>
		<div class="Пагинация-блок">
			<i data='0' class="Назад">Назад</i>
			<div class="Пагинация"></div>
			<i data='1' class="Вперед">Вперед</i>
		</div>
	</div>
</div>
<style>
	.Пагинация {
		border: 1px solid #ddd;
		border-left: 0;
		border-radius: 5px;
	}
	.Пагинация * {
		cursor: pointer;
		color: #df5372;
		padding: 5px 10px;
		border-left: 1px solid #ddd;
	}
	.Пагинация :first-child {
		border-radius: 5px 0 0 5px;
	}
	.Пагинация :last-child {
		border-radius: 0 5px 5px 0;
	}
	.Пагинация .a {
		background: #f5f5f5;
	}
	.Пагинация-блок {
		margin: 20px;
	}
	.Пагинация-блок * {
		display: inline-block;
		cursor: pointer;
	}
	.Пагинация-блок > :first-child {
		opacity: 0;
	}
	.Пагинация-блок i {
		padding: 5px 10px;
		color: #df5372;
		border: 1px solid #ddd;
		border-radius: 5px;
	}
	.блок-Категории-товаров {
		padding: 20px;
		background: #f9f9f9;
		border: 1px solid #e6e6e6;
		border-radius: 5px;
		margin: 0 0 20px;
	}
	.блок-Категории-товаров > *:first-child {
		font-size: 20px;
		border-bottom: 1px solid #e6e6e6;
		padding: 0 0 15px;
		margin: 0 0 15px;
		color: #df5372;
	}
	.блок-Категории-товаров span {
		cursor: pointer;
		display: block;
	}
	.блок-Категории-товаров span:hover {
		color: #df5372;
	}
	.блок-Категории-товаров .a {
		color: #df5372;
	}
</style>