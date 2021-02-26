<?php


session_start();

if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if ($_SESSION['login']=="correto" && isset($_SESSION['login'])) {
	//aqui colocamos o conteudo

		if($_SERVER['REQUEST_METHOD']=="GET"){
		if (isset($_GET['utilizador'])&& is_numeric($_GET['utilizador'])) {
			$idUtilizador = $_GET['utilizador'];
			$con=new mysqli("localhost","root", "","bdbandas");

			if ($con->connect_errno!=0) {
				echo "<h1>Ocorreu um erro no acesso á base de dados.<br>".$con->connect_error."</h1>";
				exit();
			}
			$sql="Select * from utilizadores where id=?";
			$stm=$con->prepare($sql);
			if ($stm!=false) {
				$stm->bind_param("i", $idUtilizador);
				$stm->execute();
				$utilizador=$stm->get_result();
				$utilizador=$utilizador->fetch_assoc(); 

				
				$stm->close();
			}
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta charset="ISO-8859-1">
				<title>Editar Utilizadores</title>
	            <h1>Editar Utilizadores</h1>
	        </head>
				<form action="utilizadores_update.php" method="POST">
			<label>Nome</label><input type="text" name="nome" required value="<?php echo $utilizador['nome']; ?>"><br>
			<label>User Name</label><input type="text" name="user_name" value="<?php echo $utilizador['user_name'];?>"><br>
			<label>Email</label><input type="text" name="email" value="<?php echo $utilizador['user_name'];?>"><br>
			<label>Data Nascimento</label><input type="date" name="data_nascimento" value="<?php echo $utilizador['data_nascimento'];?>"><br>
			<label>Password</label><input type="password" name="password" value="<?php echo $utilizador['password'];?>"><br>
			<input type="hidden" name="id" value="<?php echo $utilizador['id'];?>"><br>


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