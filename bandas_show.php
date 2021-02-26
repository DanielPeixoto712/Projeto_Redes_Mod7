<?php



session_start();

if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if ($_SESSION['login']=="correto" && isset($_SESSION['login'])) {
	//aqui colocamos o conteudo

if($_SERVER['REQUEST_METHOD']=="GET"){


	if (!isset($_GET['banda']) || !is_numeric($_GET['banda'])) {
		echo '<script>alert("Erro ao abrir banda");</script>';
		echo 'Aguarde um momento. A reencaminhar página';
		header("refresh:5; url=index.php");
		exit();

	}
	$idBanda=$_GET['banda'];
	$con=new mysqli("localhost", "root", "","bdbandas");

	if($con->connect_errno!=0){
		echo "Ocorreu um erro no acesso á base de dados.<br>" .$con->connect_error;
		exit;
	}
	else{
		$sql='select * from bandas where id = ?';
		$stm = $con->prepare ($sql);
		if ($stm!=false) {
			$stm->bind_param("i", $idBanda);
			$stm->execute();
			$res=$stm->get_result();
			$banda = $res->fetch_assoc();
			$stm->close();
		}
		else{
			echo "<br>";
			echo ($con->error);
			echo "<br>";
			echo "Aguarde um momento. A reencaminhar página";
			echo "<br>";
			header("refresh:5;url=index.php");
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<meta charset="ISO-8859-1">
	<title>Detalhes</title>
</head>
<body>
	<h1>Detalhes da Banda</h1>

<?php
if (isset($banda)) {
	echo"<br>";
	echo "Nome da Banda: ";
	echo utf8_encode( $banda["banda"]);
	echo "<br>";
	echo "Nacionalidade: ";
	echo utf8_encode( $banda["nacionalidade"]);

	

	


}
else{
	echo "<h2>Parece que a banda selecionado não existe.<br>Confirme a sua seleção</h2>";
}
?>
</body>
</html>

<?php
}//login
else{
	echo 'Para entrar nesta página necessita de efetuar <a href="login.php">login</a>';
	header('refresh:2;url=login.php');
}

?>






















