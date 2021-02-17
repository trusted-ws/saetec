<!DOCTYPE html>
<html>

<head>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Saetec - Criar Conta</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="https://fonts.googleapis.com/css?family=Blinker:400,700&display=swap" rel="stylesheet">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

	<link rel="stylesheet" href="style.css">

</head>

<body>
	<div class="container">

		<div class="row justify-content-center mtop-xs-70 z-depth-5">
			<aside class="col-sm-4">
				<div class="card" style="margin-top:30%;">
					<article class="card-body">
						<h4 class="card-title text-center mb-4 mt-1">
							<a href="index.php"><img src="../Logo.gif" alt="" height="150" class="img-fluid" alt="Responsive Image"></a>
						</h4>
						<hr>
						<p class="text-success text-center">
							<h4 class="text-center" id="Blinker-font">Criar Conta</h4>

						</p>
						</p>
						<form action="" method="post">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"> <i id="user-img"></i> </span>
									</div>
									<input name="nome" class="form-control" placeholder="Nome de Usuário" type="text" required>
								</div> <!-- input-group.// -->
							</div> <!-- form-group// -->
							<form action="login.php" method="post">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"> <i id="email-img"></i> </span>
										</div>
										<input name="username" class="form-control" placeholder="E-mail" type="email" required>
									</div> <!-- input-group.// -->
								</div> <!-- form-group// -->
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"> <i id="lock-img"></i> </span>
										</div>
										<input name="password" class="form-control" placeholder="Nova Senha" minlength="8" type="password" required>
									</div> <!-- input-group.// -->
								</div> <!-- form-group// -->
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"> <i id="lock-img"></i> </span>
										</div>
										<input name="password_confirm" class="form-control" placeholder="Repita a Senha" minlength="8" type="password" required>
									</div> <!-- input-group.// -->
									<center>
										<br><span style="color: #a1a1a1;">Para efetivar seu cadastro é necessária aprovação do Administrador.</span><br>
									</center>
								</div> <!-- form-group// -->
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block"> Registrar </button>
									<!-- <a href=".php" method="POST" type="submit" class="btn btn-primary btn-block"> Login </a> -->
								</div> <!-- form-group// -->
								<p class="text-center" style="margin-top: 30px;">Já possuí uma conta? <a href="index.php" class="">Conecte-se agora!</a></p>
							</form>
					</article>

				</div> <!-- card.// --><br>
				<p class="text-center" style="font-size: 12px;"> Sistema de Agendamentos da Etec &copy 2019</p>
				<p class="text-center" style="font-size: 12px; color: #757575;"> Desenvolvido por Murilo Augusto, Igor Gabriel e Luiz Gustavo <br><span style="color: #363b59">E-mail para contato: </span> <a href="mailto:eth0.db0@gmail.com">eth0.db0@gmail.com</a></p>
				<center><a href="/mobile/index.php"><i class="material-icons">computer forwardsmartphone</i></a></center>
			</aside> <!-- col.// -->
		</div> <!-- row.// -->

	</div>

	<?php
	// Conexão com a base de dados
	require('includes/conn.php');

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$login = isset($_POST["username"]) ? addslashes(trim($_POST["username"])) : FALSE;
		$senha = isset($_POST["password"]) ? md5(trim($_POST["password"])) : FALSE;
		$senha_confirma = isset($_POST["password_confirm"]) ? md5(trim($_POST["password_confirm"])) : FALSE;
		$nome = isset($_POST["nome"]) ? addslashes(trim($_POST["nome"])) : FALSE;

		if (!($senha == $senha_confirma)) {
			echo "
			<script language=\"javascript\">
			Swal.fire(
			  'Falha ao Cadastrar',
			  'As senhas não correspôndem',
			  'error'
			)
			</script>
			";
			die();
		}


		$query_usuario = "SELECT * FROM `usuarios` WHERE `username` = '" . $login . "';";

		$result = mysqli_query($con, $query_usuario) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ");
		$total = mysqli_num_rows($result);
		$result = mysqli_query($con, $query_usuario) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ");
		$total = mysqli_num_rows($result);
		if ($total == 0) {
			$query = "INSERT INTO `usuarios` ( `nome`, `username`, `password`, `tipo`, `ativo`, `pendente`) VALUES ( '" . $nome . "', '" . $login . "', '" . $senha . "', '2', '1', '1');";
			if (mysqli_query($con, $query) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ")) {
                #header("location:sucesso.php"); # Don't work with newest version of PHP.
                # Using javascript to redirect instead:
                echo "
                <script language=\"javascript\">
                    window.location.replace('sucesso.php');
                </script>
                ";


			}
		} else {
			echo "
			<script language=\"javascript\">
			Swal.fire(
			  'Falha ao Cadastrar',
			  'O e-mail informado já está em uso',
			  'error'
			)
			</script>
			";
		}
	} else { }
	?>
</body>

</html>
