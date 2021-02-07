<div class='две-колонки'>
	<div class='Левая-колонка'>
		<?php include 'Блоки/Контакты в правом блоке.php'; ?>
	</div><div class='Правая-колонка'>
		<?php include 'Блоки/Хлебная крошка.php'; ?>
		<h1>Отправить сообщение</h1>
		<p>Все поля, являются обязательными для заполнения.</p>
		<form action="" class="форма_обратной_связи">
			<ul>
				<li>
					<label>Ваше имя: <input type="text" placeholder=""></label>
				</li>
				<li>
					<label>Email: <input type="text" placeholder=""></label>
				</li>
				<li class="textarea">
					<label>Ваше сообщение:
						<textarea name="" cols="30" rows="10"></textarea>
					</label>
				</li>
				<li></li>
				<li style="text-align: right;"><input type="button" value="Отправить сообщение"></li>
			</ul>
		</form>
	</div>
</div>
<style>
	.форма_обратной_связи ul input[type=button] {
		background: #df5372;
		padding: 5px;
		color: #fff;
		text-decoration: none;
		border-radius: 5px;
		cursor: pointer;
	}
	.форма_обратной_связи ul {
		font-size: 0;
	}
	.форма_обратной_связи ul li {
		list-style: none;
		width: calc(50% - 10px);
		padding: 5px;
		display: inline-block;
		margin: 0;
	}
	.форма_обратной_связи ul li.textarea {
		width: calc(100% - 10px);
	}
	.форма_обратной_связи ul li label {
		cursor: pointer;
	}
	.форма_обратной_связи ul li input[type=text],.форма_обратной_связи ul li textarea {
		border: 1px solid #ccc;
		width: 100%;
		padding: 5px 10px;
		margin-top: 5px;
		border-radius: 5px;
	}
</style>