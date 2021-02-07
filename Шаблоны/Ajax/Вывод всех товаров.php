<?php
	session_start();
	foreach ($_SESSION['cart'] as $value) {
		echo $value;
		echo '*';
	}
?>