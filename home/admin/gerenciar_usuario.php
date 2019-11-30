<!DOCTYPE html>
<html>

<head>
    <title>Saetec - Gerênciamento de Usuários</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
    <script href="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>

    <style>
        body {
            background-color: #b8c8d8;
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
    if($num_rows_usuarios_pendentes > 0) {
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
      if($num_rows_usuarios_pendentes > 0) {
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
    <div data-role="window" data-icon="<span class='mif-user'></span>" data-title="Editar Usuário" data-place="center" data-resizable="false" data-width="500" data-shadow="true" data-cls-caption="bg-cyan" data-cls-content="bg-light fg-black" class="p-2">
        <div class="">
            <?php


            if (isset($_GET['uid'])) {
                $uid = $_GET['uid'];

                $query = "SELECT * FROM `usuarios` WHERE `id` = $uid;";
                $result = mysqli_query($con, $query);


                while ($row = mysqli_fetch_array($result)) {
                    if ($row['ativo'] == 1) {
                        $status = "Ativado";
                    } else {
                        $status = "Desativado";
                    }
                    if ($row['tipo'] == 1) {
                        $role = "Admin";
                    } else {
                        $role = "Normal";
                    }

                    echo "<p style=\"color: lightgray;\">Editando usuário: " . $uid . "</p><br>";
                    echo '<form action="editando.php" method="POST">';
                    echo "NOME";
                    echo '<input type="hidden" name="neID" value="' . $uid . '" />';
                    echo "<input data-role=\"input\" type=\"text\" name=\"eNome\" value=\"" . $row['nome'] . "\"><br>";
                    if ($row['tipo'] == 1) {
                        echo "TIPO DE CONTA
    <select name=\"tipoconta\">
        <option value=\"1\" selected>Admin</option>
        <option value=\"2\">Comum</option>
    </select>";
                    } else {
                        echo "TIPO DE CONTA
    <select name=\"tipoconta\">
        <option value=\"1\">Admin</option>
        <option value=\"2\" selected>Comum</option>
    </select>";
                    }

                    echo "<br>";

                    if ($row['ativo'] == 1) {
                        echo "Status
        <select name=\"status\">
            <option value=\"1\" selected>Ativado</option>
            <option value=\"0\">Desativado</option>
        </select>";
                    } else {
                        echo "Status
        <select name=\"status\">
            <option value=\"1\">Ativado</option>
            <option value=\"0\" selected>Desativado</option>
        </select>";
                    }
                    echo '<br><input type="submit" class="button primary default rounded" value="Salvar"> ';
                    echo '<a href="gerenciar.php" class="button secondary default rounded">Cancelar</a>';
                    echo '</form>';
                }

                mysqli_close($con);
            }

            ?>
        </div>
    </div>
    <script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
</body>

</html>