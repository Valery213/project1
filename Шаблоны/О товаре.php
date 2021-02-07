<div class='две-колонки'>
	<div class='Левая-колонка'>
		<?php include 'Блоки/Контакты в правом блоке.php'; ?>
	</div><div class='Правая-колонка'>
		<?php
			include 'Блоки/Хлебная крошка.php';
			$r = $_GET['категория'];
			$t = $_GET['Название_товара'];
		?>
		<div class="блок-товара">
			<div>
				<img id="большая_картинка" src="http://localhost/сайт для гималайской соли/Товары/<?php echo $r . '/' . $t; ?>/1.jpg" width="100%">
				<div class="слайдер">
					<?php
						$a = glob ('Товары/' . $r . '/' . $t . '/*.jpg');
						foreach ($a as $v) {
							echo '<img src="http://localhost/сайт для гималайской соли/' . $v . '">';
						}
					?>
				</div>
			</div><div>
				<h1><?php echo $t; ?></h1>
				<div>
					<div class="Стоимость">
						<span id="Стоимость_товара">
							<?php
								// Закодируем урл с пробелами
								$p = parse_url ("http://localhost/сайт для гималайской соли/Товары/$r/$t/");
								$i = $p['scheme'] . '://' . $p['host'] . implode('/', array_map('rawurlencode', array_map('rawurldecode', explode('/', $p['path']))));
								echo file_get_contents ($i . '/Стоимость');
							?>
						</span>
						бел. руб.
					</div><div class="форма_в_корзину">
						<span class="Количество">Количество</span>
						<form action="">
							<table>
								<tr>
									<td rowspan="2">
										<input type="text" class="поле_ввода" value="1">
									</td>
									<td>
										<input type="button" value="+" class="кнопка_маленькая кнопка_маленькая_плюс">
									</td>
									<td rowspan="2">
										<input type="button" value="В корзину" class="в_корзину">
									</td>
								</tr>
								<tr>
									<td>
										<input type="button" value="-" class="кнопка_маленькая кнопка_маленькая_минус">
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
				<p class="Лайк" onclick="В_избранное_в_товаре (this); ">Лайки</p>
				<hr>
				<p class="h2">Краткое описание</p>
				<?php
					$j = file_get_contents($i . 'Краткое_описание');
					$массив = explode(';', $j);
					array_pop ($массив);
					echo '<ul class="Краткое-описание">';
					foreach ($массив as $value) {
						echo "<li>$value</li>";
					}
					echo '</ul>';
					echo '<p class="h3">Oписание</p>';
					echo "<p class='Описание'>";
					echo file_get_contents($i . 'Описание');
					echo "</p>";
				?>
			</div>
		</div>
	</div>
</div>
<style>
	.блок-товара .Описание {
		margin: 20px 0;
	}
	.блок-товара .h2,.блок-товара .h3 {
		color: #666;
		margin: 0 0 20px;
		font-size: 18px;
		font-weight: 600;
	}
	.блок-товара .h3 {
		margin: 30px 0 0;
	}
	.блок-товара .Краткое-описание li {
		list-style: disc;
		margin: 0 0 5px 20px;
		color: #666;
	}
	.блок-товара h1 {
		margin: 0 0 20px;
	}
	.блок-товара h1 + * > * {
		width: 50%;
		display: inline-block;	
		vertical-align: top;
		position: relative;
	}
	.блок-товара .Стоимость, .блок-товара .Стоимость * {
		font-size: 24px;
	}
	.блок-товара .Лайк:hover,
	.блок-товара .Лайк:hover:before,
	.блок-товара .Лайк:hover:after,
	.блок-товара .Лайк.В_избранном,
	.блок-товара .Лайк.В_избранном:before,
	.блок-товара .Лайк.В_избранном:after {
		background: red;
	}
	.блок-товара .Лайк {
		background: #000;
		transform: rotate(45deg);
		top: 0;
		right: 0;
		font-size: 0;
		width: 10px;
		height: 10px;
		cursor: pointer;
	}
	.блок-товара .Лайк:before,
	.блок-товара .Лайк:after {
		content : '';
		display: block;
		width: 10px;
		height: 10px;
		background-color: #000;
		border-radius: 50%;
		position: absolute;
	}
	.блок-товара .Лайк:before {
		top: -5px;
		left: 0;
	}
	.блок-товара .Лайк:after {
		top: 0;
		left: -5px;
	}
	.блок-товара .форма_в_корзину input {
		border: 1px solid #d5d5d5;
		border-radius: 3px; 
	}
	.блок-товара .форма_в_корзину .поле_ввода {
		width: 50px;
		line-height: 35px;
		text-align: center;
	}
	.блок-товара .форма_в_корзину .кнопка_маленькая {
		width: 15px;
		line-height: 15px;
		text-align: center;
	}
	.блок-товара .форма_в_корзину .в_корзину, .блок-товара .форма_в_корзину .кнопка_маленькая {
		cursor: pointer;
	}
	.блок-товара .форма_в_корзину .в_корзину {
		margin: 0 10px;
		line-height: 25px;
		padding: 0 10px;
	}
	.блок-товара .форма_в_корзину .в_корзину:hover,.блок-товара .форма_в_корзину .в_корзину.a {
		background: #df5372;
		color: #fff;
		border-color: #df5372;
	}
</style>
<script>
	массив_лайков = '<?php
		foreach ($_SESSION['Лайки'] as $key => $value) {
			echo $value;
		}
	?>';
	Лайк = document.querySelector('.Лайк');
	if (массив_лайков.indexOf('<?php echo $t; ?>') !== -1){
		Лайк.classList.add("В_избранном");
		Лайк.setAttribute ('title', 'Удалить из избранного');
	} else {
		Лайк.classList.remove("В_избранном");
		Лайк.setAttribute ('title', 'Добавить в избранное');
	}
	function В_избранное_в_товаре (e) {
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
			r.send('Товар=<?php echo $t; ?>');
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
			r.send('Товар=<?php echo $t; ?>');
		}
	}
	document.querySelector('.кнопка_маленькая_плюс').onclick = function () {
		a = document.querySelector('.поле_ввода').value;
		document.querySelector('.поле_ввода').value = ++a;
	}
	document.querySelector('.кнопка_маленькая_минус').onclick = function () {
		a = document.querySelector('.поле_ввода').value;
		if (--a != 0) {
			document.querySelector('.поле_ввода').value = a;
		}
	}
	document.querySelector('.слайдер').onclick = function (e) {
		document.querySelector('#большая_картинка').setAttribute ('src', e.target.getAttribute ('src'));
	}
	document.querySelector('.в_корзину').onclick = function () {
		// Добавим в сессию корзины товар аяксом
		r = new XMLHttpRequest();
		r.open("POST", "http://localhost/сайт для гималайской соли/Шаблоны/Ajax/Добавить товар в сессию корзины.php", true);
		r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		r.addEventListener("readystatechange", () => {
			if(r.readyState === 4 && r.status === 200) {
				// console.log (r.responseText);
			}
		});
		Количество_товара = document.querySelector('.поле_ввода').value;
		Стоимость_товара  = document.querySelector('#Стоимость_товара').innerHTML;
		
		var категория = document.location.search;
		var searchParams = new URLSearchParams(категория);
		// console.log(searchParams.get("категория"));
		
		r.send('Товар=<?php echo $t; ?>&Стоимость_товара=' + Стоимость_товара + '&Количество_товара=' + Количество_товара + '&Категория=' + searchParams.get("категория"));
		// Прибавим щет корзины в шапке
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