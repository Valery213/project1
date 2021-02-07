<div class='две-колонки'>
	<div class='Левая-колонка'>
		<?php include 'Блоки/Контакты в правом блоке.php'; ?>
	</div><div class='Правая-колонка'>
		<?php
			include 'Блоки/Хлебная крошка.php';
			// Выведем привью всех статей
			$лента = glob ('Статьи/*');
			echo "<ul class='Лента'>";
			foreach ($лента as $value) {
				echo "<li>";
					echo "<img src='http://localhost/сайт для гималайской соли/$value/привьюшка.jpg' width='100%;'>";
					echo "<p class='h2'>";
						echo substr($value, 13);
					echo "</p>";
					echo "<p>";
						echo file_get_contents ('Статьи/' . substr($value, 13) . '/Краткий текст.php');
					echo "</p>";
					echo "<a class='Подробнее' href='http://localhost/сайт для гималайской соли/index.php?страница=Статья&Название_статьи=" . substr($value, 13) . "'>Подробнее</a>";
				echo "</li>";
			}
		?>
		</ul>
	</div>
</div>
<style>
	ul.Лента .h2 {
		font-weight: 600;
		margin: 10px 0;
	}
	ul.Лента .Подробнее {
		background: #df5372;
		padding: 5px 10px;
		color: #fff;
		text-decoration: none;
		border-radius: 5px;
		vertical-align: -10px;
	}
	ul.Лента li {
		list-style: none;
		width: calc(50% - 20px);
		display: inline-block;
		margin: 0 0 20px 20px;
		vertical-align: top;
	}
	.Лента p {
		color: #333;
	}
</style>