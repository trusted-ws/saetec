<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Saetec - Login</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="https://fonts.googleapis.com/css?family=Blinker:400,700&display=swap" rel="stylesheet">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="redirection-mobile.js"></script>
	<script>
    SA.redirection_mobile({
      mobile_url: "myserver.com/mobile/index.php",  
      mobile_prefix: "https"
    });
  </script>

	<link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="container">
		<div class="row justify-content-center mtop-xs-70 z-depth-5">
			<aside class="col-sm-4">
				<div class="card" style="margin-top:30%;">
					<article class="card-body">
						<h4 class="card-title text-center mb-4 mt-1">
							<a href="index.php"><img src="../Logo.gif" height="150" class="img-fluid" alt="Saetec Logo"></a>
						</h4>
						<hr>
						<p class="text-success text-center">
							<h4 class="text-center" id="Blinker-font">Autentique-se</h4>
						</p>
						<form action="login.php" method="post">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"> <i id="user-img"></i> </span>
									</div>
									<input name="username" class="form-control" placeholder="E-mail" type="text">
								</div> <!-- input-group.// -->
							</div> <!-- form-group// -->
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"> <i id="lock-img"></i> </span>
									</div>
									<input name="password" class="form-control" placeholder="Senha" type="password">
								</div> <!-- input-group.// -->
							</div> <!-- form-group// -->
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block"> Login </button>

							</div> <!-- form-group// -->

							<p class="text-center" style="margin-top: 30px;">Não tem uma conta? <a href="criarconta.php" class="">Crie uma agora!</a></p>
						</form>
						<?php

						if (isset($_GET['c'])) {
							if ($_GET['c'] == "uopww") {
								echo '<div class="alert alert-danger"><strong>Erro!</strong> Usuário e/ou senha incorretos.</div>';
							} else if ($_GET['c'] == "uopwb") {
								echo '<div class="alert alert-warning"><strong>Atenção!</strong> É necessário preencher todos os campos para continuar.</div>';
							} else if ($_GET['c'] == "taina") {
								echo '<div class="alert alert-warning text-center"> Este usuário foi desativado. </div>';
							} else if($_GET['c'] == "tuip") {
								echo '<div class="alert alert-warning text-center"><strong>Conta não ativa</strong><br> Aguardando confirmação do Administrador. </div>';
							}
						} else { }
						?>
					</article>

				</div> <!-- card.// --><br>
				<p class="text-center" style="font-size: 12px;"> Sistema de Agendamentos da Etec &copy 2019 </p>
				<p class="text-center" style="font-size: 12px; color: #757575;"> Desenvolvido por Murilo Augusto, Igor Gabriel e Luiz Gustavo <br><span style="color: #363b59">E-mail para contato: </span> <a href="mailto:eth0.db0@gmail.com">eth0.db0@gmail.com</a></p>
				<center><a href="/mobile/index.php"><i class="material-icons">computer forwardsmartphone</i></a></center>
			</aside> <!-- col.// -->
		</div> <!-- row.// -->

	</div>
	<?php
	// Verificador de Sessão
	session_start();

	// Verifica se existe os dados da sessão de login 
	if (!(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["nome_usuario"]))) {
		// Usuário logado! Redireciona para a página home 

		header("location: /home/index.php");
		exit;
	}


	?>
</body>

</html>
