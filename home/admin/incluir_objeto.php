<html>

<head>

  <title>Saetec - Cadastrar Recursos</title>
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

      // echo " <button class=\"dropbtn\">Admin";
      // echo " <i class=\"fa fa-caret-down\"></i>";
      // echo " </button>";
      // echo "  <div class=\"dropdown-content\">";
      // echo "  <a href=\"admin/incluir_objeto.php\">Incluir</a>";
      // echo "  <a href=\"admin/gerenciar_recursos.php\">Gerenciar</a>";
      // echo "  <a href=\"admin/cadastrar.php\">Cadastrar</a>";
      // echo "  <a href=\"admin/gerenciar.php\">Usuários</a>";
      // echo "</div>";
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

  <div data-role="window" data-icon="<span class='mif-add'></span>" data-title="Cadastrar Recursos" data-place="center" data-resizable="false" data-width="500" data-shadow="true" data-cls-caption="bg-cyan" data-cls-content="bg-light fg-black" class="p-2">
    <div class="">
      <h2 style="color: #b8b8b8;padding-left:15px;">Cadastro de Recursos</h2>
      <form action="incluindo_recurso.php" method="post">
        <input type="text" name="nome" data-prepend="Nome: " data-role="input" data-clear-button-icon="<span class='mif-cancel'></span>" required><br>
        <input type="number" name="quantidade" min="0" data-prepend="Quantidade: " data-role="input" data-clear-button-icon="<span class='mif-cancel'></span>" required><br>
        Descrição<br>
        <textarea name="descricao" rows="10" cols="30" data-role="textarea" required></textarea><br>
        Categoria <br>
        <select name="categoria">
          <option selected="true" name="sala_laboratorio" value="Sala / Laboratorio">Sala / Laboratório</option>
          <option name="recurso_aparelho" value="Recurso / Aparelho">Recurso / Aparelho</option>
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
            'Este recurso foi cadastrado',
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
  <script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
</body>

</html>