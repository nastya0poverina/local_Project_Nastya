<!DOCTYPE html>
<html>
	<head>
		<title>Настройка базы данных</title>
	</head>
	<body>
		<h3>Настройка...</h3>
		
		<?php 
		  require_once 'functions.php';
		  
		  createTable('members', 'user VARCHAR(16), password VARCHAR(16), index(user(6))');
		  
		  createTable()
		?>
	</body>
</html>
