<script>
	function удалить_товар (e) {
		if (confirm("Удалить товар из корзины?")) {
			Товар = e.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText
			e.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.parentNode.remove()
			r = new XMLHttpRequest()
			r.open("POST", "http://localhost/сайт для гималайской соли/Шаблоны/Ajax/Удалить товар из сессии корзины.php", true)
			r.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
			r.send(`Товар=${Товар}`)
		}
		пересчитаем_стоимость ()
		инкремет_аякс ()
	}
	function пересчитаем_стоимость () {
		общая_стоимость = document.querySelector('.блок_Корзина .низ').children[1]
		все_товары = document.querySelector('.блок_Корзина .товары').childNodes
		суммарная_стоимость_товаров = 0
		щет2 = 0
		for (var i = 0; i < все_товары.length; i++) {
			суммарная_стоимость_товаров += все_товары[i].children[2].innerText * все_товары[i].children[3].value
			щет2 += +(все_товары[i].children[3].value)
		}
		общая_стоимость.innerHTML = суммарная_стоимость_товаров
		document.querySelector('.блок_Корзина .низ li').children[2].innerText = щет2
		document.querySelector('#щетчик_в_шапке').innerText = щет2
	}
	function закрыть_Корзину () {
		document.querySelector('.блок_Корзина').style.opacity = 0
		document.querySelector('.блок_Корзина').classList.remove("a")
		document.querySelector('.блок_Корзина .товары').innerHTML = ''
	}
	function кнопка_маленькая_плюс (e) {
		щет = e.parentNode.previousElementSibling.value
		e.parentNode.previousElementSibling.value = ++щет
		пересчитаем_стоимость ()
		инкремет (e)
	}
	function кнопка_маленькая_минус (e) {
		щет = e.parentNode.previousElementSibling.value
		if (--щет != 0) {
			e.parentNode.previousElementSibling.value = щет
			пересчитаем_стоимость ()
			инкремет (e)
		}
	}
	function инкремет_аякс () {
		// Прибавим щет корзины в шапке
		s = new XMLHttpRequest()
		s.open("POST", "http://localhost/сайт для гималайской соли/Шаблоны/Ajax/Вывод всех товаров.php", true)
		s.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		s.addEventListener("readystatechange", () => {
			if(s.readyState === 4 && s.status === 200) {
				строка = s.responseText
				массив = строка.split('; *')
				массив.pop()
				щет = 0
				for (строка in массив) {
					понятие =  массив[строка].split('; ')
					Количество =  понятие[2].split(': ')
					щет += +Количество[1]
				}
				document.querySelector('#щетчик_в_шапке').innerHTML = щет
				// Спрячем / покажем кнопку Посмотреть корзину
				if (document.querySelector('#щетчик_в_шапке').innerHTML != '0') {
					document.querySelector('.Открыть_корзину').style.opacity = '1'
				} else {
					document.querySelector('.Открыть_корзину').style.opacity = '0'
				}
			}
		});
		s.send();
	}
	function пересчет (e) {
		Товар = e.parentNode.getAttribute('Товар')
		Категория = e.parentNode.getAttribute('Категория')
		Стоимость = e.previousElementSibling.innerText
		щет = e.value
		// Выполиним аякс на инкремет товара
		Аякс = new XMLHttpRequest()
		Аякс.open("POST", "http://localhost/сайт для гималайской соли/Шаблоны/Ajax/Инкремент товара в корзине.php", true)
		Аякс.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		Аякс.send(`Товар=${Товар}&щет=${щет}&Стоимость=${Стоимость}&Категория=${Категория}`)
	}
	function инкремет (e) {
		Товар 	  = e.parentNode.parentNode.getAttribute('Товар')
		Категория = e.parentNode.parentNode.getAttribute('Категория')
		Стоимость = e.parentNode.previousElementSibling.previousElementSibling.innerHTML
		// Выполиним аякс на инкремет товара
		r = new XMLHttpRequest()
		r.open("POST", "http://localhost/сайт для гималайской соли/Шаблоны/Ajax/Инкремент товара в корзине.php", true)
		r.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		r.send(`Товар=${Товар}&щет=${щет}&Стоимость=${Стоимость}&Категория=${Категория}`)
		инкремет_аякс ()
	}
	function оформить_заказ () {
		document.querySelector ('#id_1').style.display = 'none'
		document.querySelector ('#id_2').style.display = 'block'
	}
	function вернуться_к_форме_заказа () {
		document.querySelector ('#id_1').style.display = 'block'
		document.querySelector ('#id_2').style.display = 'none'
	}
</script>
<ul class="блок_Корзина">
	<li id="id_1">
		<a href="#" class="закрыть_Корзину" onclick='закрыть_Корзину()'></a>
		<p class="title">Корзина</p>
		<p class="имя" style="vertical-align: 10px; ">Товар</p>
		<p style="width: 60px; display: inline-block;"></p>
		<p class="стоимость" style="vertical-align: 10px; ">Стоимость еденицы (бел. р.)</p>
		<p class="количество" style="vertical-align: 20px; ">Количество в корзине</p>
		<ul class="товары"></ul>
		<ul class="низ">
			<li style="width: 45%; ">Итого</li>
			<li style="width: 20%; text-align: center; "></li>
			<li style="width: 20%; text-align: center; "></li>
			<li style="width: 15%; text-align: center; ">
				<a class="розовая_кнопка" href="#" onclick="оформить_заказ (); return false; ">Оформить заказ</a>
			</li>
		</ul>
	</li>
	<li id="id_2" style="display: none; width: 400px; ">
		<a href="#" class="закрыть_Корзину" onclick='закрыть_Корзину()'></a>
		<p class="title">Контактные данные:</p>
		<form>
			<ul>
				<li style="text-align: left; ">
					<input placeholder="Имя">
					<input placeholder="Город">
					<input placeholder="Улица">
				</li>
				<li style="text-align: right; ">
					<input placeholder="Квартира">
					<input placeholder="Телефон">
					<input placeholder="email">
				</li>
				<li>
					<a class="розовая_кнопка" href="#" onclick="вернуться_к_форме_заказа (); return false; ">Вернуться в корзину</a>
				</li>
				<li style="text-align: right; ">
					<a class="розовая_кнопка" href="#">Подтвердить заказ</a>
				</li>
			</ul>
		</form>
	</li>
</ul>
<style>
	.розовая_кнопка {
		background: #df5372;
		color: #fff;
		text-decoration: none;
		padding: 5px;
		font-size: 12px;
		border-radius: 3px;
	}
	.блок_Корзина form li {
		width: 50%;
		display: inline-block;
		padding-bottom: 10px;
	}
	.блок_Корзина form ul {
		width: 100%;
		font-size: 0;
	}
	.блок_Корзина form input {
		border: 1px solid Gray;
		border-radius: 3px;
		padding: 5px;
		margin: 5px;
	}
	.блок_Корзина .низ {
		font-size: 0;
		margin: 20px 0;
	}
	.блок_Корзина .низ li {
		font-size: 14px;
		display: inline-block;
	}
	.title {
		color: #df5372;
		font-weight: 600;
		font-size: 24px;
	}
	.закрыть_Корзину:hover:after,.закрыть_Корзину:hover:before {
		background: #fff;
	}
	.закрыть_Корзину:after {
		transform: rotate(-45deg);
	}
	.закрыть_Корзину:before {
		transform: rotate(45deg);
	}
	.закрыть_Корзину:before, .закрыть_Корзину:after {
		content: '';
		position: absolute;
		height: 9px;
		width: 2px;
		background: #aa2c2c;
		top: 5px;
		left: 9px;
	}
	.закрыть_Корзину {
		position: absolute;
		top: 0;
		right: 0;
		width: 20px;
		height: 20px;
		background: Gray;
		border-radius: 50%;
	}
	.блок_Корзина .имя, .блок_Корзина .стоимость, .блок_Корзина .количество {
		display: inline-block;
		vertical-align: 30px;
	}
	.блок_Корзина input.количество {
		border: 1px solid #d5d5d5;
		padding: 5px;
	}
	.блок_Корзина img {
		margin-right: 20px;
		width: 50px;
	}
	.товары > li {
		border-bottom: 1px solid #000;
		padding: 10px 15px 0;
		margin: 0;
		font-size: 0;
	}
	.блок_Корзина .имя {
		width: calc(45% - 70px);
	}
	.блок_Корзина .стоимость {
		width: 20%;
		text-align: center;
	}
	.блок_Корзина .количество {
		width: 20%;
		text-align: center;
	}
	.товары ul {
		display: inline-block;
		vertical-align: 20px;
	}
	.товары ul * {
		margin: 5px;
		width: 15px;
		line-height: 15px;
		text-align: center;
		cursor: pointer;
		border: 1px solid #d5d5d5;
		border-radius: 3px;
	}
	.блок_Корзина .удалить {
		width: 10%;
		display: inline-block;
		vertical-align: 30px;
		color: red;
		text-align: center;
	}
	.блок_Корзина {
		display: none;
		opacity: 0;
	}
	.блок_Корзина.a {
		display: flex;
		align-items: center;
		justify-content: center;
		background: rgba(0,0,0,.2);
		position: fixed;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		z-index: 2;
	}
	.блок_Корзина > li {
		background: #fff;
		font-size: 0;
		max-width: 800px;
		width: 800px;
		margin: 0 20px;
		position: relative;
		padding: 20px;
		border-radius: 10px;
	}
</style>