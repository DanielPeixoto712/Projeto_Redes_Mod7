<?php


session_start();

if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if ($_SESSION['login']=="correto" && isset($_SESSION['login'])) {
	//aqui colocamos o conteudo




if ($_SERVER['REQUEST_METHOD']=="POST") {
	$banda="";
	$nacionalidade="";
	
	

	if (isset($_POST['banda'])) {
		$banda=$_POST['banda'];
	}
	else{
		echo '<script>alert("É obrigatório o preenchimento da banda.");</script>';
	}
	if (isset($_POST['nacionalidade'])) {
		$nacionalidade=$_POST['nacionalidade'];
	}


	$con=new mysqli("localhost", "root", "", "bdbandas");

	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados. <br>".$con->connect_error;
		exit;
	}
	else{
		$sql="insert into bandas (banda) values (?)";
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			
			$stm->bind_param('s', $banda);
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
		<h1>Adicionar Bandas</h1>
		<form action="bandas_create.php" method="POST">
		<label>Banda</label><input type="text" name="banda" required><br>
		<label>Nacionalidade</label><input type="text" name="nacionalidade" required><br>
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

