<html>

<head>

  <title>Saetec - Cadastrar Usuários</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
  <script href="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  <style>
    body {
      background: rgb(169, 188, 208);
      background: linear-gradient(353deg, rgba(169, 188, 208, 1) 0%, rgba(169, 188, 208, 1) 16%, rgba(88, 164, 176, 1) 100%);
    }

    div.ex2 {
      max-width: 700px;
      margin: auto;
      padding-left: 10px;
      padding-right: 10px;
      background-color: #d8dbe2;

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
      position: fixed;
      right: 0;
      bottom: 0;
      left: 0;
      padding: 1rem;
      color: white;
      text-align: center;
    }

    a {
      color: white;
      text-decoration: underline;
    }
  </style>
</head>

<body>

  <ul class="h-menu">
    <li><a href="../index.php"><span class="mif-home icon"></span> Saetec</a></li>
    <li><a href="../agendar_objeto.php"><span class="mif-calendar icon"></span> Agendar</a></li>
    <li><a href="../agendamentos.php"><span class="mif-insert-template icon"></span> Agendamentos</a></li>
    <li><a href="../minhaconta.php"><span class="mif-user icon"></span> Minha Conta</a></li>
    <?php
    // Conexão com a base de dados
    require('../../includes/conn.php');
    // Verificador de Sessão
    require('../../includes/verifica.php');

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
          <li><a href="incluir_objeto.php"><span class="mif-add icon"></span> Adicionar Recurso</a></li>
          <li><a href="gerenciar_recursos.php"><span class="mif-developer_board icon"></span> Gerênciar Recurso</a></li>
        </ul>
      </li>
      <li class="divider"></li>
      <li><a href="cadastrar.php"><span class="mif-user-plus icon"></span> Cadastrar Usuários</a></li>';
      if ($num_rows_usuarios_pendentes > 0) {
        echo '<li><a href="gerenciar.php"><span class="mif-users icon"></span> Gerênciar Usuários <span class="badge inline bg-cyan fg-white">' . $num_rows_usuarios_pendentes . '</span></a></li>';
      } else {
        echo '<li><a href="gerenciar.php"><span class="mif-users icon"></span> Gerênciar Usuários</a></li>';
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
  <div data-role="window" data-icon="<span class='mif-user-plus'></span>" data-title="Cadastrar de Usuários" data-place="center" data-resizable="false" data-width="500" data-shadow="true" data-cls-caption="bg-cyan" data-cls-content="bg-light fg-black" class="p-2">
    <div class="">
      <h2 style="color: #b8b8b8;padding-left:15px;">Cadastro de Usuários</h2>
      <form action="cadastrando.php" method="post">
        <input type="text" name="nome" data-role="input" data-prepend="Nome de usuário: " required><br>
        <input type="text" name="username" data-role="input" data-prepend="E-Mail: " required><br>
        <input type="password" name="password" minlength="8" data-role="input" data-prepend="Senha: " required><br>
        Tipo de Conta:
        <select name="tipoconta" required>
          <option selected="true" name="normal" value="2">Normal</option>
          <option name="administrador" value="1">Administrador</option>
        </select><br><br>
        <input type="submit" class="button primary default rounded" value="Cadastrar">
        <input type="reset" class="button secondary default rounded" value="Limpar">
      </form>
      <?php
      if (isset($_GET['c'])) {
        if ($_GET['c'] == "nrcs") {
          echo '<script language="javascript">';
          echo "
          Swal.fire(
            'Cadastrado com Sucesso!',
            'Este usuário foi cadastrado',
            'success'
          )
          ";
          echo '</script>';
        } else if ($_GET['c'] == "uaeidb") {
          echo '<script language="javascript">';
          echo "
          Swal.fire(
            'Erro!',
            'Este usuário já existe',
            'error'
          )
          ";
          echo '</script>';
        }
      } else { }
      ?>
    </div>
  </div>
  <div class="container">
    <?php
    if ($_SESSION['permissao'] == "1")
      echo '<div class="shadow"><img class="logo" src="../../admin.png" width="450"/></div>';
    else
      echo '<div class="shadow"><img class="logo" src="../../noadmin.png" width="450"/></div>';
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