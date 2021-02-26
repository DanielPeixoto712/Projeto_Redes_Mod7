<?php


session_start();

if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if ($_SESSION['login']=="correto" && isset($_SESSION['login'])) {
	//aqui colocamos o conteudo

if($_SERVER['REQUEST_METHOD']=="GET"){
	if (isset($_GET['banda'])&& is_numeric($_GET['banda'])) {
		$idBanda = $_GET['banda'];
		$con=new mysqli("localhost","root", "","bdbandas");

		if ($con->connect_errno!=0) {
			echo "<h1>Ocorreu um erro no acesso á base de dados.<br>".$con->connect_error."</h1>";
			exit();
		}
		else{
		$sql="delete from bandas where id=?";
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param("i", $idBanda);
			$stm->execute();
			$stm->close();
			echo '<script>alert("Banda eliminada com sucesso")</script>';
			echo "Aguarde um momento. A reencaminhar página";
				header ("refresh:5; url=index.php");

		}

		else{
			echo '<br>';
			echo ($con->error);
			echo '<br>';
			echo "Aguarde um momento. A reencaminhar página";
			echo '<br>';
			header ("refresh:5; url=index.php");

		}
	}
}
else{
	echo "<h1>Houve um erro ao processar o seu pedido!<br>Irá ser reencaminhado!</h1>";
	header ("refresh:5; url=index.php");
}
}
else{
	echo "<h1>Houve um erro ao processar o seu pedido!<br>Irá ser reencaminhado!</h1>";
	header ("refresh:5; url=index.php");
}

	

}//login
else{
	echo 'Para entrar nesta página necessita de efetuar <a href="login.php">login</a>';
	header('refresh:2;url=login.php');
}



?>