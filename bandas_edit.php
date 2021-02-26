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
			$sql="Select * from bandas where id=?";
			$stm=$con->prepare($sql);
			if ($stm!=false) {
				$stm->bind_param("i", $idBanda);
				$stm->execute();
				$res=$stm->get_result();
				$banda=$res->fetch_assoc();
				$stm->close();
			}
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta charset="ISO-8859-1">
				<title>Editar Banda</title>
	            <h1>Editar Banda</h1>
	        </head>
				<form action="bandas_update.php" method="POST">
			<label>Banda</label><input type="text" name="banda" required value="<?php echo $banda['banda']; ?>"><br><br>
			<label>Nacionalidade</label><input type="text" name="nacionalidade" value="<?php echo $banda['nacionalidade'];?>"><br>
			<input type="hidden" name="id" value="<?php echo $banda['id'];?>"><br>
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