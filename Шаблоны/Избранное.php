<div class='две-колонки'>
	<div class='Левая-колонка'>
		<?php include 'Блоки/Контакты в правом блоке.php'; ?>
	</div><div class='Правая-колонка Избранное'>
		<?php include 'Блоки/Хлебная крошка.php'; ?>
		<h1>Товары в избранном</h1>
		<ul class="Каталог Избранное"></ul>
	</div>
</div>
<script>
	function Вывод_избранных_товаров_в_каталоге () {
		массив_лайков = '<?php
			foreach ($_SESSION['Лайки'] as $key => $value) {
				echo $value;
			}
		?>';
		r = new XMLHttpRequest();
		r.open("POST", "http://localhost/сайт для гималайской соли/Шаблоны/Ajax/Каталог.php", true);
		r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		r.addEventListener("readystatechange", () => {
			if (r.readyState === 4 && r.status === 200) {
				q = r.responseText;
				q = q.split(';$');
				q.pop();
				for ( i in q ) {
					w = q[i].split('$');
					for (o in w) {
						e = w[o].split(';');
						if (массив_лайков.indexOf(e[0]) !== -1){
							k.innerHTML += '<li><a href="http://localhost/сайт для гималайской соли/?страница=О товаре&категория=' + e[3] + '&Название_товара=' + e[0] + '">' + e[0] + '</a><ul class="Слайдер" onmouseout="Уход_мыши_с_товара (this); "><li><img Каталог="' + e[3] + '/' + e[0] + '" onmouseover="Наведение_мыши_на_товар (this); " width="100%" src="http://localhost/сайт для гималайской соли/Товары/' + e[2] + '/1.jpg"></li></ul><p style="float: left;">' + e[1] + ' бел. руб.</p><p onclick="В_избранное (this) " class="В_избранное В_избранном" title="Удалить из избранного"></p></li>';
						}
					}
				}
			}
		});
		r.send ();
	}
</script>