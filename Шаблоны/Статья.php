<div class='две-колонки'>
	<div class='Левая-колонка'>
		<?php include 'Блоки/Контакты в правом блоке.php'; ?>
	</div><div class='Правая-колонка Статья'>
		<?php
			include 'Блоки/Хлебная крошка.php';
			$t = $_GET['Название_товара'];
			$r = $_GET['категория'];
			$a = glob ('*');

			$лента = glob ('Статьи/*');
			echo "<h1>";
				echo $_GET['Название_статьи'];
			echo "</h1>";
			echo file_get_contents ('Статьи/' . $_GET['Название_статьи'] . '/текст.php');
		?>
	</div>
</div>
<style>
	ul.Лента {

	}
	ul.Лента li {
		list-style: none;
		width: calc(50% - 20px);
		display: inline-block;
	}
	.Статья h1 {
		color: #df5372;
		font-size: 39px;
		font-weight: 400;
		margin-bottom: 20px;
	}
	.Статья p, .Статья ul {
		color: #666;
		margin: 0 0 10px;
	}
	.Статья ul li {
		color: #666;
		margin-left: 20px;
		list-style: disc;
	}
	.Статья ol li {
		color: #666;
		margin-left: 20px;
		list-style: decimal;
	}
	.Статья ol {
		margin-bottom: 20px;
	}
</style>