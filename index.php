<?php


session_start();

if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if ($_SESSION['login']=="correto" && isset($_SESSION['login'])) {
	//aqui colocamos o conteudo




	$con=new mysqli("localhost","root", "","bdbandas");
	if($con->connect_errno!=0){
		echo "Ocorreu um erro no acesso á base de dados".$con->connect_error;
		exit;
	}
	else {
	?>
	<!DOCTYPE html>
	<html>
	<head>

		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<meta charset="ISO-8859-1">
	<title>Base de dados Bandas</title>
	</head>
	<body>

<div>
		
		<h1>Lista de Bandas </h1>
		<?php
		$stm=$con->prepare('select * from bandas');
		$stm->execute();
		$res=$stm->get_result();
		while($resultado = $res->fetch_assoc()){
			echo '<a href="bandas_show.php?banda='.$resultado['id'].'">';
			echo "<h4>".$resultado["banda"]."</h4>";
			echo "</a>";
			echo '<a href="bandas_edit.php?banda='.$resultado['id'].'"><li>Editar</li></a>';
			echo "<br>";
			echo '<a href="bandas_delete.php?banda='.$resultado['id'].'"><li>Eliminar</li></a>';
			echo "<br>";

		}

		$stm->close();
		?>
	
	<a  href="bandas_create.php" ><h4>Adicionar Banda</h4></a>
	</div>
	<div align="center"><img src="imagens/1.jpg" height="500" width="100%"></div>
<hr>
<div>
	<h1>Lista de Albuns</h1>
		<?php
		$stm=$con->prepare('select * from albuns');
		if ($stm!=false) {
			$stm->execute();
			$res=$stm->get_result();
			while($resultado = $res->fetch_assoc()){
				echo '<a href="albuns_show.php?album='.$resultado['id'].'">';
				echo "<h4>".$resultado["album"]."</h4>";
				echo "</a>";
				echo '<a href="albuns_edit.php?album='.$resultado['id'].'"><li>Editar</li></a>';
				echo "<br>";
				echo '<a href="albuns_delete.php?album='.$resultado['id'].'"><li>Eliminar</li></a>';
				echo "<br>";

			}

			$stm->close();
		}
		?>
		<a  href="albuns_create.php" ><h4>Adicionar Album</h4></a>
</div>
<div align="center"><img src="imagens/2.jpg" height="500" width="100%"></div>
<hr>	
		<div>


					<h1>Lista de Utilizadores</h1>
		<?php
		$stm=$con->prepare('select * from utilizadores');
		if ($stm!=false) {
			$stm->execute();
			$res=$stm->get_result();
			while($resultado = $res->fetch_assoc()){
				echo '<a href="utilizadores_show.php?utilizador='.$resultado['id'].'">';
				echo "<h4>".$resultado["nome"]."</h4>";
				echo "</a>";
				echo '<a href="utilizadores_edit.php?utilizador='.$resultado['id'].'"><li>Editar</li></a>';
				echo "<br>";
				echo '<a href="utilizadores_delete.php?utilizador='.$resultado['id'].'"><li>Eliminar</li></a>';
				echo "<br>";

			}
		}
					?>
					<a  href="utilizadores_create.php" ><h4>Adicionar Utilizadores</h4></a>
					
</div>
	<hr>
	

<?php
		$stm->close();
		
		?>
		


	</body>
	</html>
	

	


<?php

}//conection








}//login
else{
	echo 'Para entrar nesta página necessita de efetuar <a href="login.php">login</a>';
	header('refresh:2;url=login.php');
}




