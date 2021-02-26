<?php


session_start();

if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if ($_SESSION['login']=="correto" && isset($_SESSION['login'])) {
	//aqui colocamos o conteudo

		if($_SERVER['REQUEST_METHOD']=="GET"){
		if (isset($_GET['album'])&& is_numeric($_GET['album'])) {
			$idAlbum = $_GET['album'];
			$con=new mysqli("localhost","root", "","bdbandas");

			if ($con->connect_errno!=0) {
				echo "<h1>Ocorreu um erro no acesso á base de dados.<br>".$con->connect_error."</h1>";
				exit();
			}
			$sql="Select * from albuns where id=?";
			$stm=$con->prepare($sql);
			if ($stm!=false) {
				$stm->bind_param("i", $idAlbum);
				$stm->execute();
				$res=$stm->get_result();
				$album=$res->fetch_assoc();
				$stm->close();
			}
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta charset="ISO-8859-1">
				<title>Editar Album</title>
	            <h1>Editar Album</h1>
	        </head>
				<form action="albuns_update.php" method="POST">
			<label>Album</label><input type="text" name="album" required value="<?php echo $album['album']; ?>"><br><br>
			<label>Ano</label><input type="date" name="ano" value="<?php echo $album['ano'];?>"><br>
			<input type="hidden" name="id" value="<?php echo $album['id'];?>"><br>
	        <input type="submit" name="enviar">
		</form>
		</body>
			
			<?php
			}
			else{
				echo "<h1>Houve um erro ao processar o seu pedido.<br> Dentro de segundos irá ser rencaminhado!</h1>";
				header ("refresh:5; url=index.php");
				
			}
		
		?>
		</html>
	<?php
}







}//login
else{
	echo 'Para entrar nesta página necessita de efetuar <a href="login.php">login</a>';
	header('refresh:2;url=login.php');
}


?>