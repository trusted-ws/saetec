<!DOCTYPE html>
<html>

<head>
  <title>Saetec - Minha Conta</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
  <script href="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script src="redirection-mobile.js"></script>
  <script>
    SA.redirection_mobile({
      mobile_url: "192.168.1.4/home/minhaconta_mobile.php", // Dominio de hospedagem
      mobile_prefix: "https"
    });
  </script>
  <style>
    .color_blue {
      background-color: #d8dbe2;
    }

    div.ex2 {
      max-width: 700px;
      margin: auto;
      padding-left: 10px;
      padding-right: 10px;
      background-color: #d8dbe2;

    }

    body {
      background: rgb(169, 188, 208);
      background: linear-gradient(353deg, rgba(169, 188, 208, 1) 0%, rgba(169, 188, 208, 1) 16%, rgba(88, 164, 176, 1) 100%);
    }

    table {
      border: 1px solid #ccc;
      border-collapse: collapse;
      margin: 0;
      padding: 0;
      width: 100%;
      table-layout: fixed;
    }

    table caption {
      font-size: 1.5em;
      margin: .5em 0 .75em;
    }

    table tr {
      background-color: #f8f8f8;
      border: 1px solid #ddd;
      padding: .35em;
    }

    table th,
    table td {
      padding: .625em;
      text-align: center;
      background-color: #F8F8F8;
    }

    table th {
      font-size: .85em;
      letter-spacing: .1em;
      text-transform: uppercase;
    }

    @media screen and (max-width: 600px) {
      table {
        border: 0;
      }

      table caption {
        font-size: 1.3em;
      }

      table thead {
        border: none;
        clip: rect(0 0 0 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
      }

      table tr {
        border-bottom: 3px solid #ddd;
        display: block;
        margin-bottom: .625em;
      }

      table td {
        border-bottom: 1px solid #ddd;
        display: block;
        font-size: .8em;
        text-align: right;
      }

      table td::before {
        content: attr(data-label);
        float: left;
        font-weight: bold;
        text-transform: uppercase;
      }

      table td:last-child {
        border-bottom: 0;
      }
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
  // Consulta do Usuário baseado no Session-UID
  $uid = $_SESSION['id_usuario'];
  $query = "SELECT * FROM `usuarios` WHERE `id` = '$uid'";
  $result = mysqli_query($con, $query) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ");
  $total = mysqli_num_rows($result);
  $dados = mysqli_fetch_array($result);
  ?>
  <br><br><br>
  <div data-role="window" data-icon="<span class='mif-user'></span>" data-title="Minha Conta" data-place="center" data-resizable="false" data-width="500" data-shadow="true" data-cls-caption="bg-cyan" data-cls-content="bg-light fg-black" class="p-2">
    <div class="">
      <h2 style="color: #b8b8b8;padding-left:15px;">Minha Conta</h2>
      <div class=""><br>
        <table>
          <tr>
            <td>ID</td>
            <td></td>
            <td><select style="background-color: #F8F8F8;"> <?php echo "<option selected=\"true\" disabled=\"disabled\">" . $_SESSION['id_usuario'] . "</option>"; ?></select></td>
          </tr>

          <tr>
            <td>Nome de usuário</td>
            <td><?php echo $dados['nome']; ?>
              <form action="minhaconta.php" method="POST">
                <input type="hidden" name="alterar_nome" value="1" />
            <td>
              <button class="button primary mini rounded">EDITAR</button>
            </td>
            </form>
            </td>
          </tr>

          <tr>
            <td>E-mail</td>
            <td><?php echo $dados['username']; ?></td>
          </tr>

          <tr>
            <td>Senha</td>
            <td>
              <form action="minhaconta.php" method="POST">
                <input type="hidden" name="alterar_senha" value="1" />
            <td>
              <button class="button primary mini rounded">EDITAR</button>
            </td>
            </form>
            </td>
          </tr>

          <tr>
            <td>Tipo de Conta</td>
            <td></td>
            <td><?php if ($dados['tipo'] == "1") {
                  echo "<button class=\"button yellow small rounded\"><b>ADMIN</b></button>";
                } else if ($dados['tipo'] == "2") {
                  echo "<button class=\"button info small rounded\">NORMAL</button>";
                }; ?></td>
          </tr>
        </table>

        <?php


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
          if (isset($_POST['alterar_senha'])) {
            if ($_POST['alterar_senha'] == 1) {
              echo '<br><br><hr>
                <form action="minhaconta.php" method="POST" data-role="validator">
                <input style="margin-bottom:10px;" type="password" data-role="input" data-prepend="Senha atual &nbsp;&nbsp;&nbsp;&nbsp;" name="senha_atual" data-validate="required">
                <input style="margin-bottom:10px;" type="password" data-validate="required minlength=8" data-role="input" data-prepend="Nova senha &nbsp;&nbsp;&nbsp;&nbsp;" name="senha_nova">
                <input style="margin-bottom:10px;" type="password" data-validate="required minlength=8 compare=senha_nova" data-role="input" data-prepend="Repita a senha&nbsp;" name="senha_repetida"><br>
                <input type="submit" class="button primary default rounded" value="Salvar">
                <a href="minhaconta.php" class="button secondary default rounded">Cancelar</a>
                </form>
                
                ';
            }
          } else if (isset($_POST['senha_atual'])) {
            if ($_POST['senha_nova'] != "" && $_POST['senha_repetida'] != "") {
              $user = $_SESSION['username'];
              $senha_atual = isset($_POST["senha_atual"]) ? md5(trim($_POST["senha_atual"])) : FALSE;
              $senha_nova = isset($_POST["senha_nova"]) ? md5(trim($_POST["senha_nova"])) : FALSE;
              $senha_repetida = isset($_POST["senha_repetida"]) ? md5(trim($_POST["senha_repetida"])) : FALSE;

              $query_verifica = "SELECT * FROM `usuarios` WHERE `username` = '" . $user . "' AND `password` = '" . $senha_atual . "'";
              $result_verifica = mysqli_query($con, $query_verifica) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ");
              $total = mysqli_num_rows($result_verifica);
              if ($total) {
                // Senha digita existe. Dar continuidade.
                if (!($senha_nova != $senha_repetida)) {
                  // Trocar senha
                  $query_trocarSenha = "UPDATE `usuarios` SET `password` = '" . $senha_nova . "' WHERE `username` = '" . $user . "';";
                  $result_trocarSenha = mysqli_query($con, $query_trocarSenha) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ");
                  echo "
                  <script language=\"javascript\">
                  Swal.fire({
                  title: 'Senha Alterada com Sucesso',
                  showConfirmButton: false,
                  icon: 'success',
                  timer: 1500,
                  //onClose: () => { window.location.reload(); }
                });
                  </script>
                  ";
                } else {
                  // Senhas nao correspondem
                  echo "
                  <script language=\"javascript\">
                  Swal.fire(
                    'Não foi possível',
                    'As senhas não correspondem',
                    'error'
                  )
                  </script>
                  ";
                }
              } else {
                echo "
                <script language=\"javascript\">
                Swal.fire(
                  'Não foi possível',
                  'A senha digitada está incorreta',
                  'error'
                )
                </script>
                ";
              }
            }
          } else if (isset($_POST['alterar_nome'])) {
            if ($_POST['alterar_nome'] == 1) {
              echo '<br><br><hr>
                <form action="minhaconta.php" method="POST" data-role="validator">
                <input style="margin-bottom:10px;" type="text" data-role="input" data-prepend="Novo nome &nbsp;&nbsp;&nbsp;&nbsp;" name="novo_nome" data-validate="required"><br>
                <input type="submit" class="button primary default rounded" value="Salvar">
                <a href="minhaconta.php" class="button secondary default rounded">Cancelar</a>
                </form>
                
                ';
            }
          } else if (isset($_POST['novo_nome'])) {
            if ($_POST['novo_nome'] != "" && $_POST['novo_nome'] != "") {
              $user = $_SESSION['username'];
              $novoNome = $_POST['novo_nome'];

              if ($novoNome != "") {
                $query_trocarNome = "UPDATE `usuarios` SET `nome` = '" . $novoNome . "' WHERE `username` = '" . $user . "';";
                $result_trocarNome = mysqli_query($con, $query_trocarNome) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ");
                echo "
                <script language=\"javascript\">
                Swal.fire({
                  title: 'Nome Alterado com Sucesso',
                  showConfirmButton: false,
                  icon: 'success',
                  timer: 1500,
                  //onClose: () => { window.location.reload(); }
                });
                
                </script>
                ";
              } else {
                echo "Insira o novo nome";
              }
            }
          }
        }


        ?>
        <br>
      </div>
    </div>
  </div>
  <div class="container">
    <?php
    if ($_SESSION['permissao'] == "1")
      echo '<div class="shadow"><img class="logo" src="../admin.png" width="450"/></div>';
    else
      echo '<div class="shadow"><img class="logo" src="../noadmin.png" width="450"/></div>';
    ?>
  </div>
  <script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
</body>

</html>