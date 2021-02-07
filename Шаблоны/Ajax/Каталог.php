<?php
	$t = $_POST['t'];
	if (!isset($t)) {
		$q = scandir ('../../Товары/');
		unset ($q[0], $q[1]);
		foreach ($q as $t) {
			u ($t);
		}
	} else {
		u ($t);
	}
	function u ($t) {
		$e = scandir ('../../Товары/' . $t);
		unset ($e[0], $e[1]);
		foreach ($e as $r) {
			echo $r;
			echo ';';
			// Закодируем урл с пробелами
			$p = parse_url ("http://localhost/сайт для гималайской соли/Товары/$t/$r/");
			$i = $p['scheme'] . '://' . $p['host'] . implode('/', array_map('rawurlencode', array_map('rawurldecode', explode('/', $p['path']))));
			echo file_get_contents($i . 'Стоимость');
			echo ';';
			echo "$t/$r";
			echo ';';
			echo "$t";
			echo ';';
			echo '$';
		}
	}
?>