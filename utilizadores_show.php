<?php


session_start();

if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if ($_SESSION['login']=="correto" && isset($_SESSION['login'])) {
	//aqui colocamos o conteudo



	if($_SERVER['REQUEST_METHOD']=="GET"){


	if (!isset($_GET['utilizador']) || !is_numeric($_GET['utilizador'])) {
		echo '<script>alert("Erro ao abrir utilizador");</script>';
		echo 'Aguarde um momento. A reencaminhar página';
		header("refresh:5; url=index.php");
		exit();

	}
	$idUtilizador=$_GET['utilizador'];
	$con=new mysqli("localhost", "root", "","bdbandas");

	if($con->connect_errno!=0){
		echo "Ocorreu um erro no acesso á base de dados.<br>" .$con->connect_error;
		exit;
	}
	else{
		$sql='select * from utilizadores where id = ?';
		$stm = $con->prepare ($sql);
		if ($stm!=false) {
			$stm->bind_param("i", $idUtilizador);
			$stm->execute();
			$res=$stm->get_result();
			$utilizador = $res->fetch_assoc();
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
	<meta charset="ISO-8859-1">
	<title>Detalhes</title>
</head>
<body>
	<h1>Detalhes do utilizador</h1>

<?php
if (isset($utilizador)) {
	echo"<br>";
	echo "<h4>Nome: </h4>";
	echo utf8_encode( $utilizador["nome"]);
	echo "<hr>";
	echo "<br>";
	echo "<h4>User Name: </h4>";
	echo utf8_encode( $utilizador["user_name"]);
	echo "<hr>";
	echo "<br>";
	echo "<h4>Email: </h4>";
	echo $utilizador["email"];
	echo "<hr>";
	echo "<br>";
	echo "<h4>Data Nascimento: </h4>";
	echo $utilizador["data_nascimento"];
	echo "<hr>";
	echo "<br>";
    echo "<h4>Password: </h4>";
	echo $utilizador["password"];
	echo "<br>";
	

}
else{
	echo "<h2>Parece que o utilizador selecionado não existe.<br>Confirme a sua seleção</h2>";
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
