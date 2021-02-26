<?php


session_start();

if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if ($_SESSION['login']=="correto" && isset($_SESSION['login'])) {
	//aqui colocamos o conteudo


if ($_SERVER['REQUEST_METHOD']=='POST') {
	$album="";
	$ano="";

	


	if (isset($_POST['album'])) {
		$album=$_POST['album'];
	}
	else{
		echo '<script>alert("É obrigatório o preenchimento do nome.");</script>';
	}
	if (isset($_POST['ano'])) {
		$ano=$_POST["ano"];
	}
	if (isset($_POST['id'])) {
		$id=$_POST['id'];
	}
	

	$con=new mysqli("localhost","root", "","bdbandas");

	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados. <br>".$con->connect_error;
		exit;
	}
	else{
		$sql="update albuns set album=?, ano=? where id=?";
		$stm=$con->prepare($sql);

			
			if ($stm!=false) {
				$stm->bind_param("ssi", $album, $ano, $id);
				$stm->execute();
				$stm->close();
				echo '<script>alert("Album alterada com sucesso!!")</script>';
				echo "Aguarde um momento. A reencaminhar página";
				header ('refresh:5, url=index.php');
			}
			else{

		}
	}
}
else{
	echo ("<h1>Houve um erro ao processar o seu pedido.<br> Dentro de segundos irá ser rencaminhado!</h1>");
				header ("refresh:5; url= index.php");
}



}//login
else{
	echo 'Para entrar nesta página necessita de efetuar <a href="login.php">login</a>';
	header('refresh:2;url=login.php');
}

?>