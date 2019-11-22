<!DOCTYPE html>
<html>

<head>
  <title>Saetec - Agendar Recursos</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
  <script href="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>

  <style>
    #inner {
      width: 70%;
      margin: 0 auto
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

    #tableShadow {
      border: 1px solid;
      padding: 10px;
      box-shadow: 1px 3px 10px black;
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
          <li><a href="admin/incluir_objeto.php"><span class="mif-add icon"></span> Adicionar Recurso</a></li>
          <li><a href="admin/gerenciar_recursos.php"><span class="mif-developer_board icon"></span> Gerênciar Recurso</a></li>
        </ul>
      </li>
      <li class="divider"></li>
      <li><a href="admin/cadastrar.php"><span class="mif-user-plus icon"></span> Cadastrar Usuários</a></li>';
      if($num_rows_usuarios_pendentes > 0) {
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


  <div class="container">
    <div>
      <?php
      echo "<div style=\"color: #fff; text-shadow: 2px 2px #000;padding-left: 20px;\"><h1>Agendar Recursos</h1></div>";
      $query = "SELECT * FROM `recurso`;";
      $result = mysqli_query($con, $query);

      echo "<table border='8' class='table table-border cell-border row-hover' id='tableShadow'>
<tr style='background-color: #d8dbe2';>
<th>Nome</th>
<th>Tipo de Recurso</th>
<th>Quantidade</th>
<th>Descrição</th>
<th></th>

</tr>";

      while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td class='light'>" . $row['nome'] . "</td>";
        echo "<td class='light'>" . $row['tipo_recurso'] . "</td>";
        echo "<td class='light'>" . $row['quantidade'] . "</td>";
        echo "<td class='light'>" . $row['descricao'] . "</td>";
        echo "<td class='light'><a class='image-button secondary outline' href=\"/home/agendando_recurso.php?recId=" . $row['recId'] . "&resname=" . $row['nome'] . "\"><span class='mif-calendar icon'></span><span class='caption'>AGENDAR</span></a></td>";
        echo "</tr>";
      }
      echo "</table>";
      ?>
    </div>
  </div>
  <script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
</body>

</html>