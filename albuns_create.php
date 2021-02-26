<?php


session_start();

if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if ($_SESSION['login']=="correto" && isset($_SESSION['login'])) {
	//aqui colocamos o conteudo




if ($_SERVER['REQUEST_METHOD']=="POST") {
	$album="";
	$ano="";
	
	

	if (isset($_POST['album'])) {
		$album=$_POST['album'];
	}
	else{
		echo '<script>alert("É obrigatório o preenchimento do album.");</script>';
	}
	if (isset($_POST['ano'])) {
		$ano=$_POST['ano'];
	}


	$con=new mysqli("localhost", "root", "", "bdbandas");

	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados. <br>".$con->connect_error;
		exit;
	}
	else{
		$sql="insert into albuns (album) values (?)";
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			
			$stm->bind_param('s', $album);
			$stm->execute();
			$stm->close();

			echo '<script>alert("Banda adicionada com sucesso")</script>';
			echo "Aguarde um momento. A reencaminhar página";
			header ("refresh:5;url=index.php");
		}
		else{
			echo ($con->error);
			echo "Aguarde um momento. A reencaminhar página";
			header ("refresh:5; url=index.php");
		}
	}
}
else{
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<meta charset="ISO-8859-1">
		<title>Adicionar Bandas</title>
	</head>
	<body>
		<h1>Adicionar Albuns</h1>
		<form action="albuns_create.php" method="POST">
		<label>Album</label><input type="text" name="album" required><br>
		<label>Ano</label><input type="date" name="ano" required><br>
        <input type="submit" name="enviar">
	</form>
	</body>
	</html>
<?php
}





}//login
else{
	echo 'Para entrar nesta página necessita de efetuar <a href="login.php">login</a>';
	header('refresh:2;url=login.php');
}


?>

