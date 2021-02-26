<?php



session_start();

if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if ($_SESSION['login']=="correto" && isset($_SESSION['login'])) {
	//aqui colocamos o conteudo

if($_SERVER['REQUEST_METHOD']=="GET"){


	if (!isset($_GET['album']) || !is_numeric($_GET['album'])) {
		echo '<script>alert("Erro ao abrir album");</script>';
		echo 'Aguarde um momento. A reencaminhar página';
		header("refresh:5; url=index.php");
		exit();

	}
	$idAlbum=$_GET['album'];
	$con=new mysqli("localhost", "root", "","bdbandas");

	if($con->connect_errno!=0){
		echo "Ocorreu um erro no acesso á base de dados.<br>" .$con->connect_error;
		exit;
	}
	else{
		$sql='select * from albuns where id = ?';
		$stm = $con->prepare ($sql);
		if ($stm!=false) {
			$stm->bind_param("i", $idAlbum);
			$stm->execute();
			$res=$stm->get_result();
			$album = $res->fetch_assoc();
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
	<h1>Detalhes do Album</h1>

<?php
if (isset($album)) {
	echo"<br>";
	echo "Nome do Album: ";
	echo utf8_encode( $album["album"]);
	echo "<br>";
	echo "Ano de Lançamento: ";
	echo utf8_encode( $album["ano"]);
	


}
else{
	echo "<h2>Parece que a album selecionado não existe.<br>Confirme a sua seleção</h2>";
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
