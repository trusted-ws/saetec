<!DOCTYPE html>
<html>

<head>
  <title>Editar Recurso</title>
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
    // Verificador de Permissão
    require('../../includes/admin.php');

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
  <div data-role="window" data-icon="<span class='mif-dashboard'></span>" data-title="Editar Recurso" data-place="center" data-resizable="false" data-width="500" data-shadow="true" data-cls-caption="bg-cyan" data-cls-content="bg-light fg-black" class="p-2">
    <div class="">
      <?php

      if (isset($_GET['recId'])) {
        $recId = $_GET['recId'];

        $query = "SELECT * FROM `recurso` WHERE `recId` = $recId;";
        $result = mysqli_query($con, $query);


        while ($row = mysqli_fetch_array($result)) {

          echo "<p style=\"color: lightgray;\">Editando recurso [RecId]: " . $recId . "</p><br>";
          echo "NOME";
          echo '<form action="editando_recurso.php" method="POST">';
          echo '<input type="hidden" name="recId" value="' . $recId . '" />';
          echo "<input data-role=\"input\" type=\"text\" name=\"eNome\" value=\"" . $row['nome'] . "\"><br>";
          if ($row['tipo_recurso'] == "Recurso / Aparelho") {
            echo "TIPO DE CONTA
        <select name=\"tiporecurso\">
            <option value=\"Recurso / Aparelho\" selected>Recurso / Aparelho</option>
            <option value=\"Sala / Laboratorio\">Sala / Laboratorio</option>
        </select>";
          } else {
            echo "TIPO DE CONTA
        <select name=\"tiporecurso\">
            <option value=\"Recurso / Aparelho\">Recurso / Aparelho</option>
            <option value=\"Sala / Laboratorio\" selected>Sala / Laboratorio</option>
        </select>";
          }

          echo "<br>";
          echo "QUANTIDADE <input min=\"0\"type=\"number\" name=\"eQuantidade\" value=\"" . $row['quantidade'] . "\"><br>";
          echo "DESCRIÇÃO<textarea data-role=\"textarea\" name=\"eDescricao\" rows=\"10\" cols=\"30\">" . $row['descricao'] . "</textarea><br>";

          echo '<input type="submit" class="button primary default rounded" value="Salvar"> ';
          echo '<a href="gerenciar_recursos.php" class="button secondary default rounded">Cancelar</a>';
          echo '</form>';
        }

        mysqli_close($con);
      }

      ?>
      <script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
    </div>
</body>

</html>