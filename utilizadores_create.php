<?php


session_start();

if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if ($_SESSION['login']=="correto" && isset($_SESSION['login'])) {
	//aqui colocamos o conteudo



if ($_SERVER['REQUEST_METHOD']=="POST") {
	$nome="";
	$user_name="";
	$email="";
	$data_nascimento="";
	$password="";
	

	if (isset($_POST['nome'])) {
		$nome=$_POST['nome'];
	}
	else{
		echo '<script>alert("É obrigatório o preenchimento do nome.");</script>';
	}
	if (isset($_POST['user_name'])) {
		$user_name=$_POST["user_name"];
	}
	if (isset($_POST['email'])) {
		$email=$_POST["email"];
	}
	if (isset($_POST['data_nascimento'])) {
		$data_nascimento=$_POST['data_nascimento'];
	}
	if (isset($_POST['password'])) {
		$password=$_POST["password"];
	}
	


	$con=new mysqli("localhost", "root", "", "bdbandas");

	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados. <br>".$con->connect_error;
		exit;
	}
	else{
		$sql="insert into utilizadores (nome, user_name, email, data_nascimento, password) values (?,?,?,?,?)";
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('sssss', $nome, $user_name, $email, $data_nascimento, $password);
			$stm->execute();
			$stm->close();

			echo '<script>alert("Utilizador adicionado com sucesso")</script>';
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
		<meta charset="ISO-8859-1">
		<title>Adicionar Utilizadores</title>
	</head>
	<body>
		<h1>Adicionar Utilizadores</h1>
		<form action="utilizadores_create.php" method="POST">
		<label>Nome</label><input type="text" name="nome" required><br><br>
		<label>User Name</label><input type="text" name="user_name"><br><br>
		<label>Email</label><input type="text" name="email"><br><br>
		<label>Data Nascimento<input type="date" name="data_nascimento"></label><br><br>
		<label>Password</label><input type="password" name="password"><br>


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



