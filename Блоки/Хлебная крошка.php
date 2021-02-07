<style>
	.блок-хлебной-крошки {
		color: #666;
		background: #fbfbfb;
		border: 1px solid #e6e6e6;
		padding: 10px;
		margin: 0 0 20px;
	}
	.блок-хлебной-крошки img {
		width: 15px;
		vertical-align: -3px;
	}
	.блок-хлебной-крошки li {
		display: inline-block;
		margin: 0 2px 0 0 !important;
	}
	.блок-хлебной-крошки a {
		color: #df5372;
	}
</style>
<ul class='блок-хлебной-крошки'>
	<li>
		<img src='http://localhost/сайт для гималайской соли/Картинки стиля/5.svg'>&nbsp;
		<a href='http://localhost/сайт для гималайской соли/'>Главная</a>
	</li>
	<?php
		if (!isset ($_GET['страница'])) {
			echo '/ ';
			echo '<li>Каталог</li>';
		} elseif ($_GET['страница'] == 'О товаре') {
			if ($_GET['страница'] == 'О товаре') {
				echo '<li>&nbsp;/</li>&nbsp;<li><a href="http://localhost/сайт для гималайской соли/index.php?страница=Каталог">Каталог</a>&nbsp;</li>';
			}
			echo '<li> / </li><li>' . $_GET['страница'] . '</li>';
		} else {
			if ($_GET['страница'] == 'Статья') {
				echo '<li>&nbsp;/&nbsp;</li><li><a href="http://localhost/сайт для гималайской соли/index.php?страница=Лента">Статьи</a></li>';
			}
		}
	?>
</ul>