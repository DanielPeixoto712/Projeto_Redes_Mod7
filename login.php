<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<meta charset="utf-8">
	<title>Login</title>
</head>

<body>
	<div align="center">
	<h1>Login</h1>
	<form method="POST" action="processa_login.php">
		<label>Nome de Utilizador</label><input type="text" name="user_name" required><br><br>
		<label>Palavra-Passe</label><input type="password" name="password" required><br>
		<input type="submit" name="login"><br>
	</form>
	</div>
</body>
</html>



