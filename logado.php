<?php
	if ($_SESSION["logado"] != 0) {
		header('location: /home/index.php');
	}
?>