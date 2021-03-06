<html>

<head>

  <title>Saetec - Home</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
  <script href="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script src="redirection-mobile.js"></script>
	<script>
    SA.redirection_mobile({
      mobile_url: "192.168.1.7/mobile/index.php", // Dominio de hospedagem
      mobile_prefix: "https"
    });
  </script>
  <style>
    body {
      background: rgb(169, 188, 208);
      background: linear-gradient(353deg, rgba(169, 188, 208, 1) 0%, rgba(169, 188, 208, 1) 16%, rgba(88, 164, 176, 1) 100%);
    }

    img {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      margin: auto;
      margin-top: 25%;
      opacity: 0.23;
    }

    .footer {
      position: absolute;
      right: 0;
      bottom: 1;
      left: 0;
      padding: 1rem;
      color: #efefef;
      text-align: center;
      margin-top: 20px;
      /* padding-bottom: 50%; */
    }

    a {
      color: white;
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <script language="javascript">
    function mensagemLogado() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000,
        background: '#fff',
        footer: 'Você está autenticado'
      })

      Toast.fire({
        icon: 'success',
        title: '<div style="font-family:arial;">Logado com sucesso!</div>'
      })
    }
  </script>

  <ul class="h-menu">
    <li><a href="index.php"><span class="mif-home icon"></span> Saetec</a></li>
    <li><a href="agendar_objeto.php"><span class="mif-calendar icon"></span> Agendar</a></li>
    <li><a href="agendamentos.php"><span class="mif-insert-template icon"></span> Agendamentos</a></li>
    <li><a href="minhaconta.php"><span class="mif-user icon"></span> Minha Conta</a></li>
    <?php
    // Conexão com a base de dados
    require('../includes/conn.php');
    // Verificador de Sessão
    require('../includes/verifica.php');

    $query_usuarios_pendentes = "SELECT * FROM `usuarios` where `pendente` = 1;";
    $result_usuarios_pendentes = mysqli_query($con, $query_usuarios_pendentes);
    $num_rows_usuarios_pendentes = mysqli_num_rows($result_usuarios_pendentes);

    if ($_SESSION["permissao"] == "1") {
      echo '
    <li>';
      if ($num_rows_usuarios_pendentes > 0) {
        echo '<a href="#" class="dropdown-toggle"><span class="mif-command icon"></span> Gerênciar <span class="badge inline bg-cyan fg-white">' . $num_rows_usuarios_pendentes . '</span></a>';
      } else {
        echo '<a href="#" class="dropdown-toggle"><span class="mif-command icon"></span> Gerênciar</a>';
      }
      echo '
    <ul class="d-menu" data-role="dropdown">
      <li>
        <a href="#" class="dropdown-toggle"><span class="mif-dashboard icon"></span> Recursos</a>
        <ul class="d-menu" data-role="dropdown">
          <li><a href="admin/incluir_objeto.php"><span class="mif-add icon"></span> Adicionar Recurso</a></li>
          <li><a href="admin/gerenciar_recursos.php"><span class="mif-developer_board icon"></span> Gerênciar Recurso</a></li>
        </ul>
      </li>
      <li class="divider"></li>
      <li><a href="admin/cadastrar.php"><span class="mif-user-plus icon"></span> Cadastrar Usuários</a></li>';
      if ($num_rows_usuarios_pendentes > 0) {
        echo '<li><a href="admin/gerenciar.php"><span class="mif-users icon"></span> Gerênciar Usuários <span class="badge inline bg-cyan fg-white">' . $num_rows_usuarios_pendentes . '</span></a></li>';
      } else {
        echo '<li><a href="admin/gerenciar.php"><span class="mif-users icon"></span> Gerênciar Usuários</a></li>';
      }
      echo '
      <li class="divider"></li>
    </ul>
  </li>
';
    }
    ?>
    <li><a href="/home/sair.php"><span class="mif-exit icon"></span> Sair</a></li>
  </ul>
  </div>

  <?php
  if ($_SESSION['primeiroAcesso'] == true) {
    $_SESSION['primeiroAcesso'] = false;
    echo '
    <script language="javascript">
      mensagemLogado();
    </script>
    ';
  }
  ?>
  <div class="container">
    <?php
    if ($_SESSION['permissao'] == "1")
      echo '<div class="shadow"><img class="logo" src="../admin.png" width="450"/></div>';
    else
      echo '<div class="shadow"><img class="logo" src="../noadmin.png" width="450"/></div>';
    ?>
  </div>

  <?php
  // Administrador: 91f5167c34c400758115c2a6826ec2e3.pdf
  // Normal: f8032d5cae3de20fcec887f395ec9a6a.pdf
  if ($_SESSION["permissao"] == "1") {
    echo '<div class="footer">Precisa de ajuda? <a href="/tutorial/91f5167c34c400758115c2a6826ec2e3.pdf" target="_blank">Este tutorial pode te ajudar!</a> <br><span style="font-size: 12px;">Sistema de Agendamentos da Etec &copy 2019</span></div>';
  } else {
    echo '<div class="footer">Precisa de ajuda? <a href="/tutorial/f8032d5cae3de20fcec887f395ec9a6a.pdf" target="_blank">Este tutorial pode te ajudar!</a> <br><span style="font-size: 12px;">Sistema de Agendamentos da Etec &copy 2019</span></div>';
  }
  ?>

  <script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
</body>

</html>