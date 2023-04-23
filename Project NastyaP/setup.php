<!DOCTYPE html>
<html>
	<head>
		<title>Настройка базы данных</title>
	</head>
	<body>
		<h3>Настройка...</h3>
		
		<?php 
		  require_once 'functions.php';
		  
		  create_table('members', 'user VARCHAR(16), password VARCHAR(16), index(user(6))');
		  
		  create_table('friends', 'user VARCHAR(16)', 'friends VARCHAR(16)', 'INDEX(user(6))', 'INDEX(friend(6))');
		  
		  create_table('profiles', 'user VARCHAR(16)', 'text VARCHAR(16)', 'INDEX(user(6))');
		?>
		<br> ... завершенаю
	</body>
</html>